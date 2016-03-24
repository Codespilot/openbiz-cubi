# Cubi Theme Module #

Cubi manages its GUI elements with themes. It is recommended that user interface resources including image files, css files, template files and etc are put into /cubi/themes/your\_theme/ folder.

Cubi default theme can be set in app\_init.php.
```
/* define themes const */
define('USE_THEME', 1);
define('THEME_URL',APP_URL."/themes");
define('THEME_PATH',APP_HOME.DIRECTORY_SEPARATOR."themes");        
define('DEFAULT_THEME_NAME',"default");
```

A theme is chosen by the following sequence
  1. From browser cookie which contains theme name
  1. From url parameter with string like "theme\_name"
  1. From DEFAULT\_THEME\_NAME defined in app\_init.php

## Manage Theme ##

Administrator can use Cubi theme management module to view all themes and create a new theme.

### View application themes ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/theme_1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/theme_1.jpg)

### Add a new theme ###

Clicking “Add” button will take user to “New Theme” page. When a new theme is saved, a new theme folder will be generated under /cubi/themes/.
Alternatively, a new theme can be added by coping the default theme folder to the new theme folder and modifying theme.xml under the new theme folder.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/theme_2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/theme_2.jpg)

Next: [CubiCronjobModule](CubiCronjobModule.md)