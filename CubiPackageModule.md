# Cubi Package Management #

Cubi provides a set of tools to help application developers to manage their packages. On the other hand, Cubi end users can acquire packages through Cubi package module.

# Package Publication #
A Cubi package is a package of files that can be distributed and installed on Cubi platform. Two main tasks need to be done in order to publish a package.
  * Create a package
  * Put a package to repository

## Create Packages ##
A Cubi package file has extension "cpk". It is actually a zip archive.

Cubi has "package module" script to create a package of a module.
```
# php package_module.php module_name tag_name
```
Where tag\_name is a special tag you want to append in the package file name.

Assume we use this tool to create package for help module.
```
# php package_module.php help 001
```
The generated package file name is like cubi\_help-0.4\_T001\_20111215\_0822.cpk
  * 0.4 is the version number of the module. It is set in mod.xml
  * T001 is the tag name given in the 2nd parameter of package\_module command line
  * 20111215\_0822 is the date and time. 20111215\_0822 means the package is created at 8:22 December 15th, 2011.

Please keep in mind that the version needs to be increased for a new package in order to upgrade an existing module with lower version.

## Manage Package Repository ##
Package repository is the central place that lists all public available Cubi packages. Application providers can host their own repository by using Master Package module to manage it.

Please note that the master package is used to manage package repository, should not be distributed with Cubi end user applications.

### Package Categories ###
Package categories is a directory that contains packages. Package categories are organized as a tree structure. Each category may have none or one parent category, and multiple children categories.

Package category list

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/package_category_1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/package_category_1.png)

Add a new category

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/package_category_2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/package_category_2.png)

### Package Lists ###
The package lists contains Cubi packages that can be discovered by Cubi applications with package module installed. A valid package record should include
  * a package ID. Packages are usually defined using a hierarchical naming pattern, with levels in the hierarchy separated by periods (.). For example, user module package ID is "cubi.core.user".
  * a package name.
  * type
  * package category
  * version
  * author
  * description
  * release time
  * status
  * repository urls. The urls are download urls of the package file.

Package list

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/master_package_1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/master_package_1.png)

Edit a package

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/master_package_2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/master_package_2.png)

# Package Acquisition #
As an application administrator of Cubi system, he/she can find, install and upgrade Cubi packages from the package repository with either
  * Package command line tool
  * Package module

Both tools use Package Service located at /cubi/modules/package/lib/. You can change the RepositoryUrl attribute in PackageService.xml to point to your own package repository.
```
<?xml version="1.0" standalone="no"?>
<PluginService Name="PackageService" Class="PackageService" RepositoryUrl="http://hostname/cubi/ws.php/packagemstr/PackageListService" CacheLifeTime="7200">
</PluginService>
```


## Cubi Package command line tool ##
There is a package installer script under /cubi/bin/tools/. To install a package, run the script as following.
# php install\_pkg.php module\_name

The example below was run in Windows 7 with cubi installed under C:\xampp\htdocs\gcubi
```
C:\xampp\htdocs\gcubi\cubi\bin\tools>php install_pkg.php "Cubi Help Module"
>>> Package: cubi.module.help, Cubi Help Module, 0.4, http://localhost/gcubi/pkgs/CUBI_HELP/cubi_help-0.4_T001_20111215_0822.cpk

Downloading from http://localhost/gcubi/pkgs/CUBI_HELP/cubi_help-0.4_T001_20111215_0822.cpk ...

Downloading 8 KB of 9.9 KB

Downloading 9.9 KB of 9.9 KB

Completed download from http://localhost/gcubi/pkgs/CUBI_HELP/cubi_help-0.4_T001_20111215_0822.cpk ...

Unpack. C:\xampp\htdocs\gcubi\cubi/files/tmpFiles/cubi_help-0.4_T001_20111215_0822.cpk is unpacked to C:\xampp\htdocs\gc
ubi\cubi/files/tmpfiles/1325490438

copy C:\xampp\htdocs\gcubi\cubi/files/tmpfiles/1325490438/cubi_help/modules to C:\xampp\htdocs\gcubi\cubi/upgrade/modules

invoke module upgrade command

Start upgrading help module ...

--------------------------------------------------------

--------------------------------------------------------

Upgrade 'help' module from version 0.3 to 0.4. Please backup data first.
Press enter to continue ...

Backup source files to C:\xampp\htdocs\gcubi\cubi/backup/modules/help/0.3 ...

Copy source files from C:\xampp\htdocs\gcubi\cubi/upgrade/modules/help to C:\xampp\htdocs\gcubi\cubi\modules/help...

Execute upgrade sql files ...

[2012-01-01T23:49:49-08:00] Backup source files to C:\xampp\htdocs\gcubi\cubi/backup/modules/help/0.3 ...
[2012-01-01T23:49:50-08:00] Copy source files from C:\xampp\htdocs\gcubi\cubi/upgrade/modules/help to C:\xampp\htdocs\gc
ubi\cubi\modules/help...
[2012-01-01T23:49:50-08:00] Execute upgrade sql files ...

Reload module ...

```

## Cubi Package Module ##
If package module is installed in Cubi based application, it is the recommended approach to discover and install Cubi packages.

Public packages available. Click "Refresh" button to sync from package repository.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/local_package_1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/local_package_1.png)

Package details

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/local_package_2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/local_package_2.png)

Install package popup. Click "Start" to start download and install the package

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/local_package_3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/local_package_3.png)