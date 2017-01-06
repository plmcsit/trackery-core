# eigenFaces
Face recognition using Eigen faces method

**init.py**

Initialises eigen vectors

**teach.py**

Learns and stores eigen coefficients

**recognize.py**

Recognizes faces

## Dependencies

* OpenCV 2.4.9+

* Numpy

## Trial

* Initialize eigen vectors:

```
$ python init.py data/train.txt data
```

* Teach faces ( from an image/video ):

```
# Teach an image
$ python teach.py data templates <label-your_name> image /path/to/image

# Teach from a video
$ python teach.py data templates <label-your_name> video
```

* For realtime face recognition:

```
# Recognize an image
$ python recognize.py data templates image /path/to/image

# Recognize faces from a live video feed
$ python recognize.py data templates video
```

The code can be reused with any other face dataset by regenerating `data/train.txt` appropriately.

## Sample outputs

<img src = "https://raw.githubusercontent.com/Aravind-Suresh/eigenFaces/master/images/sample_outputs/1.png" width = "40%" />
<br><br>

## Dataset

[Yale faces dataset](http://vision.ucsd.edu/content/yale-face-database)


## References
Matthew A. Turk and Alex P. Pentland - "Face recognition using Eigenfaces"
