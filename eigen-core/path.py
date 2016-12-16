import os
curDir = os.getcwd() + os.sep


# PATHS
def train_path(s):
    if s == "mode":
        ret = "image"
    elif s == "data":
        ret = curDir + "data"
    elif s == "templates":
        ret = curDir + "templates"
    elif s == "label":
        ret = "Timbs"
    elif s == "image":
        ret = curDir + "test/teach/4.jpg"
    return ret


def recognize_path(s):
    if s == "mode":
        ret = "image"
    elif s == "data":
        ret = curDir + "data"
    elif s == "templates":
        ret = curDir + "templates"
    elif s == "image":
        ret = curDir + "test/recognize/4.jpg"
    return ret

