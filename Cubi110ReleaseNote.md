# General Introduction: #
Openbiz Cubi Platform is a php based rapid application development platform.
The goal of Cubi is to provide commonly used modules and a set of tools in a platform level.
It will boost the productivity of all types of web application development.
Since the project starts from 2003, It has been growing to a full-featured application platform.

Cubi provides the support for above common tasks so that developers can really focus on implementation business logic.
Among all web applications, the most common tasks for administrator are:
User Module,  Theme Module,  System Module,  Session Module,
Service Module,  Security Module,  Package Module
Menu Module,  Help Module,  EventLog Module,  Email Module,
Cronjob Module,  Cache Module,  Attachment Module and  Backup Module and etc

# New Features: #
  * FusionChart based ChartForm available for developers.
  * Scheduled database backup feature is available, it called by cronjob service
  * Change Log form features , this feature can helps developer easy to trace data changes.also there is a ready to use UI widget for end-user review their data changes.

# Enhancement: #
  * Added supports for setup user default role on user detail page
  * Added icons for email queue manager
  * General UI enhancement new icon sets for Cubi forms
  * Module management added single click
  * Support locale based localization style css
  * Advanced data assignment feature
  * Data share support change log feature
  * Auto remember the last name display style
  * Daily backup feature

# Bug Fixes: #
  * Fixed display bugs and tested compatible with IE 6 browsers
  * Fixed display bugs and tested compatible with IE 7 and IE 8 browsers
  * Fixed bug in contact template
  * Fixed Cubi import CSV form UI bug
  * Fixed Backup Download bug
  * Fixed Cubi import CSV form UI bug
  * Fixed Cubi appPath bug
  * Openbiz doTriggerService process multi actions per trigger
  * many minor feature bugs fix.

# Requirement #
  * PHP version greater than 5.3
  * PHP extensions:  pdo\_mysql
  * Apache version greater than 2.0
  * Apache modules: mod\_rewrite, mod\_expires
  * MySQL version greater than 5.0
  * Linux/Unix operation system `*`1

About Mac OS, Cronjob, Backup, Phing are need some system command or feature to works,
if it has to run on Windows platform , don't  worry the system general features will still functional.

# How to Install #
To install a fresh instance of Openbiz Cubi please follow below steps:
  1. Prepare your running environment like requirement described.
  1. Download the release zip package
  1. Extract the zip file into your web root folder.
  1. Give the root folder a writeable permission for your web server's user.
> > for linux: **chmod -R 777 ./cubi/**
  1. Open your browser and goto http://localhost/ following the system initial guide.
  1. Done! Start your new develop life with cubi !

About database setting will be prompt during the system installation
Cubi can create database instance for it self if you give it a root permission of your database.
or You may want it runs under a low privilege account, then you need to manual create the database and set it during installation

# How to upgrade #
To upgrade your Openbiz Cubi instance from a existing version, you need to follow below steps:
  1. Backup all your existing data !
  1. Download the release zip package
  1. Extract the zip file into your a new folder.
  1. Delete following files from the folder
  * /Application.xml
  * /bin/app\_init.php
    1. Copy and override all files to your existing running cubi folders
    1. in each major release , there might be some module version changes.
You need to login cubi as administrator and go to module management and click "Load Module" button to load all new changes.
    1. Logout by click the logout link in right-top conner , and re-login the system.
    1. Done!, Now enjoy and upgrade your apps to use new features.

# License #
Openbiz Framework and Openbiz Cubi is released under BSD License
Some jQuery based UI component of Openbiz Cubi like release under GPL License

# Screenshots #
Advanced data assignment feature
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_release/1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_release/1.png)

Data share support change log feature
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_release/2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_release/2.png)

General UI enhancement new icon sets for Cubi forms
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_release/3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_release/3.png)