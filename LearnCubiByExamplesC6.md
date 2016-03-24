# Learn Cubi By Examples Chapter 6 - Add Ticket Attachment #
At the end of previous chapter, we added change history in ticket detail page, learned how to write a custom form class and custom template. This chapter will add support for attaching files to a ticket.

## Use Cubi Attachment Form ##
One of the key requirements of ticket is to allow users to attach files to a ticket. Uploading a file seems an easy task, while it can be very complicated when you want to have the cool UI like attach file in gmail. Basically the good uploader can
  * Allow more than one files selection in one upload
  * Be able to show the upload progress

Fortunately, Cubi attachment module has all these built-in. One of the best parts of Cubi platform is its core and applications are all modules. All modules can share other module classes and be shared by other modules. So we can simple leverage the functionality provided by attachment module for attaching files to tickets.

### Ticket Attachment Form ###
The easiest way of programming is "copy". Let's copy /attachment/widget/AttachmentListEditForm.xml to /trac/ticket/form/TicketAttachmentForm.xml and edit it.
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketAttachmentForm" Class="attachment.widget.AttachmentForm" FormType="List" Title="Ticket Attachments" jsClass="jbForm" BizDataObj="attachment.do.AttachmentDO"   PageSize="10" DefaultForm="Y" TemplateEngine="Smarty" TemplateFile="grid.tpl"  Access="attachment.access">
    <DataPanel>
        <Element Name="row_selections" Class="RowCheckbox" width="20"  Label="" FieldName="Id"/>        
        <Element Name="fld_Id" Class="Hidden" Hidden="Y" FieldName="Id" Label="Id" />
        <Element Name="fld_icon" Class="ColumnImage" Text="{RESOURCE_URL}/attachment/images/icon_attachment_private.png" FieldName="" Label="Type">				
        </Element>
        <Element Name="fld_title" Class="ColumnText" FieldName="title" Label="Title"  Sortable="Y" Link="javascript:">         
            <EventHandler Name="add_onclick" Event="onclick" Function="LoadDialog(attachment.widget.AttachmentDetailForm,{@:Elem[fld_Id].Value})"/>        
        </Element>
        <Element Name="fld_filename" Class="ColumnText" FieldName="filename" Label="Filename" Sortable="Y" ></Element>
        <Element Name="fld_filesize" Class="ColumnText" FieldName="filesize" Text="{@util:format_bytes(@:Elem[fld_filesize].Value)}"  Label="Filesize" Sortable="Y" ></Element>		
        <Element Name="fld_create_time" Class="ColumnText" FieldName="create_time" Label="Timestamp"  Sortable="Y" ></Element>
        <Element Name="fld_download" Class="ColumnText" FieldName="download_count" Label="Downloads" Sortable="Y" ></Element>
    </DataPanel>
    <ActionPanel>
        <Element Name="btn_add" Class="Button" text="Add" CssClass="button_gray_add">
            <EventHandler Name="add_onclick" Event="onclick" Function="LoadDialog(attachment.widget.AttachmentNewForm)"/>
        </Element>
        <Element Name="btn_edit" Class="Button" text="Edit" CssClass="button_gray_m">
            <EventHandler Name="delete_onclick" Event="onclick" Function="LoadDialog(attachment.widget.AttachmentEditForm)"/>
        </Element>
        <Element Name="btn_delete" Class="Button" text="Delete" CssClass="button_gray_m">
            <EventHandler Name="delete_onclick" Event="onclick" Function="DeleteRecord()"/>
        </Element> 
    </ActionPanel> 
    <NavPanel>
    </NavPanel> 
</EasyForm>
```

Then we add this new form into TicketDetailView.xml
```
<?xml version="1.0" standalone="no"?>
<EasyView Name="TicketDetailView" Description="Ticket details" Class="EasyView" Tab="" TemplateEngine="Smarty" TemplateFile="ticket_detail_view.tpl" Access="trac.ticket.Access">
   <FormReferences>
       <Reference Name="trac.ticket.form.TicketDetailForm"/>
       <Reference Name="trac.comments.form.CommentsListForm"/>
       <Reference Name="trac.ticket.form.TicketAttachmentForm"/>
   </FormReferences>
</EasyView>
```

Reload Ticket detail view, the ticket attachment form should be added in the bottom.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach3.png)

Click on Add button to popup the file upload dialog. Click on "Select Files" button to select files to upload.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach0.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach0.png)

On the ticket attachment form, click on the file name will popup attachment detail dialog. Click on "Download" button to download the file. You can see the "Downloads" column in the attachment form changes accordingly.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach1.png)

## Have Attachment Template File ##
The ticket attachment UI is a standard Cubi list form. But we want the attachments to be displayed in a multi-line list instead of table grid. Thus we point a template file "ticket\_attach.tpl" to the TicketAttachmentForm.xml.
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketAttachmentForm" Class="attachment.widget.AttachmentForm" FormType="List" Title="Ticket Attachments" jsClass="Openbiz.Form" BizDataObj="attachment.do.AttachmentDO"   PageSize="10" DefaultForm="Y" TemplateEngine="Smarty" TemplateFile="ticket_attach.tpl"  Access="attachment.access">
    <DataPanel>
        <Element Name="row_selections" Class="RowCheckbox" width="20"  Label="" FieldName="Id"/>        
        <Element Name="fld_Id" Class="Hidden" Hidden="Y" FieldName="Id" Label="Id" />
        <Element Name="fld_icon" Class="ColumnImage" Text="{RESOURCE_URL}/attachment/images/icon_attachment_private.png" FieldName="" Label="Type">				
        </Element>
        <Element Name="fld_title" Class="ColumnText" FieldName="title" Label="Title" Link="javascript:">         
            <EventHandler Name="add_onclick" Event="onclick" Function="LoadDialog(attachment.widget.AttachmentDetailForm,{@:Elem[fld_Id].Value})"/>        
        </Element>
        <Element Name="fld_filename" Class="ColumnText" FieldName="filename" Label="Filename" ></Element>
        <Element Name="fld_filesize" Class="ColumnText" FieldName="filesize" Text="{@util:format_bytes(@:Elem[fld_filesize].Value)}"  Label="Filesize" ></Element>	
        <Element Name="fld_description" Class="ColumnText" FieldName="description" Label="Description" />        
        <Element Name="fld_create_time" Class="ColumnText" FieldName="create_time" Label="Timestamp"></Element>
        <Element Name="fld_create_by" Class="ColumnText" FieldName="create_by" Label="Create By" Text="{BizSystem::GetProfileName(@:Elem[create_by].Value)}"/>
        <Element Name="fld_download" Class="ColumnText" FieldName="download_count" Label="Downloads"></Element>
    </DataPanel>
    <ActionPanel>
        <Element Name="btn_add" Class="Button" text="Add" CssClass="button_gray_add">
            <EventHandler Name="add_onclick" Event="onclick" Function="LoadDialog(attachment.widget.AttachmentNewForm)"/>
        </Element>
    </ActionPanel> 
    <NavPanel>
    </NavPanel> 
</EasyForm>
```

Then create a ticket\_detail\_view.tpl and trac\_attach.tpl under /trac/template/.
```
 {php}
$left_menu = "trac.widget.LeftMenu";
$this->assign("left_menu", $left_menu);

$js_url = $this->_tpl_vars['js_url'];
$theme_js_url = $this->_tpl_vars['theme_js_url'];
$css_url = $this->_tpl_vars['css_url'];

BizSystem::clientProxy()->includeCalendarScripts();
BizSystem::clientProxy()->includeCKEditorScripts();
$includedScripts = BizSystem::clientProxy()->getAppendedScripts();
$includedScripts .= "
<script type=\"text/javascript\" src=\"$js_url/cookies.js\"></script>
<script type=\"text/javascript\" src=\"$theme_js_url/general_ui.js\"></script>
<script type='text/javascript' src='$js_url/jquery.js'></script>
<script type='text/javascript' src='$js_url/jquery-ui-1.8.12.custom.min.js'></script>
<script>try{var \$j=jQuery.noConflict();}catch(e){}</script>
<script type='text/javascript' src='$js_url/uploadify/swfobject.js'></script>
<script type='text/javascript' src='$js_url/uploadify/jquery.uploadify.v2.1.4.js'></script>
";
$this->_tpl_vars['scripts'] = $includedScripts;

$appendStyle = BizSystem::clientProxy()->getAppendedStyles();
$appendStyle .= "\n"."
<link rel=\"stylesheet\" href=\"$css_url/general.css\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"$css_url/system_backend.css\" type=\"text/css\" />
<link rel=\"stylesheet\" href=\"$css_url/system_menu_icons.css\" type=\"text/css\" />
";
$this->_tpl_vars['style_sheets'] = $appendStyle;

$this->assign('template_file', 'system_view.tpl.html');
{/php}
{include file=$template_file}
```

```
<form id='{$form.name}' name='{$form.name}'>
<div style="padding-left:25px;padding-right:40px;">
    <div>
    {if $form.icon !='' }
    <div class="form_icon"><img  src="{$image_url}/{$form.icon}" border="0" /></div>
    {/if}
    <h2>
    {$form.title}
    </h2> 
    {if $form.description !='' }
    <p class="form_desc">{$form.description}</p>
    {/if}
    </div>

    {foreach item=row from=$dataPanel.data}
    <table style="margin-left:10px; margin-bottom:5px">
    <tr>
    <td valign="top">{$row.fld_icon}</td>
    <td valign="top">{$row.fld_title} ({$row.fld_filename}, {$row.fld_filesize} bytes) 
    <p>uploaded by {$row.fld_create_by} on {$row.fld_create_time}.</p>
    <p><i>{$row.fld_description}</i></p>
    </td>
	</tr>
    </table>
    {/foreach}
  
    <div>	
    <div class="action_panel">
    {foreach item=elem from=$actionPanel}
        {$elem.element}
    {/foreach}
    </div>
    </div>
    <div class="v_spacer" style="clear:both"></div>
</div>

</form>
```

The attachment form now looks as

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach4.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketattach4.png)


## Link Change History and Attachment to a Ticket ##

So far the three forms in ticket detail page work well individually. While we really want to
  * only show change history of the given ticket
  * only show attachment files of the given ticket

The link between the ticket and other 2 forms is also called parent/child relationship. The ticket detail view has Ticket Detail Form as parent form, Comment List as child form one, and Ticket Attachment as child form two.

Openbiz-Cubi core classes provide good support to make easy configuration of parent-child. Typically you only need to two changes in metadata files.
  * Add Object Reference in Data Object
  * Add SubForm is View

The following changes in /trac/ticket/do/TicketDO.xml add comment data object and attachment data object as references to ticket data object. The relationships are both "one to many". This means one ticket may have many comments and attachments. ORM section in [Openbiz Framework Data Object](OpenbizFrameworkDataObject.md) will give more details of how to setup object reference.
```
    <ObjReferences>
        <Object Name="trac.comments.do.CommentsDO" Relationship="1-M" Table="trac_comments" Column="parent_id" FieldRef="Id"/>
        <Object Name="attachment.do.AttachmentDO" Relationship="1-M" Table="attachment" CondColumn='type' CondValue='ticket' Column="foreign_id" FieldRef="Id" />
    </ObjReferences>
```

Then we make change on ticket detail view by adding SubForm attribute in ticket detail form reference element.
```
<?xml version="1.0" standalone="no"?>
<EasyView Name="TicketDetailView" Description="Ticket details" Class="EasyView" Tab="" TemplateEngine="Smarty" TemplateFile="ticket_detail_view.tpl" Access="trac.ticket.Access">
   <FormReferences>
       <Reference Name="trac.ticket.form.TicketDetailForm" SubForms="trac.comments.form.CommentsListForm;trac.ticket.form.TicketAttachmentForm"/>
       <Reference Name="trac.comments.form.CommentsListForm"/>
       <Reference Name="trac.ticket.form.TicketAttachmentForm"/>
   </FormReferences>
</EasyView>
```

Now we link comments form and attachment form as children forms to the parent ticket detail form. We can verify attachments and change history only belong to one ticket.