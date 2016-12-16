# Necessary modules imported
import numpy as np
import sys
import cv2
import os

# Constants
dim = (32, 32)
# cv2.imread(trainList[0], 0).shape


def loadListFromFile(filePath):
    return map(lambda path: path.strip(), open(filePath, 'r').readlines())


def train(trainList):
    trainset = [ np.ravel(cv2.imread(path, 0)) for path in trainList ]
    N = len(trainset)

    # Computing mean image
    mean = np.mean(trainset, 0)
    # print N, np.array(trainset).shape, mean.shape

    cov = lambda mat: np.dot(np.reshape(mat-mean, (-1, 1)), np.reshape(mat-mean, (1, -1)))
    C = (1.0/N)*np.array(np.sum((map(cov, trainset)), 0))

    w, v = np.linalg.eig(C)

    return mean, w, v


def computeCoeff(img, mean, eiVecs):
    imgR = np.ravel(cv2.resize(img, dim)) - mean
    coeff = map(lambda v: np.dot(v, imgR), eiVecs)
    return coeff


def computeLoss(tmpl, pred):
    # L2 Loss
    loss = float(np.real(np.sqrt(np.sum((pred-tmpl)*np.conj(pred-tmpl)))))
    return loss


# Incomplete
def test(testList, eiVecs):
    temp = map(lambda line: line.split(' '), testList)
    testset = [np.ravel(cv2.resize(cv2.imread(path, 0), dim)) for path in temp[:, 0]]
    testLabels = temp[:, 1]

    output = [computeCoeff(img, eiVecs) for img in testset]
    # data = load("templates")

    # TODO : Compute loss and give a match
    return output


def saveTemplate(tmplDir, label, coeff):
    np.save(tmplDir + os.sep + label, coeff)


def loadTemplates(tmplDir):
    data = {}
    for name in os.listdir(tmplDir):
        if name.endswith(".npy"):
            data[name.replace(".npy", "")] = np.load(tmplDir + os.sep + name)

    return data


def loadModel(dataDir):
    return np.load(dataDir + os.sep + "mean.npy"), np.load(dataDir + os.sep + "model.npy")


def saveModel(dataDir, mean, eiVecs):
    np.save(dataDir + os.sep + "mean", mean)
    np.save(dataDir + os.sep + "model", eiVecs)

