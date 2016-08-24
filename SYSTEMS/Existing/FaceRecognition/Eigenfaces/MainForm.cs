using System;
using System.Drawing;
using System.Windows.Forms;


using Emgu.CV;
using Emgu.CV.Structure;
using Emgu.CV.CvEnum;

//Unused Libraries
//using System.Data;
//using System.Linq;
//using System.Text;
//using Emgu.CV.UI;
//using System.IO;
//using System.Xml;
//using System.Runtime.InteropServices;
//using System.Collections.Generic;
//using System.ComponentModel;
//using System.Threading;
//using System.Security.Principal;
//using System.Threading.Tasks;
//using Microsoft.Win32.SafeHandles;

namespace FaceRecognition
{
    public partial class MainForm : Form
    {
        #region variables
        Image<Bgr, Byte> currentFrame; //current image aquired from webcam for display
        Image<Gray, byte> result, TrainedFace = null; //used to store the result image and trained face
        Image<Gray, byte> gray_frame = null; //grayscale current image aquired from webcam for processing

        Capture grabber; //This is our capture variable

        public CascadeClassifier Face = new CascadeClassifier(System.AppDomain.CurrentDomain.BaseDirectory + "..\\..\\Resources\\haarcascade_frontalface_default.xml");//Our face detection method 

        int NumLabels;

        //Classifier with default training location
        ClassifierTrain Eigen_Recog = new ClassifierTrain();

        #endregion

        public MainForm()
        {
            InitializeComponent();
            Eigen_Recog.Recognizer_Type = "EMGU.CV.EigenFaceRecognizer";
            Eigen_Recog.Retrain();
            //Load of previus trainned faces and labels for each image

            if (Eigen_Recog.IsTrained)
            {
                message_bar.Text = "Training Data loaded";
            }
            else
            {
                message_bar.Text = "No training data found, please train program using Train menu option";
            }
            initialise_capture();

        }

        //Open training form and pass this
        private void trainToolStripMenuItem_Click(object sender, EventArgs e)
        {
            //Stop Camera
            stop_capture();

            //OpenForm
            TrainingForm TF = new TrainingForm(this);
            TF.Show();
        }
        public void retrain()
        {

            Eigen_Recog = new ClassifierTrain();
            if (Eigen_Recog.IsTrained)
            {
                message_bar.Text = "Training Data loaded";
            }
            else
            {
                message_bar.Text = "No training data found, please train program using Train menu option";
            }
        }

        //Camera Start Stop
        public void initialise_capture()
        {
            grabber = new Capture();
            grabber.QueryFrame();
            Application.Idle += new EventHandler(FrameGrabber);
        }
        private void stop_capture()
        {
            Application.Idle -= new EventHandler(FrameGrabber);
            if (grabber != null)
            {
                grabber.Dispose();
            }
        }


        void FrameGrabber(object sender, EventArgs e)
        {
            //Get the current frame form capture device
            currentFrame = grabber.QueryFrame().ToImage<Bgr, byte>().Resize(320, 240, Emgu.CV.CvEnum.Inter.Cubic);

            //Convert it to Grayscale
            //Clear_Faces_Found();

            if (currentFrame != null)
            {
                gray_frame = currentFrame.Convert<Gray, Byte>();
                //Face Detector
                Rectangle[] facesDetected = Face.DetectMultiScale(gray_frame, 1.2, 10, new Size(50, 50), Size.Empty);
                Rectangle face = new Rectangle();
                //CircleF eyeDetected = eye;
                //Action for each element detected
                    try
                    {
                        face = facesDetected[0];
                        face.X += (int)(face.Height * 0.15);
                        face.Y += (int)(face.Width * 0.22);
                        face.Height -= (int)(face.Height * 0.3);
                        face.Width -= (int)(face.Width * 0.35);

                        result = currentFrame.Copy(face).Convert<Gray, byte>().Resize(100, 100, Emgu.CV.CvEnum.Inter.Cubic);
                        result._EqualizeHist();
                        //draw the face detected in the 0th (gray) channel with blue color
                        currentFrame.Draw(face, new Bgr(Color.Red), 2);

                        if (Eigen_Recog.IsTrained)
                        {
                            string name = Eigen_Recog.Recognise(result);
                            int match_value = (int)Eigen_Recog.Get_Eigen_Distance;

                            //Draw the label for each face detected and recognized
                            CvInvoke.PutText(currentFrame,
                            name + " ",
                            new System.Drawing.Point(face.X - 2, face.Y - 2),
                            FontFace.HersheyComplex, 0.5,
                            new Bgr(Color.LightBlue).MCvScalar);
                            //  ADD_Face_Found(result, name, match_value);

                        }

                    }
                    catch
                    {
                        //do nothing as parrellel loop buggy
                        //No action as the error is useless, it is simply an error in 
                        //no data being there to process and this occurss sporadically 
                    }
                
                //Show the faces procesed and recognized
                image_PICBX.Image = currentFrame.ToBitmap();
            }
        }

        //ADD Picture box and label to a panel for each face
        int faces_count = 0;
        int faces_panel_Y = 0;
        int faces_panel_X = 0;

        void Clear_Faces_Found()
        {
            this.Faces_Found_Panel.Controls.Clear();
            faces_count = 0;
            faces_panel_Y = 0;
            faces_panel_X = 0;
        }
        void ADD_Face_Found(Image<Gray, Byte> img_found, string name_person, int match_value)
        {
            PictureBox PI = new PictureBox();
            PI.Location = new Point(faces_panel_X, faces_panel_Y);
            PI.Height = 80;
            PI.Width = 80;
            PI.SizeMode = PictureBoxSizeMode.StretchImage;
            PI.Image = img_found.ToBitmap();
            Label LB = new Label();
            LB.Text = name_person + " " + match_value.ToString();
            LB.Location = new Point(faces_panel_X, faces_panel_Y + 80);
            //LB.Width = 80;
            LB.Height = 15;

            this.Faces_Found_Panel.Controls.Add(PI);
            this.Faces_Found_Panel.Controls.Add(LB);
            faces_count++;
            if (faces_count == 2)
            {
                faces_panel_X = 0;
                faces_panel_Y += 100;
                faces_count = 0;
            }
            else faces_panel_X += 85;

            if (Faces_Found_Panel.Controls.Count > 10)
            {
                Clear_Faces_Found();
            }

        }

        //Menu Opeartions
        private void exitToolStripMenuItem_Click(object sender, EventArgs e)
        {
            this.Dispose();
        }
        
        private void saveToolStripMenuItem_Click(object sender, EventArgs e)
        {
            SaveFileDialog SF = new SaveFileDialog();
            SF.Filter = "EigenFaceRecognizer File (*.EFR)|*.EFR";
             
            if (SF.ShowDialog() == DialogResult.OK)
            {
                Eigen_Recog.Save_Eigen_Recogniser(SF.FileName);
            }
        }
        private void loadToolStripMenuItem_Click(object sender, EventArgs e)
        {
            OpenFileDialog OF = new OpenFileDialog();
            OF.Filter = "EigenFaceRecognizer File (*.EFR)|*.EFR";
            if (OF.ShowDialog() == DialogResult.OK)
            {
                Eigen_Recog.Load_Eigen_Recogniser(OF.FileName);
            }
        }

        //Unknow Eigen face calibration
        private void Eigne_threshold_txtbxChanged(object sender, EventArgs e)
        {
            try
            {
                Eigen_Recog.Set_Eigen_Threshold = Math.Abs(Convert.ToInt32(Eigne_threshold_txtbx.Text));
                message_bar.Text = "Eigen Threshold Set";
            }
            catch
            {
                message_bar.Text = "Error in Threshold input please use int";
            }
        }
        
    }
}

