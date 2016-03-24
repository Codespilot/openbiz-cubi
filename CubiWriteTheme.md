# How to write a Cubi theme #

Cubi release includes a default theme. It is fairly simple to create a custom theme. Here are the steps:
  1. Create a subfolder under /themes folder.
  1. Copy the subfolders from /themes/default to the newly created subfolder.
    * css - contains the stylesheet files
    * images - contains images files
    * js - contains theme related js files
    * template - contain shared template files. (Each module can have its own template file under modules/modname/template/)
  1. Modify the files in above 4 folder to customize your theme.

A theme can be also created by theme generator command line tool and theme management screen. These two approaches are described in Cubi Command Line Tools and Cubi Core Modules separately.

Once a new theme is added, it can be set as default theme at theme management screen or at my account preference screen.