# Cubi Clean URL #

Cubi applications by default have clean url to access Views. With some configuration changes at web server, the url can be even shorter.

## Basic Cubi URL Format ##

Cubi view is the web page with its url that can be entered in browser. Normally Cubi view is located at cubi/modules/module\_name/view/. Views under modules folder can be accessed with the following url formats:
  * /cubi/index.php/system/userList to access system/view/UserList view.
  * /cubi/index.php/system/user\_list to access system/view/UserList view.
  * /cubi/index.php/system/user\_detail/5 to access system/view/UserDetail view with user\_id as '5'.
  * /cubi/index.php/system/user\_detail/Id\_5 to access system/view/UserDetail view with user\_id as '5'.
  * /cubi/index.php/user/reset\_password/token=4c0417d23dad6&abc=xyz to access user/view/ResetPassword view with additional parameters token=4c0417d23dad6 and abc=xyz as standard HTTP GET query string.

If index.php is set to be the default execution name, you can use "?" to replace "index.php". E.g. /cubi/?/system/userList

## Advanced URL format with url\_rewrite ##

If your Cubi runs in Apache and changing apache conf is allowed in your Cubi installation, cleaner URL can be given by url\_rewrite. The following example assume your cubi is installed at D:\Apache2\htdocs\cubidev\cubi. The same idea is easy to be applied in Unix-like systems.

### Change apache conf file ###

In your apache conf file, add
```
Alias /cubi "D:\Apache2\htdocs\cubidev\cubi"
<Directory "D:\Apache2\htdocs\cubidev\cubi">
AllowOverride All
</Directory>
```

Please verify .htaccess can be found under D:\Apache2\htdocs\cubidev\cubi\. If you can't find the file, please download it from http://openbiz-cubi.googlecode.com/svn/trunk/cubi/.htaccess to D:\Apache2\htdocs\cubidev\cubi\.

### Change app\_init.php ###

Open /cubi02/cubi/bin/app\_init.php, make following changes
```
/* APP_URL is /a/b in case of http://host/a/b/index.php?... */
define('APP_URL',"/cubi");

/* APP_INDEX is /a/b/index.php in case of http://host/a/b/index.php?... */
$indexScript = ""; // or "", or "/?"
define('APP_INDEX',APP_URL.$indexScript);
```

With the change above, “index.php” can be removed from the url. For example, http://host/cubi/system/user_list replaces the link http://host/cubi/index.php/system/user_list.

If you have web server other than apache, please search "url rewrite" modules or extensions of that type of web server.