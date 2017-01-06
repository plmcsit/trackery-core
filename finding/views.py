from django.http import HttpResponse
from django.shortcuts import render
from finding.scripts.recognize import startrecognize
# Create your views here.


def index(request):
    #return startrecognize()
    return render(request, 'finding/index.html')
