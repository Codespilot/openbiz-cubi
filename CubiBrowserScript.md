# Cubi Browser Scripting #

Cubi client communicates with server with AJAX by default. Its client classes are implemented with /cubi/js/openbiz.js.

## Openbiz javascript library overview ##

The openbiz.js includes the following classes:
  * Openbiz - main Openbiz namespace. It manages the form objects and provide entry of openbiz ajax call
  * Openbiz.ActionType. It defines the action types of openbiz ajax call.
  * Openbiz.Form. Each openbiz form instance will have a javascript Openbiz.Form instance
  * Openbiz.TableForm. This is the js instance of openbiz List/grid form.
  * Openbiz.Net. It provides network related functions like ajax call.
  * Openbiz.Window. It manages popup, dialog logic.
  * Openbiz.Util. It has some utility functions.
  * Openbiz.Menu. It has functions to show and hide context menu
  * Openbiz.CKEditor. It has functions that integrate CKEditor with ajax call.
  * Openbiz.AutoSuggest. It has functions that initiates autosuggestion control
  * Openbiz.Validator. It has functions that validate user entries on client side only.

## Extend browser side classes ##

If you want to implement special logic on client browser side, you can write your class by extending from Openbiz.Form or Openbiz.TableForm. Then in the Form metadata, specify jsClass="YourFormName".

Example: MyInputForm renders your own input form. Create a file "MyInputForm.js under /cubi/js/.
```
/**
 * MyInputForm class
 */
MyInputForm = Class.create(Openbiz.Form,
{
  initialize: function($super, name, subForms)
  {
    $super(name, subForms);
    // your own init code here
  },
  myfun: function(...)
  {
    // your code here
  }
});
```