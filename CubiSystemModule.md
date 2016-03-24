## Cubi System module ##

System module provides tools to manage users, roles, modules, groups and permissions.

### Manage users ###
The module enables administrator to create, edit, delete and list users as well as assign roles to a given user.

List all users
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_list.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_list.jpg)

Drilldown on user name and see user details
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_detail.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_detail.jpg)

Add a role to the user
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/add_role.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/add_role.jpg)

You can see a new role is added in the list of role form. You can select a role, click "Remove" button to remove a role of the user.
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/add_role2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/add_role2.jpg)

Edit a user info
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_edit.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_edit.jpg)

### Manage roles ###

System module enables administrator to create, edit, delete and list roles as well as set permissions of given role.

List all roles
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/role_list.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/role_list.jpg)

Click role name, see role details and its permission settings.
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/role_detail.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/role_detail.jpg)

Change the role permissions (we use "Member" role here)
By default, if the Access Level is not set, it means "Deny"
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/role_perm.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/role_perm.jpg)

#### Test the permission change ####

Now that we allow "Member" role to administer users, let's test the change. First, login as member.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/member_login.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/member_login.jpg)

Then, click on "User Management" link on the left menu. Now member can manage users.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/member_mgr_user.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/member_mgr_user.jpg)

Click on "Role Management" link on the left menu. Now we get "Access Denied" page.
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/access_deny.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/access_deny.jpg)

### Manage Modules ###

Besides command line load module tool, Cubi provide links in Administration tab to allow module management from the UI.

#### List all modules ####
Module list view lists all modules loaded in Cubi.
To load new modules, you will need to
Copy (or ftp) the module source to /cubi/modules/ folder
Navigate to Module Management screen and click on “Load” button.
New module names should be shown in the list.
On the list view, you can click on the check icon under Active column to disable or enable a module.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/module_1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/module_1.jpg)

#### Module detail page ####

Clicking on module name in the module list view will take user to Module Detail view.
On this view, clicking “Reload” button to reload a module - you want to reload a module if the source has been changed.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/module_2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/module_2.jpg)

Next: [CubiMenuModule](CubiMenuModule.md)