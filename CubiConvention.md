# Cubi Naming and Coding Conventions #

## Metadata Naming Convenion ##

Before Cubi, Openbiz developers can name their metadata with any name. For example, an user list form can be named as
  * FM\_UserList.xml
  * f\_userlist.xml

In Cubi, metadata name follows the syntax as "NameType". For the user list form, Cubi will use
  * UserListForm.xml

Cubi recommends each module have the following sub-folders.
  * do. Store DataObject metadata and implementation classes.
  * form. Store Form metadata and implementation classes.
  * view. Store View metadata and implementation classes.
  * template. Store View and Form template files.
  * widget. Store Element and Menu metadata and implementation classes.
  * lib. Store common implementation scripts.
  * message. Store message files used by View and Form.
  * lov. Store list of values which are used in listbox-like elements.

Sample metadata names from Cubsi/modules/system directory
For DataObject metadata
  * /do/!UserDO.xml
  * /do/!RoleDO.xml
For Form metadata
  * /form/UserListForm.xml
  * /form/UserEditForm.xml
  * /form/UserNewForm.xml
For View metadata
  * /view/UserListView.xml
  * /view/UserEditView.xml
  * /view/UserNewView.xml

### Sub-modules ###

A module can have sub-module folders. Each child module should follow the same tree structure of a module.

For example, trac module includes sub-module folders
  * attach
  * comments
  * ...

And attach sub-module has folders like
  * do
  * form

It doesn't have "view" folder. Cubi suggests view objects are put in module view folder instead of sub-module view folder. This is to make the view url cleaner and shorter.

## Coding Convention ##

Openbiz/Cubi recommends coding standard stated in http://pear.php.net/manual/en/standards.php.