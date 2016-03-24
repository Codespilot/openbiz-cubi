# Openbiz Cubi Installation #

Users can follow the steps below to install Openbiz Cubi.
  1. Download Openbiz Cubi
  1. In your apache server, create a folder under htdocs. Let name it as "cubidev"
  1. Unzip cubi zip file to /cubidev/
  1. Run installation wizard by launching http://yourhost/cubidev/install in your browser.

## Requirements ##
PHP 5.1.x or later
PHP Extensions:
  * php\_pdo
  * php\_pdo\_mysql or other database pdo drivers
  * mcrypt

Apache 2.x
> - Some additional Apache modules may be needed (exipres, headers) due to the root level .htacess file.


## Installation Wizard ##

### Start Page ###
Assume your cubi is installed at wwwroot/cubidev/. You the launch the installation page by loading http://yourhost/cubidev/.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-start.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-start.jpg)

### Step 1: System Check ###
Please make sure the status column are all blue check icon. If more than one of them are red cross icon, please make the proper changes and click "Check Again" button.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-check.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-check.jpg)

### Step 2 - Database Configuration ###
This step is to setup default Cubi database. You can check the "Create Database" checkbox to ask the wizard to create a new cubi database. You can leave the checkbox unchecked to ignore creating a new database if you want to use an existing Cubi database.

In case the wizard catches database errors, the error message will be displayed at the right side of "Create Database" checkboxes. The error can be usually corrected by changing database host name, port, name, username or password.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-db.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-db.jpg)

### Step 3 - Application Configuration ###
This step to check the Cubi writable directories and display the default database setting. Please make sure the status column are all blue check icon. If more than one of them are red cross icon, please make the proper changes and click "Check Again" button.

In order to load all modules, please click on "Load modules" button. The system will take a few seconds to load all modules into database. After that, click next button to continue.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-load.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-load.jpg)

### Complete Page ###
The complete page tells the admin username and password. You can click "Launch Opebiz Cubi" button to go to Cubi login page. The page will take user to login page after 10 seconds.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-finish.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/install-finish.jpg)

Once the wizard is completed, a file "install.lock" is created under /cubi/. Next time, you load http://host/cubi/ will take you to login page.