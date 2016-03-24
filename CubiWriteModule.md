# How to write a Cubi module #

The chapter of “Cubi Quick Start” describes creating a module with “gen\_mod” tool. The chapter covers more about writing a Cubi module. Readers can also get more understanding of Cubi module structure.

## Manually create a module ##

You can follow the steps below to create a module manually.
  1. Define a module name and create a directory under modules/. Assume the module name is abc in the rest steps.
  1. Compose module description file under modules/abc/mod.xml. A sample mod.xml is like
```
<Module Name="abc" Description="abc is a new module" Version="0.1" Author="your name" OpenbizVersion="2.4">
</Module>
```
  1. Create subfolders
    * do. This folder to hold dataobject metadata and class files
    * form. This folder contains form metadata and class files
    * view. This folder contains form metadata and class files
    * template. This folder contains template files for form and view of this module.
    * lib.  This folder contains supporting php class files
  1. Compose metadata and php class files in proper subfolders
    * first copy subfolders of an existing module to /modules/abc/
    * enter abc/do/, rename dataobj xml file to AbcDO.xml and modify ("Name", "Title", "Table") attributes and "BizField" elements
    * enter abc/form, rename form xml file to Abc...Form.xml and modify ("Name", "Title", "BizDataObj") attribute and "Element" elements
    * enter abc/view, rename view xml file to Abc...View.xml and modify ("Name", "Title") attributes and "Reference" elements
  1. Test a view with url like http://host/cubi/index.php/abc/abc_list.
  1. Add ACL, Menu, Dependency elements in mod.xml
```
<Module Name="abc" Description="abc is a new module" Version="0.1" Author="your name" OpenbizVersion="2.4">
  <ACL>
    <Resource Name="Abc">
      <Action Name="Administer_Abc" Description="Can Abc data"/>
    </Resource>
  </ACL>
  <Menu>
    <MenuItem Name="Abc" Title="Manage Abc" URL="{@home:url}/abc/abc_list" Parent="System" Order="60"/>
  </Menu>
  <Dependency>
    <Module Name="system"/>
  </Dependency>
</Module>
```

## Create module with metadata generator ##

This was described in the Cubi Quick Start chapter.

## SQL to install ##

A typical module will have database schema change (e.g. add tables). The database SQL statements need to be copied to /cubi/modules/mod\_name/mod.install.sql. The file can include “create table” statements for table creation and “insert into” statements for data initialization.