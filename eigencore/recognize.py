# Necessary modules imported
import numpy as np
import sys
import cv2
from EigenFace import *
from path import recognize_path


dataDir = recognize_path("data")
tmplDir = recognize_path("templates")


mean, eiVecs = loadModel(dataDir)
tmplData = loadTemplates(tmplDir)


def predict(img):
    coeffPred = computeCoeff(img, mean, eiVecs)
    temp = dict(map(lambda (k, v): (k, computeLoss(v, coeffPred)), tmplData.iteritems()))
    labelPred = min(temp, key=temp.get)
    return labelPred, temp[labelPred]



def startrecognize():
    curDir = os.getcwd() + os.sep
    mode = recognize_path("mode")
    imgDir = recognize_path("image")

    img = None
    cascade = recognize_path("face")
    faceCascade = cv2.CascadeClassifier(cascade)

    if mode == "image":
        img = cv2.imread(imgDir)
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        faces = faceCascade.detectMultiScale(gray, 1.3, 5)
        for (x, y, w, h) in faces:
           labelPred, loss = predict(gray[y:y+h, x:x+w])
           font = cv2.FONT_HERSHEY_SIMPLEX
           cv2.putText(img, labelPred + ', ' + str(loss), (x+w/2,y-10), font, 0.6, (255, 255, 255), 1)
           cv2.rectangle(img, (x,y), (x+w,y+h),(255,0,0),2)
        cv2.imshow("Img", img)
        cv2.waitKey(0)

