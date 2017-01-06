import os
curDir = os.getcwd() + os.sep


# PATHS
def train_path(s):
    if s == "mode":
        ret = "image"
    elif s == "data":
        ret = curDir + "files/data"
    elif s == "templates":
        ret = curDir + "files/templates"
    elif s == "label":
        ret = "Timbs"
    elif s == "image":
        ret = curDir + "files/test/teach/4.jpg"
    return ret


def recognize_path(s):
    if s == "mode":
        ret = "image"
    elif s == "data":
        ret = curDir + "files/data"
    elif s == "templates":
        ret = curDir + "files/templates"
    elif s == "image":
        ret = curDir + "files/test/recognize/4.jpg"
    elif s == "face":
        ret = curDir + "files/xmls/haarcascade_frontalface_default.xml"
    return ret


def init_path(s):
    if s == "train":
        ret = "data/train,txt"
    elif s == "data":
        ret = curDir + "data"
    return ret

