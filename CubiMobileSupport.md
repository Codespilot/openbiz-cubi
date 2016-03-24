# Introduction #

Openbiz Cubi fully supports mobile smarty phone browsers. On a mobile browser, Cubi application will adapt the UI to mobile theme on top of jQueryMobile! Cubi mobile is tested with iPhone and Android browsers.

# Mobile Touch Theme #

After install Cubi on your web server, you can hit the server from your iPhone or Android browser. The Cubi application will give you mobile touch screen experience.

### Login Page ###
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_login.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_login.png)

### Registration Page ###
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_register.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_register.png)

### Contact List Page ###
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_list.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_list.png)
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_list1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_list1.png)

### Contact Detail Page ###
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_detail.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_detail.png)
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_detail1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_detail1.png)

### Contact Edit Page ###
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_edit.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/mobile/mob_contact_edit.png)


# Enable Mobile Support for a Module #

In order to support mobile browser per a module, we suggest create a separate module with a post-fix as "_mob". For example "contact\_mob" is the mobile version of "contact" module. Usually a mobile version module has only UI related directories including
  * form
  * template
  * view
  * widget_

Its forms can use the data objects defined in original module. That means "contact\_mob" form's DataObject is contact.do.ContactDO that defined in "contact" module.

## Touch Theme ##

If you hit the cubi application with mobile browser, the server will use touch theme by default to render the page back to browser.

The touch theme is added under /cubi/themes/. The code to pick touch theme can be found in cubi/bin/app\_init.php
```
if (DeviceUtil::$PHONE_TOUCH) define('DEFAULT_THEME_NAME','touch');	// default theme for touch screen phone
else define('DEFAULT_THEME_NAME', 'default');     // name of the theme. theme files are under themes/theme_name
```

## Limit the Functions in Mobile Module ##

Practically, users only use read and search data from the mobile devices. So the mobile module should have much less features than the full version module.

On a list form, the mobile version would make the following changes
  * Have less fields in the Data Panel
  * Empty buttons in Action Panel
  * Have "Add", "Prev" and "Next" buttons in Nav Panel
  * Leave only search input in Search Panel

## List Form Changes ##

List Form in mobile module changes to a real list view instead of a data grid.
```
<DataPanel>
    <Element Name="fld_Id" Class="LabelText" Hidden="Y" FieldName="Id" Label="ID"/>
    <Element Name="fld_display_name" Class="LabelText" FieldName="display_name" Label="Contact Name" CssClass="ui-li-heading"/>
    <Element Name="fld_email" Class="LabelText" FieldName="email" Label="Email" Text="Email: {@:Elem[fld_email].Value}" CssClass="ui-li-desc" Style="font-weight:bold"/>	
    <Element Name="fld_mobile" Class="LabelText"   FieldName="mobile" Label="Mobile" Text="Cell: {@:Elem[fld_mobile].Value}" Sortable="Y" CssClass="ui-li-desc"/>	
    <Element Name="fld_type" Class="LabelText"  FieldName="type_name" Label="Type" Text="Type: {@:Elem[fld_type].Value}" CssClass="ui-li-desc"/>
    <Element Name="fld_Id_side" Class="LabelText" FieldName="Id" Label="ID" Text="Id: {@:Elem[fld_Id_side].Value}" CssClass="ui-li-aside ui-li-desc"/>
    <Element Name="fld_listlink" Class="LabelText" Label="ListLink" Link="{APP_INDEX}/contact_mob/contact_detail/{@:Elem[fld_Id].Value}" Text=" " Style="white-space:normal;padding-top:0;padding-bottom:0;"/>
</DataPanel>
```

A mobile list row typically includes
  * a heading line
  * several description lines
  * an arrow at the right-most of a row
  * an optinal text at the right side of a row
  * an optional icon or thumbnail at the left side of a row

From the above sample xml, we can see
  * it uses CssClass "ui-li-heading" and "ui-li-desc" to indicate heading or description line.
  * a special element "fld\_listlink" defines the target link when a list item is selected.
  * "ui-li-aside" is used to position a text to the right side.

http://jquerymobile.com/test/docs/lists/docs-lists.html provides more details of mobile list view

## Button Element Changes ##

A mobile enabled button usualy needs to
  * add DataRole="button"
  * add HTMLAttr="data-inline='true' data-icon='icon\_name' data-iconpos='pos\_name'".

### Back/Cancel button ###
```
<Element Name="btn_back" Class="Button" Text="Back" DataRole="button" HTMLAttr="data-inline='true' data-icon='back'">
    <EventHandler Name="back_onclick" Event="onclick" Function="js:history.go(-1)"/>  
</Element>
```

### Save button ###
```
<Element Name="btn_save" Class="Button" Text="Save" DataRole="button" HTMLAttr="data-inline='true' data-icon='check'" >
    <EventHandler Name="save_onclick" Event="onclick" EventLogMsg=""  Function="UpdateRecord()" RedirectPage="form=contact_mob.form.ContactDetailForm&amp;fld:Id={@contact.do.ContactDO:Field[Id].Value}" />
</Element>
```

### Add button ###
```
<Element Name="lnk_new" Class="Button" Text="Contact" DataRole="button" HTMLAttr="data-inline='true' data-icon='plus'" Description="Add a contact" >
    <EventHandler Name="lnk_new_onclick" Event="onclick" EventLogMsg="" Function="SwitchForm(contact_mob.form.ContactNewForm)"/>
</Element>
```

### Paging buttons ###
```
<Element Name="btn_prev" Class="Button" Enabled="{(@:m_CurrentPage == 1)?'N':'Y'}" Text="Prev" DataRole="button" HTMLAttr="data-inline='true' data-icon='arrow-l'">
    <EventHandler Name="prev_onclick" Event="onclick" Function="GotoPage({@:m_CurrentPage - 1})"/>
</Element>
<Element Name="btn_next" Class="Button" Enabled="{(@:m_CurrentPage == @:m_TotalPages )?'N':'Y'}" Text="Next" DataRole="button" HTMLAttr="data-inline='true' data-icon='arrow-r' data-iconpos='right'">
    <EventHandler Name="next_onclick" Event="onclick" Function="GotoPage({@:m_CurrentPage + 1})"/>
</Element>
```

## Search Element change ##

To save space, a mobile page prefer single search box. Considering a normal search panel of a form has search input box and a search button, the mobile version will combine them into one search box.

```
<Element Name="qry_name"  Class="InputText" FieldName="display_name" FuzzySearch="Y" HTMLAttr="type=search placeholder='Name'">
    <EventHandler Name="search_onchange" Event="onchange" Function="RunSearch()" ShortcutKey="Enter"/>
</Element>
```

## Add Device Support ##

Currently Cubi recognizes iOS and Android devices by checking the user-agent http header. In order to add a device for mobile support, you can modify get\_device\_info() function in /cubi/bin/device\_util.php.