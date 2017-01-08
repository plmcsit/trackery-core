# Necessary modules imported
import numpy as np
import sys
import cv2
from EigenFace import *

# Ensuring correct arguments
if not len(sys.argv) == 3:
	print "Usage : %s <trainFile> <dataDir>" % sys.argv[0]
	sys.exit()

curDir = os.getcwd() + os.sep
trainFile = sys.argv[1]
dataDir = curDir + sys.argv[2]

trainList = loadListFromFile(trainFile)
mean, eiVals, eiVecs = train(trainList)

saveModel(dataDir, mean, eiVecs)
