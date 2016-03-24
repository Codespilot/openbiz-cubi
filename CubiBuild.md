# Build Cubi Applications #

Cubi's build tool is to make it easy to build Cubi-based application. Cubi builder is actually a warp script on top of Phing (http://phing.info/trac/) which is an Ant-like project build system.

The following files are needed to prepare application build assets under cubi/build folder
  * app\_name.xml. The application main build xml.
  * app\_name.properties. The application build property file
  * app\_name.license.txt. The license file of the application.

Command to build the app:
```
# cd cubi/build
# build app_name [target]
```
Example: build cubi application
```
# build cubi tar
```

After running the build command, a “gz” file is generated under /cubi/build/dist/app\_name/. The file name depends on the settings in build property file. The property file defines
  * build.summary.
  * build.version. The version of the build
  * build.release. The release of the build

The generated file name is app\_name-version-release.gz. For example, build.version is 0.3 and build.release is 1. Then the generated file name will be app\_name-0.3-1.gz.

For the syntax of build.xml file, please refer to http://phing.info/trac/ or http://ant.apache.org/manual/index.html

# Build installation package #
Usually an installation package is desirable for production deployment. After the application source is copied to the target application directory, it is recommended to run post actions including:
  * load your application modules
  * give write permission to proper folders

An example of rpm build spec is copied below. Please note
  * this rpm build spec assumes Apache is the web server to deploy
  * the apache conf file and web server reload could be ignored depending on your deployment strategy

```
%define version ##VERSION## 
%define release ##RELEASE##
%define name ##PROJECT##
 
%define contentdir /var/www
%define apacheconfdir %{_sysconfdir}/httpd/conf.d
 
Summary: ##SUMMARY##
Name: %{name}
Version: %{version}
Release: %{release}
License: GPL
URL: http://developer.com/projects/%{name}
Group: Applications/Internet
Source: %{name}-%{version}-%{release}.tar.gz
BuildArch: noarch
Requires: httpd, php >= 5.1.0, php-mysql, php-pdo, php-xml
Prereq: httpd, php >= 5.1.0
BuildRoot: ##BUILDROOT##
 
%description
##SUMMARY##
 
 
%prep
%setup -q
 
%build
 
%install
rm -rf $RPM_BUILD_ROOT
mkdir -p -m0755 $RPM_BUILD_ROOT%{contentdir}/%{name}
mkdir -p -m0755 $RPM_BUILD_ROOT%{apacheconfdir}
 
install -m 755 config/%{name}.conf $RPM_BUILD_ROOT%{apacheconfdir}
cp -rp cubi $RPM_BUILD_ROOT%{contentdir}/%{name}
 
%clean
rm -rf $RPM_BUILD_ROOT
 
%files
%defattr(-,root,root)
%config %dir %{_sysconfdir}/%{name}
%config(noreplace) %{_sysconfdir}/httpd/conf.d/*.conf
%dir %{contentdir}/%{name}
%{contentdir}/%{name}/cubi
 
%post
cd %{contentdir}/%{name}/cubi
rm -rf files/cache/*
php bin/tools/load_module.php module1
php bin/tools/load_module.php module2
chmod -R 777 log/ session/ files/
 
RET=`/etc/init.d/httpd status`
if [ "$?" -ne "0" ]; then
    /etc/init.d/httpd start 1>/dev/null
else
    /etc/init.d/httpd graceful 1>/dev/null
fi
 
 
%changelog
* Mon Mar 8 2010 Developer Name <email_address> 
- Local Build for Linux RPM
```