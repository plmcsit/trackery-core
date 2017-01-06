from django.http import HttpResponse
from django.shortcuts import render
from home.scripts.init import init_face
from home.scripts.init import disp_loc
# Create your views here.


def index(request):
    #return disp_loc()
    return render(request, 'home/index.html')

