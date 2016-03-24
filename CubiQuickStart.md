# Cubi Quick Start #

After Cubi is installed successfully, user can login Cubi and browse Cubi screens. This chapter will guide readers to build a simple Cubi module and add it into the Cubi navigation system.


## Create a Cubi Module ##

Assume we will build a module called “document”. This document module can be used in application like CRM or CMS.

First let’s make a database table “document”. The create table SQL is listed below.

```
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `create_by` int(11) DEFAULT '1',
  `create_time` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT '1',
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
```

Launch a database GUI or command line client, locate database that was created during Cubi installation wizard. Say the cubi database name is “cubi”. Run the document create table statement under “cubi” database.

## Generate Metadata ##

A Cubi module can be created manually or with a command line tool called “gen\_meta”. In this chapter, we will use gen\_meta tool which is a command line metadata and module generator. This tool allows user to create a new module in one click. It accomplishes the all manual steps in one shot.

First, launch a console - a DOS window or a Linux/Unix console. Say the cCubi is installed under /cubi/ folder. Change director to /cubi/bin/tools/. Then type in the following command.
# php gen\_meta.php Default document
Where “Default” is the first database name defined in /cubi/Config.xml, “document” is the table name.

Following the steps prompted by “gen\_meta”, always press “enter” to make choice suggested by the tool.

```
---------------------------------------
Please select metadata naming:
1. module path: \document, object name: Document
S. specify a custom module path and module name
Please select: [1/s] (1) :

Access control options:
1. Access and Manage (default)
2. Access, Create, Update and Delete
3. No access control
Please select access control type [1/2/3] (1) :

---------------------------------------
Target dir: C:\xampp\htdocs\cubidev\cubi\modules\document
Metadata file to create:
  do/DocumentDO.xml
  form/Document...Form.xml
  view/DocumentView.xml
Do you want to continue? [y/n] (y) :
---------------------------------------
Do you want to generate data Object? [y/n] (y) :
Generate Data Object metadata file ...
Start generate dataobject DocumentDO.
Create directory C:\xampp\htdocs\cubidev\cubi\modules/document/do
        /document/do/DocumentDO.xml is generated.
---------------------------------------
Do you want to generate form Object? [y/n] (y) :
Generate Form Object metadata files ...
Start generate form object DocumentListForm.
Create directory C:\xampp\htdocs\cubidev\cubi\modules/document/form
        /document/form/DocumentListForm.xml is generated.

Start generate form object DocumentNewForm.
        /document/form/DocumentNewForm.xml is generated.

Start generate form object DocumentEditForm.
        /document/form/DocumentEditForm.xml is generated.

Start generate form object DocumentDetailForm.
        /document/form/DocumentDetailForm.xml is generated.

Start generate form object DocumentCopyForm.
        /document/form/DocumentCopyForm.xml is generated.

---------------------------------------
Do you want to generate view Object? [y/n] (y) :
Generate view Object metadata files ...
Start generate form object DocumentListView.
Create directory C:\xampp\htdocs\cubidev\cubi\modules/document/view
        /document/view/DocumentListView.xml is generated.
---------------------------------------
Do you want to override mod.xml? [y/n] (y) :
Generate mod.xml ...
Start generate mod.xml.
        /document/mod.xml is generated.
```

After the command is executed, the following files are generated.
Module configuration file
  * /cubi\_root/modules/document/mod.xml
Module DO file
  * /cubi\_root/modules/document/do/DocumentDO.xml
Module Form file
  * /cubi\_root/modules/document/form/DocumentListForm.xml
  * /cubi\_root/modules/document/form/DocumentDetailForm.xml
  * /cubi\_root/modules/document/form/DocumentEditForm.xml
  * /cubi\_root/modules/document/form/DocumentNewForm.xml
  * /cubi\_root/modules/document/form/DocumentCopyForm.xml
Module View file
  * /cubi\_root/modules/document/view/DocumentListView.xml

## Load Module ##

In order to load the newly generated module into Cubi, “load\_module” (also called module loader) tool will be used. Module loader does the following work:
  * load module ACL setting
  * load module menu
  * load module resource
  * give Cubi admin full permissions to access this module

The output of running the command
```
# php load_module.php document
Start loading document module …
--------------------------------------------------------
[2011-02-16T23:59:10-08:00] Install Module.
[2011-02-16T23:59:10-08:00] Install Module ACL.
[2011-02-16T23:59:10-08:00] Install Module Menu.
[2011-02-16T23:59:10-08:00] Install Module Resource.
[2011-02-16T23:59:10-08:00] document is loaded.

Give admin to access all actions of module 'document'
--------------------------------------------------------
End loading document module
```

Let’s test this new module. If you have logged in Cubi site, please log out and re-login. Type in http://host/cubi/index.php/document/document_list, you should see screen like
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/quick_start1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/quick_start1.jpg)

## Edit Menu ##

In the above screen actually loads the “Document Management” view with a “Document” tab on top application tabs. But the left “Application Menu” is still the basic Cubi system menu. Let’s see how to change the left part to “document” menu.

First, we need to create a document menu by adding /cubi/modules/document/DocumentMenu.xml
```
<MenuWidget Name="DocumentMenu" Title="Document Menu" Class="menu.widget.MenuWidget" CssCLass="system" BizDataObj="menu.do.MenuTreeDO" SearchRule="[PId]='Document'" GlobalSearchRule="[published] = 1" MenuDeep="2" TemplateEngine="Smarty" TemplateFile="vertical_menu.tpl" CacheLifeTime="0">
</MenuWidget>
```

Open mod.xml, change the Menu element as
```
<Menu>
  <MenuItem Name="Document" Title="Document" URL="{@home:url}/document/document_list" Parent="" Order="10">
    <MenuItem Name="Document.Mgm" Title="Manage Document" Description=""  Order="10">
      <MenuItem Name="Document.List" Title="Document List" Description=""  URL="{@home:url}/document/document_list" Order="10"/>
    </MenuItem>	
  </MenuItem>	
</Menu>
```

Then add the following two lines in /cubi/modules/document/template/view.xml
```
$left_menu = "document.widget.DocumentMenu";
$this->assign('left_menu', $left_menu);
```

Execute the load module script again
# php load\_module.php document
...
Reload the page http://host/cubi/index.php/document/document_list, you should see the Document List View has document menu which is justed added un widget folder.
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/quick_start2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/quick_start2.jpg)