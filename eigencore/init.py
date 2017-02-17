# Necessary modules imported
import numpy as np
import sys
import cv2
from EigenFace import *

# Ensuring correct arguments
# if not len(sys.argv) == 3:
# 	print "Usage : %s <trainFile> <dataDir>" % sys.argv[0]
# 	sys.exit()

curDir = os.getcwd() + os.sep
trainFile = "/home/shinzangetsu/Programming/trackery-core/eigencore/data/train.txt"
dataDir = "/home/shinzangetsu/Programming/trackery-core/eigencore/data"

trainList = loadListFromFile(trainFile)
mean, eiVals, eiVecs = train(trainList)

saveModel(dataDir, mean, eiVecs)

print "Success!"