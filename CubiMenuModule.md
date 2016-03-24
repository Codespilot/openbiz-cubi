## Cubi Menu module ##

Cubi Menu is the core component that manages the application navigation. Normally, web applications (or web site) hand code navigation elements, such as menus, tabs, breadcrumb and so on, on pages. This was the way used in previous Openbiz application - manually add left menu items on each view or in view template. Cubi Menu uses a tree structure to manage the site navigation elements.

Let's see how the menu system works in Cubi.

**Definition of menu**
  * Menu is a tree structure
  * Each menu item include navigation attributes like name, title, url, icon...
  * Each menu item has parent item which is the upper level menu item
  * Each menu item has an attribute that defines the display ordering among the same level of menu items

### Menu presentation on web page ###

Menu is tree structure. It can be presented as application tab, breadcrumb, navigation menu, sitemap on a web page. Please see the screen below.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_menu1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_menu1.jpg)

The diagram below shows how the menu tree maps to UI elements.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_menu2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_menu2.jpg)

### How to add menu in your own module ###

Each module can add entries in Cubi menu. In module/mod.xml, there is a Menu section to add MenuItem. Here is a sample of Menu xml elements.
```
<MenuItem Name="System" Title="Administration" Parent="" URL="{@home:url}/system/general_default" Order="10">
  <MenuItem Name="System.User" Title="Users" Order="10" IconImage="spacer.gif" IconCssClass="icon_user">
    <MenuItem Name="System.User.List" Title="User Management" URL="{@home:url}/system/user_list" Order="10"/>
```

The key to append module menu to system menu is
  * In the top MenuItem element, set Parent="existing\_menuitem". It will append this menu as a child of specified menuitem
  * Or leave the Parent="". It will tell this menu as a root first level menu item.

Sample xml that describes menu tree structure.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_menu3.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cubi_menu3.jpg)

### How to manage menu in the Cubi application ###

Once a module is loaded in the system, its menu is inserted into Cubi database as well. Then you can see the menu items appear on proper place like navigation menu or application tab.

If you are a Cubi admin, you can manage menu items in "Menu Management" views.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/menu_1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/menu_1.jpg)

The List of menu view shows the first level menu items. You can click on the "Expand" button at first column to display the next level menu items.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/menu_2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/menu_2.jpg)

You also can see the menu tree structure in the Menu Tree View.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/menu_3.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/menu_3.jpg)

### Set menu item access ###

Menu item can associate with access control by setting its "Access" attribute. For example,
Under modules/system/mod.xml
```
<MenuItem Name="System.User" Title="Users" Description="System User Management" Access="User.Administer_Users" ... Order="10">
```
The above definition tells that user/role who has access to "User.Administer\_Users" can see "System.User" menu item. You can find more details in Cubi access control chapter.

Next: [CubiUserModule](CubiUserModule.md)