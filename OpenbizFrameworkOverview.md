# Openbiz Overview #

## What is Openbiz ##

Openbiz is application framework that provides an object-oriented metadata-driven platform for application developers to build web application with least possible programming code. Openbiz framework started from 2003 and has been continuously improved by community developers and user feedback. It has been used in many real world applications world wide.

Openbiz framework focuses on assisting developers to implement application level logic more efficiently. In order to achieve that, the framework counts on it core “metadata-driven” concept. With the power of Openbiz xml metadata, developers can

  * Declare the mapping between database tables to data objects (ORM)
  * Declare how to present the data to user interface
  * Declare the behaviors of objects and relationship between objects
  * Describe data CRUD operations, data query, data validation, template, access control, navigation flow, cache, multiple database …
  * Declare the location of custom class or service

A typical Openbiz application has 80% metadata and 20% programming code.

Besides the metadata kernel, Openbiz is a fully object-oriented multi-layer system. It adopts advanced web technology like MVC, AJAX, and leverages the industry leading open source libraries, e.g. Zend Framework and Smarty template engine.

Openbiz framework is released under BSD license. It is free to be used in any open source and commercial applications.

## Openbiz and Cubi ##

Cubi was initially a reference application built on top of Openbiz framework. It has been growing to be an application platform which includes the most commonly used components needed for a business or web application.

Cubi also provides a set of tools to manage metadata, manage module, generate language package, generate themes and build applications.

Not only Cubi is a ready to use application platform, also it provides the best samples for learning Openbiz. Cubi is highly recommended to download with Openbiz.

## Download Openbiz ##

Openbiz source is included in cubi source tree which can be downloaded in cubi distributions or pull from cubi svn at http://openbiz-cubi.googlecode.com/svn/trunk/. Partial third party libraries are included in the SVN under openbiz/bin/others. They have the necessary code for running Openbiz and Cubi. Users can download latest full-version releases of Zend Framework, Smarty engine from their own websites.

## Install Openbiz ##

As Openbiz source is included in Cubi distribution, you can find openbiz source at cubi/openbiz/ after you unzip the cubi tarball. You can pull openbiz framework source out of your application directory. If you download Cubi, please define/change the OPENBIZ\_HOME in cubi app\_init.php file, then start Cubi installation wizard to complete installation.

In openbiz/bin/sysheader\_inc.php defines the paths of 3rd party php packages including Smarty "SMARTY\_DIR", Zend Framework "ZEND\_FRWK\_HOME". If you have same packages installed in other directories and you don't want to use the packages installed with openbiz, please modify them to appropriate paths.

## Run-time Requirements ##

Openbiz can be run in Unix, Windows, Mac server supporting PHP. Other runtime environment includes

  * Web server. E.g. Apache, IIS
  * Database server. E.g. MySQL, MSSQL, Oracle, PgSQL and databases supported in Zend\_DB
  * PHP 5.1 and above

If you are new to PHP, WAMPServer (http://www.wampserver.com/en/) is recommended for quick setup of web server, database and PHP.

## License ##

Openbiz framework is under license of BSD (http://www.opensource.org/licenses/bsd-license.php)