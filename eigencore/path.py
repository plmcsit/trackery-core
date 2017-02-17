import os
curDir = os.getcwd() + os.sep


# PATHS
def train_path(s):
    if s == "mode":
        ret = "image"
    elif s == "data":
        ret = "/home/shinzangetsu/Programming/trackery-core/eigencore/data"
    elif s == "templates":
        ret = "/home/shinzangetsu/Programming/trackery-core/eigencore/templates"
    elif s == "label":
        ret = "Timbs"
    elif s == "image":
        ret = "/home/shinzangetsu/Programming/trackery-core/eigencore/test/teach/4.jpg"
    return ret


def recognize_path(s):
    if s == "mode":
        ret = "image"
    elif s == "data":
        ret = "/home/shinzangetsu/Programming/trackery-core/eigencore/data"
    elif s == "templates":
        ret = "/home/shinzangetsu/Programming/trackery-core/eigencore/templates"
    elif s == "image":
        ret =  "/home/shinzangetsu/Programming/trackery-core/eigencore/test/recognize/4.jpg"
    elif s == "face":
        ret = "/home/shinzangetsu/Programming/trackery-core/eigencore/xmls/haarcascade_frontalface_default.xml"
    return ret

    