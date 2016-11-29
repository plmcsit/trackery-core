from django.conf.urls import url

from help.templates import views

urlpatterns = [
    url(r'^$', views.index, name='index'),
]