# Release Note #

## Version Cubi v2.1 ##

### Key Features for 2.0 Release ###

#### Mobile Browser Support ####
New touch theme for Mobile UI. Openbiz Cubi is now fully support mobile smarty phone browsers. Tested with iPhone and Android. Thanks to the beautiful jQueryMobile framework! See more details at CubiMobileSupport

#### Drag-n-drop Dashboard ####
Support iGoogle like drop-n-drop Dashboard. User can add widgets in the dashboard and change their position as he/she wants. Adding a widget in Cubi is easy, just add an entry in `<Widget>` section of mod.xml. See more details at CubiDashboard

#### Contact Module Shows off the New UI ####
Contact module is added into the top application tab. Cubi Contact module provides the common functions for users to manage their contacts. This module also demonstrate many advanced UI enhancements made in latest Cubi release. See more details at CubiContactModule.

#### Pure jQuery Support ####
In Cubi 2.1, you can choose jQuery.js as the base javascript library instead of prototype.js. Yes, all jQuery UI plugins are easy to add to the system. For backward compatible reason, prototype is still on by default. You can switch to jQuery only mode by define('JSLIB\_BASE', "JQUERY"); in cubi/app\_init.php

## Version Cubi v2.0 ##

### General Introduction: ###

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

## Key Features for 2.0 Release ##

## Openbiz App Market: ##

After Openbiz 2.0 , As a system end user will be able to fetch their interesting software application via integrated Openbiz App Market.
and future system upgrade could be automatic done on Market UI, end users will no longer need to touch the system files and explore many new published application like your Andriod Market on mobile.
It means Openbiz Products are coming to End Users for developers.

## Openbiz App Repository: ##

As a Openbiz App Developer, now you can easily create your own repository and publish your application directly to users system.
Without worry about marketing and publishing issues. since users subscribed your repository, All your future updates can easily push to users system via new system notification feature.
From now lets starts to develop your own user base with Openbiz Solutions.

## Application License supports: ##

Not only open source, Openbiz Cubi Platform is also ready for commercial software venders.
We are fully support with Ioncube Encoder solution. you can encode your source code(Including Metadata and UI templates ) by IonCube.
also setup software license protection . Openbiz Cubi will handle and guide users to register and active your product.
Get ready for base on our OpenSource big user base to develop your commercial product.

## Since Version 2.0 ##

## New Features: ##
  * Added Openbiz App Market Module can helps users easy to install or upgrade Cubi based Applications
  * Added Openbiz App Repository Module can helps developers to publish their application in Cubi Platform
  * Added System Notification module. it can notice software updates and new release
  * New system name option available in system preference ,
  * User can custom their Cubi instance name. and it will be display as the first part of Page title. Concurrent Session Strict feature available in system preference , it can limit concurrent sessions for each user.
  * Support Multiple Currency feature to format and display currency data, used by Collaboration Taks/Project expense feature.
  * Data Share ACL Feature, this feature support to setup an Access Control List for each shared data record. you can specify a list of users about who can read or edit this record.
  * Added Data Manager Role , this role will allow users to see and manage all data records, ignore the system PermStrict service.
  * Added Data Assigner feature, this feature will let user able to share or received data from other group users, by default the data share scope will limit to user same group users
  * DataObject's ORM supports self to self reference logic
  * DataObject's ORM supports 1-M reference with 2 condition logic
  * Ioncube encoded files supports, this feature can let developer publish their close source(including source code, template and metadata ) Application on Cubi Platform
  * License manager clients this module can help end-user active their applications

## Enhancement: ##
  * Enhanced Role and Group management view. added an associated user picker feature.
  * Added BizSystem::GetProfileID($user\_id) interface
  * DropDownList component auto remember last selected option
  * Enhanced list widget form display effect, supports on mouse over highlight row
  * LabelText and its inherited component support strip tags option
  * EasyForm supports form level default sortRule feature
  * Backup module list backup archives supports sort by time feature
  * Added RequireAuth option to web service API
  * Fuzzy URL redirect, if only specified module name in request URL, it will auto redirect user to default view of specified module

## Bug Fixes: ##

  * Email queue view display HTML code issue
  * Fixed a session management issue, logged user will no longer being prompt to login again

## Since Version 1.1 ##

## New Features: ##

  * FusionChart based ChartForm available for developers.
  * Scheduled database backup feature is available, it called by cronjob service
  * Change Log form features , this feature can helps developer easy to trace data changes.also there is a ready to use UI widget for end-user review their data changes.

## Enhancement: ##
  * Added supports for setup user default role on user detail page
  * Added icons for email queue manager
  * General UI enhancement new icon sets for Cubi forms
  * Module management added single click

## Bug Fixes: ##
  * Fixed display bugs and tested compatible with IE 6 browsers
  * Fixed display bugs and tested compatible with IE 7 and IE 8 browsers
  * many minor feature bugs fix.


## Requirement ##

  * PHP version greater than 5.3
  * PHP extensions:  pdo\_mysql , curl,  gd, simpleXML, ioncube\_loader( optional to run encoded apps )
  * Apache version greater than 2.0
  * Apache modules: mod\_rewrite, mod\_expires
  * MySQL version greater than 5.0
  * Linux/Unix operation system

About OS, Cronjob, Backup required some system command or feature to works,
if it has to run on Windows platform , don't  worry the system general features will still functional.

## How to Install ##

To install a fresh instance of Openbiz Cubi please follow below steps:

## Method A: Install from source code archive file: ##

  1. Prepare your running environment like requirement described.
  1. Download the release zip package
  1. Extract the zip file into your web root folder.
  1. Give the root folder a writeable permission for your web server's user.
  1. Open your browser and goto http://localhost/ following the system initial guide.
  1. Done! Start your new develop life with Cubi !

About database setting will be prompt during the system installation
Cubi can create database instance for it self if you give it a root permission of your database.
or You may want it runs under a low privilege account, then you need to manual create the database and set it during installation

## Method B: Install from Windows Installer release: ##

  1. Download the Openbiz Cubi installer from our official website.
  1. Run it on your local windows machine , (Windows XP , Windows  Vista or Windows7 )
  1. Choose the install destination of  this instance, Could install on a remote server(recommended) or your local machine.
  1. Follow the installation guide step by step.
  1. Done! Start your new develop life with Cubi !

## Method C: Using Openbiz Cubi Suite install ##
  1. Download the Openbiz Cubi Suite exe file from our office website.
  1. Run the exe file to install it and the package will auto install Apache Mysql PHP PHPmyadmin and Cubi for you.

# How to upgrade #

To upgrade your Openbiz Cubi instance from a existing version, you need to follow below steps:
  1. Backup all your existing data !
  1. Download the release zip package
  1. Extract the zip file into your a new folder.
  1. Delete following files from the folder
> > /Application.xml  and /bin/app\_init.php
  1. Copy and override all files to your existing running Cubi folders
  1. if you are upgrade system from version 1.x to 2.x , You need to manual import module/market/mod.install.sql and module/notification/mod.install.sql  to your cubi database.
  1. in each major release , there might be some module version changes. You need to login cubi as administrator and go to module management and click "Load Module" button to load all new changes.
  1. Logout by click the logout link in right-top conner , and re-login the system.
  1. Done!, Now you can discover in new Openbiz Market to download and test you interested Apps.

# License #

Openbiz Framework and Openbiz Cubi is released under BSD License
Some jQuery based UI component of Openbiz Cubi like release under GPL License