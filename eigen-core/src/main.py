import numpy as np
import sys
import os
import cv2
import webcam

import gfx

def ensure_dir_exists(path):
    if not os.path.isdir(path):
        os.mkdir(path)


def take_training_photos(name, image):
    facedata = "/home/aethelbert/Programming/PROGRAMMING/trackery-core-obj-1/eigen-core/haarcascade_frontalface_default.xml"
    cascade = cv2.CascadeClassifier(facedata)
    storage = "/home/aethelbert/Programming/PROGRAMMING/trackery-core-obj-1/public/img/faces/"
    img = cv2.imread(image)

    minisize = (img.shape[1],img.shape[0])
    miniframe = cv2.resize(img, minisize)
    faces = cascade.detectMultiScale(miniframe)
    fnum = len(faces)
    if fnum != 0:
        ct = faces.shape[0]
        f = faces[ct-1]
        x, y, w, h = [ v for v in f ]
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,255,255))

        sub_face = img[y:y+h, x:x+w]
        sub_face = gfx.Image(sub_face)
        sub_face = sub_face.scale(150, 150).gray()
        face_path = storage + "training_images_old/{}".format(name)
        ensure_dir_exists(face_path)
        sub_face.save_to('{}/{}.jpg'.format(face_path, 1))
        
        # ILLUMINATION FIX
        face = cv2.imread("{}/{}.jpg".format(face_path, 1))

        # NORMAL 
        # cv2.imshow(image, face)
        # cv2.waitKey(0)
        print "Image Trained Successfully!"
        idx1, idx2, idx3 = face.shape
        face = np.ravel(cv2.resize(face, (150,150)))    
        oldMean = np.mean(face, 0)
        imgState = "Normal"
        if oldMean < 125.00:
            imgState = "Dark"
        if oldMean > 190.00:
            imgState = "Bright"
        
        print imgState
        print oldMean

        newMean, face = fixIllumination(imgState, oldMean, face)
        print newMean
        face = np.reshape(face,(idx1, idx2, idx3))
        face_path = storage + "training_images/{}".format(name)
        cv2.imwrite('{}/{}.jpg'.format(face_path, 1), face)

        sub_face = gfx.Image(face)
        sub_face = sub_face.scale(150, 150).gray()
        ensure_dir_exists(face_path)
        sub_face.save_to('{}/{}.jpg'.format(face_path, 1))

        # cv2.imshow(image, face)
        # cv2.waitKey(0)
    else:
        print "No Face Found!"


def fixIllumination(state, oMean, imgF):
    newMean = 0
    ctr = 0
    
    if state == "Normal":
        newMean = oMean
    
    if state == "Bright":
        subtr = oMean - 190.00 - 1
        for pix in imgF:
            if (pix - subtr) >= 0:
                imgF[ctr] = pix - subtr
            if (pix - subtr) < 0:
                imgF[ctr] = 0
            ctr = ctr + 1
        newMean = np.mean(imgF, 0)
    
    if state == "Dark":
        addit = 125.00 - oMean + 1
        
        for pix in imgF:
            if (pix + addit) <= 255:
                imgF[ctr] = pix + addit
            if (pix + addit) > 255:
                imgF[ctr] = 255
            ctr = ctr + 1
        newMean = np.mean(imgF, 0)

    return newMean, imgF



def recognize_photo(name, image):
    facedata = "/home/aethelbert/Programming/PROGRAMMING/trackery-core-obj-1/eigen-core/haarcascade_frontalface_default.xml"
    cascade = cv2.CascadeClassifier(facedata)
    storage = "/home/aethelbert/Programming/PROGRAMMING/trackery-core-obj-1/public/img/faces/"

    img = cv2.imread(image)
    face1 = img
    minisize = (img.shape[1],img.shape[0])
    miniframe = cv2.resize(img, minisize)
    faces = cascade.detectMultiScale(miniframe)
    fnum = len(faces)
    if fnum != 0:
        
        ct = faces.shape[0]
        f = faces[ct-1]
        x, y, w, h = [ v for v in f ]
        cv2.rectangle(img, (x,y), (x+w,y+h), (255,255,255))

        sub_face = img[y:y+h, x:x+w]
        sub_face = gfx.Image(sub_face)
        sub_face = sub_face.scale(150, 150).gray()
        
        face_path = storage + "recognize_old/{}".format(name)
        ensure_dir_exists(face_path)
        sub_face.save_to('{}/{}.jpg'.format(face_path, 1))
        
        
        # ILLUMINATION FIX
        face = cv2.imread("{}/{}.jpg".format(face_path, 1))

        # NORMAL 
        # cv2.imshow(image, face)
        # cv2.waitKey(0)

        idx1, idx2, idx3 = face.shape
        face = np.ravel(cv2.resize(face, (150,150)))    
        oldMean = np.mean(face, 0)
        imgState = "Normal"
        if oldMean < 125.00:
            imgState = "Dark"
        if oldMean > 190.00:
            imgState = "Bright"
        
        # print imgState
        # print oldMean

        newMean, face = fixIllumination(imgState, oldMean, face)
        # print newMean
        face = np.reshape(face,(idx1, idx2, idx3))
        face_path = storage + "recognize/{}".format(name)
        cv2.imwrite('{}/{}.jpg'.format(face_path, 1), face)

        sub_face = gfx.Image(face)
        sub_face = sub_face.scale(150, 150).gray()
        ensure_dir_exists(face_path)
        sub_face.save_to('{}/{}.jpg'.format(face_path, 1))


        # cv2.imshow(image, face)
        # cv2.waitKey(0)
        face_detector = gfx.FaceDetector()
        face_detector.show(gfx.Image(face1), wait=False)
        # cv2.waitKey(0)
    else:
        print "Unknown."


def parse_command():
    args = sys.argv[1:]
    return args[0] if args else None


def print_help():
    print("""Usage: <option> <name> <path>
    Options:
    train - takes picture from path to train trackery to recognize a face.
    demo - takes picture from path and tries to recognize faces.
    """)



def main():
    if not (len(sys.argv) == 4):
        print_help()
        sys.exit()

    func = sys.argv[1]
    name = sys.argv[2]
    path = sys.argv[3]
    if func == 'train':
        take_training_photos(name, path)
    elif func == 'demo':
        recognize_photo(name, path)



if __name__ == '__main__':
    main()

