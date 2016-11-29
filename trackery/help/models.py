from __future__ import unicode_literals

from django.db import models


# Create your models here.
class Face(models.Model):
    name = models.CharField(max_length=100)
    location = models.CharField(max_length=200)
    image_1 = models.ImageField(default=None, blank=True, null=True)
    image_2 = models.ImageField(default=None, blank=True, null=True)
    image_3 = models.ImageField(default=None, blank=True, null=True)
    message = models.CharField(max_length=200)

    def __str__(self):
        return self.name
