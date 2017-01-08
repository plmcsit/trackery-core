# Necessary modules imported
import numpy as np
import sys
import cv2
from EigenFace import *
from path import train_path

dataDir = train_path("data")
tmplDir = train_path("templates")
label = sys.argv[1]
imgDir = sys.argv[2]
mode = train_path("mode")

# label = train_path("label")
# imgDir = train_path("image")


mean, eiVecs = loadModel(dataDir)
img = None

if mode == "image":
    img = cv2.imread(imgDir, 0)


coeff = computeCoeff(img, mean, eiVecs)
saveTemplate(tmplDir, label, coeff)


facesG = None
faceIdx = None


def chooseFace(event, x, y, flags, param):
    global faceIdx
    if event == cv2.EVENT_LBUTTONUP:
        if not facesG == None:
            idx = 0
            for(_x, _y, _w, _h) in facesG:
                if x>_x and x<_x+_w and y>_y and y<_y+_h:
                    # print idx
                    faceIdx = idx
                    break
                idx += 1

