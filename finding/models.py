from __future__ import unicode_literals
from django.db import models
import uuid

name = ""


def get_upload_to(instance, filename):
    global name
    instance.uuid = uuid.uuid4().hex
    return 'find/%s/%s' % (instance.uuid, name)


# Create your models here.
class FindImage(models.Model):
    global name
    image_name = models.TextField(blank=False)


    def set_name(self):
        self_name = self.image_name
        return self_name

    name = set_name()

    image_upload = models.ImageField(upload_to=get_upload_to)


    def __str__(self):
        return name


