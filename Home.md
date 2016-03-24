[![](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_intro/cubi_banner.jpg)](http://code.google.com/p/openbiz-cubi/downloads/list)
[![](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/screenshots.png)](http://code.google.com/p/openbiz-cubi/wiki/CubiScreenShots)
## Openbiz Cubi Platform ##
Openbiz Cubi Platform is a php based rapid application development platform.
The goal of Cubi is to provide commonly used modules and a set of tools in a platform level. It will boost the productivity of all types of web application development.
Since the project starts from 2003, It has been growing to a full-featured application platform.

### Openbiz-Cubi various modules ###
Cubi provides the support for above common tasks so that developers can really focus on implementation business logic.
Among all web applications, the most common tasks for administrators are

  * [Cubi User Module](CubiUserModule.md)
  * [Cubi Theme Module](CubiThemeModule.md)
  * [Cubi System Module](CubiSystemModule.md)
  * [Cubi Session Module](CubiSessionModule.md)
  * [Cubi Service Module](CubiServiceModule.md)
  * [Cubi Security Module](CubiSecurityModule.md)
  * [Cubi Package Module](CubiPackageModule.md)
  * [Cubi Menu Module](CubiMenuModule.md)
  * [Cubi Help Module](CubiHelpModule.md)
  * [Cubi EventLog Module](CubiEventLogModule.md)
  * [Cubi Email Module](CubiEmailModule.md)
  * [Cubi Cronjob Module](CubiCronjobModule.md)
  * [Cubi Cache Module](CubiCacheModule.md)
  * [Cubi Attachment Module](CubiattAchmentModule.md)
  * [Cubi Backup Module](CubiBackupModule.md)

### Openbiz Cubi Learn guide ###
  * [Learn Cubi By Examples](LearnCubiByExamples.md)
  * [Cubi Quick Start Build Application](CubiQuickStart.md)
  * [How to Write a Cubi Module](CubiWriteModule.md)

### Openbiz Cubi Technology Documents ###
  * [Openbiz Framework Architecture](OpenbizFrameworkArchitecture.md)
  * [Openbiz Framework DataObject](OpenbizFrameworkDataObject.md)
  * [Openbiz Framework Metadata](OpenbizFrameworkMetadata.md)
  * [Openbiz Framework Overview](OpenbizFrameworkOverview.md)
  * [Openbiz Framework Service](OpenbizFrameworkService.md)
  * [Openbiz Framework UI](OpenbizFrameworkUI.md)
  * [Openbiz Inverse of Control container ](OpenbizIoC.md)
  * [Template\_Perfromance](Template_Perfromance.md)
  * [Cubi CleanURL](CubiCleanURL.md)
  * [Cubi CIME](CubiCIME.md)
  * [Cubi Build](CubiBuild.md)
  * [Cubi Browser Script](CubiBrowserScript.md)
  * [Cubi Access Control](CubiAccessControl.md)


### Openbiz Cubi Advanced Features ###
  * [Openbiz Cubi Features](OpenbizCubiFeatures.md)
  * [Cubi Write Theme](CubiWriteTheme.md)
  * [Cubi Report Application](CubiReportApplication.md)
  * [Cubi MyAccount](CubiMyAccount.md)
  * [Cubi Multi-language Support](CubiI18N.md)
  * [Cubi Core Concepts](CubiCoreConcepts.md)
  * [Cubi Convention](CubiConvention.md)
  * [Cubi Command Line](CubiCommandLine.md)
  * [Cubi Package Management Module](CubiPackageModule.md)

### Run-time requirement ###
Openbiz Cubi can be run in Unix, Windows, Mac server supporting PHP. Other runtime environment includes
  * Web server. E.g. Apache, IIS
  * Database server. E.g. MySQL, MSSQL, Oracle, PgSQL and databases supported in Zend\_DB
  * PHP 5.2 and above

If you are new to PHP, WAMPServer (http://www.wampserver.com/en/) is recommended for quick setup of web server, database and PHP.


### Install Openbiz-Cubi ###
  1. Download Openbiz Cubi
  1. In your apache server, create a folder under htdocs. Let name it as "cubidev"
  1. Unzip cubi zip file to /cubidev/
  1. Run installation wizard by launching http://yourhost/cubidev/install in your browser. The wizard will guide users to go through
    * system check
    * database creation
    * module loading
    * application configuration
    * installation confirmation