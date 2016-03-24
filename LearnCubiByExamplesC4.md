# Learn Cubi By Examples Chapter 4 - Enrich Ticket Forms #
At the end of previous chapter, we have supporting component created for ticket. This chapter will come back to apply these components to ticket data object and forms.

## Change List Form ##
There are obvious UI issues on the ticket list form as well as the ticket input form which was created by gen\_meta tool in Chapter 2. Let's fix them now.

By default the list keeps all columns from the ticket table. These columns overflow the width of the table. After removing some elements from the trac/ticket/form/TicketListForm.xml and switching rows, we get a `DataPanel` section.
```
    <DataPanel>
        <Element Name="row_selections" Class="RowCheckbox"  Label="" FieldName="Id"/>
        <Element Name="fld_Id" Class="ColumnText" FieldName="Id" Label="Id" Sortable="Y" AllowURLParam="N" Link="javascript:">         
         	<EventHandler Name="fld_Id_onclick" Event="onclick" Function="SwitchForm(trac.ticket.form.TicketDetailForm,{@:Elem[fld_Id].Value})"   />
        </Element>
        <Element Name="fld_summary" Class="ColumnText" FieldName="summary" Label="Summary"  Sortable="Y"/>
        <Element Name="fld_type" Class="ColumnText" FieldName="type" Label="Type"  Sortable="Y" />
        <Element Name="fld_product_id" Class="ColumnText" FieldName="product_id" Label="Product Id"  Sortable="Y"/>
        <Element Name="fld_component_id" Class="ColumnText" FieldName="component_id" Label="Component Id"  Sortable="Y"/>
        <Element Name="fld_priority" Class="ColumnText" FieldName="priority" Label="Priority"  Sortable="Y"/>
        <Element Name="fld_owner_id" Class="ColumnText" FieldName="owner_id" Label="Owner Id"  Sortable="Y"/>
        <Element Name="fld_status" Class="ColumnText" FieldName="status" Label="Status"  Sortable="Y"/>
    </DataPanel>
```

The ticket list page then looks like
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketlist1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketlist1.jpg)

## Use Table Join ##
The ticket list form looks nice, but still need some work. We want to show  product name and component name instead of product id and component id. The product name is not in ticket table, it is in product table. So we will next use 'join' to link the product name to ticket.

**First, let's add joins in ticket data object.**
Edit the trac/ticket/do/TicketDO.xml as below.
```
<?xml version="1.0" standalone="no"?>
<BizDataObj Name="TicketDO" Description="" Class="BizDataObj" DBName="Default" Table="trac_ticket" SearchRule="" SortRule="" OtherSQLRule="" Uniqueness="" Stateless="N" IdGeneration="Identity" CacheLifeTime="0" CreateCondition="trac.ticket.Manage" UpdateCondition="trac.ticket.Manage" DeleteCondition="trac.ticket.Manage">
    <BizFieldList>
        <BizField Name="Id" Column="id"     Type="Number"/>
        <BizField Name="type" Column="type" Length="30"   Required="N" Type="Text"/>
        <BizField Name="time" Column="time"    Required="N" Type="Datetime"/>
        <BizField Name="changetime" Column="changetime"    Required="N" Type="Datetime"/>
        <BizField Name="product_id" Column="product_id"    Required="N" Type="Number"/>
        <BizField Name="product" Join="product" Column="name"/>
        <BizField Name="component_id" Column="component_id"    Required="N" Type="Number"/>
        <BizField Name="component" Join="component" Column="name"/>
        <BizField Name="severity" Column="severity" Length="30"   Required="N" Type="Text"/>
        <BizField Name="priority" Column="priority" Length="30"   Required="N" Type="Text"/>
        <BizField Name="owner_id" Column="owner_id"    Required="N" Type="Number"/>
        <BizField Name="owner" Join="owner" Column="username"/>
        <BizField Name="reporter_id" Column="reporter_id"    Required="N" Type="Number"/>
        <BizField Name="reporter" Join="reporter" Column="username"/>
        <BizField Name="cc" Column="cc" Length="255"   Required="N" Type="Text"/>
        <BizField Name="version_id" Column="version_id"    Required="N" Type="Number"/>
        <BizField Name="version" Join="version" Column="name"/>
        <BizField Name="milestone_id" Column="milestone_id"    Required="N" Type="Number"/>
        <BizField Name="milestone" Join="milestone" Column="name"/>
        <BizField Name="status" Column="status" Length="30"   Required="N" Type="Text"/>
        <BizField Name="resolution" Column="resolution" Length="30"   Required="N" Type="Text"/>
        <BizField Name="summary" Column="summary" Length="255"   Required="N" Type="Text"/>
        <BizField Name="description" Column="description"    Required="N" Type="Text"/>
        <BizField Name="keywords" Column="keywords" Length="128"   Required="N" Type="Text"/>
    </BizFieldList>
    <TableJoins>
        <Join Name="product" Table="trac_product" Column="id" ColumnRef="product_id" JoinType="LEFT JOIN"/>
        <Join Name="component" Table="trac_component" Column="id" ColumnRef="component_id" JoinType="LEFT JOIN"/>
        <Join Name="owner" Table="user" Column="id" ColumnRef="owner_id" JoinType="LEFT JOIN"/>
        <Join Name="reporter" Table="user" Column="id" ColumnRef="reporter_id" JoinType="LEFT JOIN"/>
        <Join Name="version" Table="trac_version" Column="id" ColumnRef="version_id" JoinType="LEFT JOIN"/>
        <Join Name="milestone" Table="trac_milestone" Column="id" ColumnRef="milestone_id" JoinType="LEFT JOIN"/>
    </TableJoins>
    <ObjReferences>
    </ObjReferences>
</BizDataObj>
```
You can find more details of Join in [Openbiz Data Object](OpenbizFrameworkDataObject.md), search for "Object Relational Mapping".

**Then we map the joined fields in data object to forms.**
Edit trac/ticket/form/TicketListForm.xml DataPanel element.
```
    <DataPanel>
        <Element Name="row_selections" Class="RowCheckbox"  Label="" FieldName="Id"/>
        <Element Name="fld_Id" Class="ColumnText" FieldName="Id" Label="Id" Sortable="Y" AllowURLParam="N" Link="javascript:">         
         	<EventHandler Name="fld_Id_onclick" Event="onclick" Function="SwitchForm(trac.ticket.form.TicketDetailForm,{@:Elem[fld_Id].Value})"   />
        </Element>
        <Element Name="fld_summary" Class="ColumnText" FieldName="summary" Label="Summary"  Sortable="Y"/>
        <Element Name="fld_type" Class="ColumnText" FieldName="type" Label="Type"  Sortable="Y" />
        <Element Name="fld_product" Class="ColumnText" FieldName="product" Label="Product"  Sortable="Y"/>
        <Element Name="fld_component" Class="ColumnText" FieldName="component" Label="Component"  Sortable="Y"/>
        <Element Name="fld_priority" Class="ColumnText" FieldName="priority" Label="Priority"  Sortable="Y"/>
        <Element Name="fld_owner" Class="ColumnText" FieldName="owner" Label="Owner"  Sortable="Y"/>
        <Element Name="fld_status" Class="ColumnText" FieldName="status" Label="Status"  Sortable="Y"/>
    </DataPanel>
```
You can verify the product name and component name are displayed in the ticket list form.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketlist2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketlist2.png)

**Do the same mapping on ticket detail form**
Edit trac/ticket/form/TicketDetailForm.xml DataPanel element.
```
    <DataPanel>
        <Element Name="fld_Id" ElementSet="General" Hidden="Y" Class="LabelText" FieldName="Id" Label="Id" AllowURLParam="Y"/>
       	<Element Name="fld_type" ElementSet="General" Class="LabelText" FieldName="type" Label="Type"/>
       	<Element Name="fld_time" ElementSet="General" Class="LabelText" FieldName="time" Label="Time"/>
       	<Element Name="fld_changetime" ElementSet="General" Class="LabelText" FieldName="changetime" Label="Changetime"/>
       	<Element Name="fld_product" ElementSet="General" Class="LabelText" FieldName="product" Label="Product"/>
       	<Element Name="fld_component" ElementSet="General" Class="LabelText" FieldName="component" Label="Component"/>
       	<Element Name="fld_severity" ElementSet="General" Class="LabelText" FieldName="severity" Label="Severity"/>
       	<Element Name="fld_priority" ElementSet="General" Class="LabelText" FieldName="priority" Label="Priority"/>
       	<Element Name="fld_owner_id" ElementSet="General" Class="LabelText" FieldName="owner_id" Label="Owner Id"/>
       	<Element Name="fld_reporter_id" ElementSet="General" Class="LabelText" FieldName="reporter_id" Label="Reporter"/>
       	<Element Name="fld_cc" ElementSet="General" Class="LabelText" FieldName="cc" Label="Cc"/>
       	<Element Name="fld_version" ElementSet="General" Class="LabelText" FieldName="version" Label="Version Id"/>
       	<Element Name="fld_milestone" ElementSet="General" Class="LabelText" FieldName="milestone" Label="Milestone"/>
       	<Element Name="fld_status" ElementSet="General" Class="LabelText" FieldName="status" Label="Status"/>
       	<Element Name="fld_resolution" ElementSet="General" Class="LabelText" FieldName="resolution" Label="Resolution"/>
       	<Element Name="fld_summary" ElementSet="General" Class="LabelText" FieldName="summary" Label="Summary"/>
       	<Element Name="fld_description" ElementSet="General" Class="LabelText" FieldName="description" Label="Description"/>
       	<Element Name="fld_keywords" ElementSet="General" Class="LabelText" FieldName="keywords" Label="Keywords"/>
    </DataPanel>
```

The detail form becomes

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketdetail0.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketdetail0.png)

## Change Edit Form ##
Now we want to allow users to pick product, component instead of enter ids.
Edit the trac/ticket/form/TicketEditForm.xml as below.
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketEditForm" Class="EasyForm" FormType="Edit" jsClass="jbForm" Title="Edit Ticket" Description="" BizDataObj="trac.ticket.do.TicketDO" DefaultForm="Y" TemplateEngine="Smarty" TemplateFile="detail.tpl" EventName="" MessageFile="">
    <DataPanel>
        <Element Name="fld_Id" Class="Hidden" FieldName="Id" Label="Id" AllowURLParam="Y" CssClass="input" CssErrorClass="input_error"/>
        <Element Name="fld_type" Class="InputText" FieldName="type" Label="Type" />
        <Element Name="fld_time" Class="InputDatetime" DateFormat="%Y-%m-%d %H:%M:%S" FieldName="time" Label="Time"   CssClass="input_text" CssErrorClass="input_text_error" CssFocusClass="input_text_focus"/>
        <Element Name="fld_changetime" Class="InputDatetime" DateFormat="%Y-%m-%d %H:%M:%S" FieldName="changetime" Label="Changetime"   CssClass="input_text" CssErrorClass="input_text_error" CssFocusClass="input_text_focus"/>
        <Element Name="fld_product_id" Class="Listbox" FieldName="product_id" Label="Product" SelectFrom="trac.product.do.ProductDO[name:Id]"/>
        <Element Name="fld_component_id" Class="Listbox" FieldName="component_id" Label="Component" SelectFrom="trac.component.do.ComponentDO[name:Id]" />
        <Element Name="fld_severity" Class="InputText" FieldName="severity" Label="Severity" />
        <Element Name="fld_priority" Class="InputText" FieldName="priority" Label="Priority" />
        <Element Name="fld_owner_id" Class="InputText" FieldName="owner_id" Label="Owner Id" />
        <Element Name="fld_reporter_id" Class="InputText" FieldName="reporter_id" Label="Reporter Id" />
        <Element Name="fld_cc" Class="InputText" FieldName="cc" Label="Cc" />
        <Element Name="fld_version_id" Class="Listbox" FieldName="version_id" Label="Version" SelectFrom="trac.version.do.VersionDO[name:Id]" />
        <Element Name="fld_milestone_id" Class="Listbox" FieldName="milestone_id" Label="Milestone" SelectFrom="trac.milestone.do.MilestoneDO[name:Id]" />
        <Element Name="fld_status" Class="InputText" FieldName="status" Label="Status" />
        <Element Name="fld_resolution" Class="InputText" FieldName="resolution" Label="Resolution" />
        <Element Name="fld_summary" Class="InputText" FieldName="summary" Label="Summary" />
        <Element Name="fld_description" Class="CKEditor"  mode="adv"  Config="resize_maxWidth:640,resize_minWidth:640,resize_minHeight:300" width="640" height="300" FieldName="description" Label="Description"   />            
        <Element Name="fld_keywords" Class="InputText" FieldName="keywords" Label="Keywords" />
    </DataPanel>
    <ActionPanel>
        <Element Name="btn_save" Class="Button" Text="Save" CssClass="button_gray_m">
            <EventHandler Name="save_onclick" Event="onclick" EventLogMsg=""  Function="UpdateRecord()" RedirectPage="form=trac.ticket.form.TicketDetailForm&amp;fld:Id={@trac.ticket.do.TicketDO:Field[Id].Value}" ShortcutKey="Ctrl+Enter" ContextMenu="Save" />
        </Element>
        <Element Name="btn_cancel" Class="Button" Text="Cancel" CssClass="button_gray_m">
            <EventHandler Name="btn_cancel_onclick" Event="onclick" Function="SwitchForm()"  ShortcutKey="Escape" ContextMenu="Cancel" />
        </Element>
    </ActionPanel> 
    <NavPanel>
    </NavPanel> 
    <SearchPanel>
    </SearchPanel>
</EasyForm>
```
You can find more details of "Bind Data to Listbox" in [Openbiz UI](OpenbizFrameworkUI.md).

Now click on Edit button on ticket list form, you should see the form includes 4 listboxes. Pick certain values and click "Save" button to save the change.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_edit_ticket0.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_edit_ticket0.jpg)

**What is missing?** So far so good, while there is a bug on ticket edit form. The component listbox should not display all components name, it should show only the components of selected product. Also, it a different product is selected, the component should be changed accordingly. Let's make some change on the ticket edit form to capture such logic.
```
<Element Name="fld_product_id" Class="Listbox" FieldName="product_id" Label="Product" SelectFrom="trac.product.do.ProductDO[name:Id]">
    <EventHandler Name="onchange" Event="onchange" Function="UpdateForm()"/>
</Element>
<Element Name="fld_component_id" Class="Listbox" FieldName="component_id" Label="Component" SelectFrom="trac.component.do.ComponentDO[name:Id],[product_id]={@:Elem[fld_product_id].Value}" />
```

Now please try to edit a ticket and verify the linkage behavior between product and component.



In the next chapter, we will add comments and change history in ticket detail form.