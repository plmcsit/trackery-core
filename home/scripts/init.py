# Necessary modules imported
from EigenFace import *
from path import init_path
from django.http import HttpResponse


def disp_loc():
    return HttpResponse(init_path("train"))

def init_face():
    curDir = os.getcwd() + os.sep
    trainFile = init_path("train")
    dataDir = init_path("data")

    trainList = loadListFromFile(trainFile)
    mean, eiVals, eiVecs = train(trainList)

    saveModel(dataDir, mean, eiVecs)

