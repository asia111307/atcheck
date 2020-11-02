# @CHECK

## About
@CHECK (atcheck) is a project, which initially was meant only to be a term project, and eventually became the topic of [publication for the EDULEARN20 conference](https://library.iated.org/view/JASSEM2020@CH). 

This program works with a student ID card reader and is intended to make it easier for lecturers to check attendance - 
when entering the class, students register their presence with their ID card and choose a place in the classroom they want to take. 
Thanks to this, the lecturer can monitor who the seats belong to and has the attendance checked at the same time. 
In addition, the program offers adding notes, choosing from several modes of checking presence and exporting lists to .xls. 

The system was to be implemented at the Faculty of Mathematics and Computer Science of the Adam Mickiewicz University, 
but eventually this did not happen.

See (and try!) @CHECK online: http://atcheck.herokuapp.com/. Use *jan@kowalski.com* as an email and *testuser* as a password to login.

## Authors and tools
@CHECK system was developed by Joanna Paliwoda and [Bartłomiej Wierzbiński](https://pl.linkedin.com/in/bart%C5%82omiej-wierzbi%C5%84ski-494795b5) from Adam Mickiewicz University in Poznań. 

It consists of two main parts:
- web application
- desktop application that works with ID card reader

The web app was build with [jQuery Seat Charts](https://github.com/mateuszmarkowski/jQuery-Seat-Charts), [Bootstrap 4](https://getbootstrap.com/) and [Laravel](https://laravel.com/) by Joanna Paliwoda under the supervision of 
[Bartłomiej Wierzbiński](https://pl.linkedin.com/in/bart%C5%82omiej-wierzbi%C5%84ski-494795b5), who was responsible for building the desktop app working with both card reader and web app. 

The main purpose of this repository is to show the web part of the project. This repository does not contain the code of desktop app.


