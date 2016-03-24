# Learn Cubi By Examples Chapter 7 - Fine Tuning #

At the previous chapters, we added change history and attachment for ticket, then linked them to a ticket in ticket detail view. The main logic and UI are finished. Now it is time to do some fine tuning work.

## Change Ticket Form Layout ##
The ticket detail form and edit form look a little too long. A desired ticket detail form has layout of 4 sections
  * content section including summary and description
  * general section including type, product, component, severity, priority, version, milestone, status, resolution, keywords
  * contact section including owner, reporter and cc
  * misc section including creation time and update time.

The ticket edit form is same as detail form with an extra textarea to input user comments.

Also it is ideal to have ticket ID and summary on the form title area.

To achieve the new layout, we edit the TicketDetailForm.xml
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketDetailForm" Class="TicketForm" FormType="" jsClass="jbForm" Title="Ticket #{@:Elem[fld_Id].Value}. {@:Elem[fld_summary].Value}" Description="" BizDataObj="trac.ticket.do.TicketDO" TemplateEngine="Smarty" TemplateFile="ticket_detail.tpl" EventName="" MessageFile="">
    <DataPanel>
        <Element Name="fld_Id" ElementSet="General" Class="LabelText" FieldName="Id" Label="Id" AllowURLParam="Y"/>
        <Element Name="fld_summary" ElementSet="Content" Class="LabelText" FieldName="summary" Label="Summary"/>
       	<Element Name="fld_description" ElementSet="Content" Class="LabelText" FieldName="description" Label="Description"/>
        
       	<Element Name="fld_type" ElementSet="General" Class="LabelText" FieldName="type" Label="Type"/>
       	<Element Name="fld_product" ElementSet="General" Class="LabelText" FieldName="product" Label="Product"/>
       	<Element Name="fld_component" ElementSet="General" Class="LabelText" FieldName="component" Label="Component"/>
       	<Element Name="fld_severity" ElementSet="General" Class="LabelText" FieldName="severity" Label="Severity"/>
       	<Element Name="fld_priority" ElementSet="General" Class="LabelText" FieldName="priority" Label="Priority"/>
       	<Element Name="fld_version" ElementSet="General" Class="LabelText" FieldName="version" Label="Version Id"/>
       	<Element Name="fld_milestone" ElementSet="General" Class="LabelText" FieldName="milestone" Label="Milestone"/>
       	<Element Name="fld_status" ElementSet="General" Class="LabelText" FieldName="status" Label="Status"/>
       	<Element Name="fld_resolution" ElementSet="General" Class="LabelText" FieldName="resolution" Label="Resolution"/>
       	<Element Name="fld_keywords" ElementSet="General" Class="LabelText" FieldName="keywords" Label="Keywords"/>
       	
        <Element Name="fld_owner" ElementSet="Contact" Class="LabelText" FieldName="owner" Label="Owner"/>
       	<Element Name="fld_reporter" ElementSet="Contact" Class="LabelText" FieldName="reporter" Label="Reporter"/>
       	<Element Name="fld_cc" ElementSet="Contact" Class="LabelText" FieldName="cc" Label="Cc"/>
        
        <Element Name="fld_time" ElementSet="Misc" Class="LabelText" FieldName="time" Label="Time"/>
       	<Element Name="fld_changetime" ElementSet="Misc" Class="LabelText" FieldName="changetime" Label="Changetime"/>
    </DataPanel>
    <ActionPanel>        
        <Element Name="btn_edit" Class="Button" Text="Edit" CssClass="button_gray_m" Description="edit record (Ctrl+E)">
            <EventHandler Name="btn_new_onclick" Event="onclick" Function="SwitchForm(trac.ticket.form.TicketEditForm,{@:Elem[fld_Id].Value})"  ShortcutKey="Ctrl+E" ContextMenu="Edit" />
        </Element>
        <Element Name="btn_cancel" Class="Button" Text="Back" CssClass="button_gray_m">
            <EventHandler Name="btn_cancel_onclick" Event="onclick" Function="SwitchForm()"  ShortcutKey="Escape" ContextMenu="Cancel" />
        </Element>         
    </ActionPanel> 
    <NavPanel>
    </NavPanel> 
    <SearchPanel>
    </SearchPanel>
</EasyForm>
```

Then create a new file ticket\_detail.tpl under /trac/template/.
```
<form id="{$form.name}" name="{$form.name}">

<div style="padding-left:25px; padding-right:40px;">
{include file="system_appbuilder_btn.tpl.html"}
	
    <table><tr><td>
        {if $form.icon !='' }
        <div class="form_icon"><img  src="{$form.icon}" border="0" /></div>
        {/if}

        <div style="float:left; width:600px;">
            {if $form.title}
            <h2>
            {$form.title}
            </h2>
            {/if} 
            {if $form.description}
            <p class="input_row" style="line-height:20px;padding-bottom:5px;">		
            <span>{$form.description}</span>
            </p>
            {else}
            <div style="height:15px;"></div>
            {/if}
        </div>
    </td></tr></table>

    <div class="detail_form_panel_padding" >
    {assign var=es_counter value=0}
    {foreach item=setname name=elemsets  from=$form.elementSets}
        {if $smarty.foreach.elemsets.first}
        <div id="element_set_{$es_counter}" class="underline upline">
        {else}
        <div id="element_set_{$es_counter}" class="underline">
        {/if}
        <h2 class="element_set_title"><a id="element_set_btn_{$es_counter}" class="shrink" href="javascript:;" onclick="switch_elementset('{$form.name}','{$es_counter}')" >{$setname}</a></h2>
        <div id="element_set_panel_{$es_counter}" class="element_set_panel">
        {if $setname=='General'}
            <table width="100%" id="fld_type_container" class="input_row">
            <tr>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_type.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_type.element}</span></td>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_status.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_status.element}</span></td>
            </tr>
            <tr>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_product.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_product.element}</span></td>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_component.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_component.element}</span></td>
            </tr>
            <tr>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_version.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_version.element}</span></td>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_milestone.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_milestone.element}</span></td>
            </tr>
            <tr>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_priority.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_priority.element}</span></td>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_severity.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_severity.element}</span></td>
            </tr>
            <tr>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_resolution.label}</label></td>
            <td><span class="label_text" style="line-height:100%;width:200px">{$dataPanel.fld_resolution.element}</span></td>
            <td style="width:80px;"><label style="text-align:left;">{$dataPanel.fld_keywords.label}</label></td>
            <td><span class="label_text" style="line-height:100%">{$dataPanel.fld_keywords.element}</span></td>
            </tr>
            </table>
        {else}
        {assign var=es_elem_counter value=0}
        {foreach item=item key=itemName from=$dataPanel}
            {if $item.elementset eq $setname}
            {if $item.type eq 'CKEditor' 
             or $item.type eq 'RichText' 
             or $item.type eq 'Textarea'  
             or $item.type eq 'RawData'
             or $item.type eq 'LabelImage'
             or $item.type eq 'IDCardReader'
             }
                <table  id="{$itemName}_container" class="input_row">
                <tr>
                <td style="width:80px;">	
                    <label style="text-align:left">{$item.label}</label>
                </td>
                <td>
                    {if $errors.$itemName}
                    <span class="input_error_msg" style="width:240px;">{$errors.$itemName}</span>
                    {elseif $item.description}
                    <span class="input_desc" style="width:240px;">{$item.description}</span>			
                    {/if}
                </td>
                </tr>
                <tr><td colspan="2" align="center" >
                    <span class="label_textarea" style="width:655px;">{$item.element}</span>
                                
                </td></tr>
                </table>		
            {else}
                {if $item.type eq 'Hidden' }
                <table  id="{$itemName}_container" class="input_row" style="display:none">
                {else}
                <table  id="{$itemName}_container" class="input_row">
                {/if}					
                <tr>
                <td >			
                    <label style="text-align:left;">{$item.label}</label>			
                </td>
                <td>
                {if $item.type eq 'Checkbox' }
                    <span class="label_text" >{$item.element} {$item.description}</span>
                {elseif $item.type|substr:0:5 eq 'Label'}
                    <span>{$item.element}</span>    
                {else}
                    <span class="label_text" style="{if $item.width}width:{$item.width+15}px;{/if}">{$item.element}</span>
                    {if $errors.$itemName}
                    <span class="input_error_msg" style="width:240px;">{$errors.$itemName}</span>
                    {elseif $item.description}
                    <span class="input_desc" style="width:240px;">{$item.description}</span>			
                    {/if}				
                {/if}
                </td>
                </tr>
                </table>
            {/if}
            {assign var=es_elem_counter value=$es_elem_counter+1}					
            {/if}
        {/foreach}
        {/if}
        </div>
        {if $es_elem_counter eq '0'}
            <script>$('element_set_{$es_counter}').hide();</script>
        {/if}			
        </div>
        <script>
            init_elementset('{$form.name}','{$es_counter}');
        </script>
    {assign var=es_counter value=$es_counter+1}			
    {/foreach}
        <div style="height:10px;"></div>
        {if $actionPanel|@count > 0}
        <p class="input_row">
            
            {foreach item=elem from=$actionPanel}
                {$elem.element}
            {/foreach}
        </p>
        {/if}

    {if $errors}
        <div id='errorsDiv' class='innerError errorBox'>
        {foreach item=errMsg from=$errors}
            <div>{$errMsg}</div>
        {/foreach}
        {literal}<script>try{setTimeout("$('errorsDiv').fade( {from: 1, to: 0});",3000);}catch(e){}</script>{/literal}
        </div>
    {/if}

    {if $notices}
        <div id='noticeDiv' class='noticeBox' >
        {foreach item=noticeMsg from=$notices}
            <div>{$noticeMsg}</div>
        {/foreach}
        </div>
        {literal}<script>try{setTimeout("$('noticeDiv').fade( {from: 1, to: 0});",3000);}catch(e){};</script>{/literal}
    {/if}

    </div>

    <div style="height:15px;">
    <div id='{$form.name}.load_disp' style="display:none;">
    <img  src="{$image_url}/form_ajax_loader.gif"/>
    </div>
    </div>
	
</div>
</form>
```

The new ticket detail form looks like

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketdetail2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketdetail2.png)

Now change the TicketEditForm.xml to
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketEditForm" Class="TicketForm" FormType="Edit" jsClass="jbForm" Title="Edit Ticket #{@:Elem[fld_Id].Value}. {@:Elem[fld_summary].Value}" Description="" BizDataObj="trac.ticket.do.TicketDO" DefaultForm="Y" TemplateEngine="Smarty" TemplateFile="ticket_detail.tpl" EventName="" MessageFile="">
    <DataPanel>
        <Element Name="fld_Id" Class="Hidden" FieldName="Id" Label="Id" AllowURLParam="Y"/>
        <Element Name="fld_summary" Class="InputText" FieldName="summary" Label="Summary" ElementSet="Content"/>
        <Element Name="fld_description" Class="LabelTextarea" FieldName="description" Label="Description" ElementSet="Content"/>
        
        <Element Name="fld_type" Class="Listbox" FieldName="type" Label="Type" SelectFrom="trac.enum.do.EnumDO[name], [type]='Type'" Width="120" ElementSet="General"/>
        <Element Name="fld_product" Class="Listbox" FieldName="product_id" Label="Product" SelectFrom="trac.product.do.ProductDO[name:Id]" Width="120" ElementSet="General">
            <EventHandler Name="onchange" Event="onchange" Function="UpdateForm()"/>
        </Element>
        <Element Name="fld_component" Class="Listbox" FieldName="component_id" Label="Component" SelectFrom="trac.component.do.ComponentDO[name:Id],[product_id]={@:Elem[fld_product].Value}" Width="120" ElementSet="General"/>
        <Element Name="fld_version" Class="Listbox" FieldName="version_id" Label="Version" SelectFrom="trac.version.do.VersionDO[name:Id]" Width="120" ElementSet="General"/>
        <Element Name="fld_milestone" Class="Listbox" FieldName="milestone_id" Label="Milestone" SelectFrom="trac.milestone.do.MilestoneDO[name:Id]" Width="120" ElementSet="General"/>
        <Element Name="fld_severity" Class="Listbox" FieldName="severity" Label="Severity" SelectFrom="trac.enum.do.EnumDO[name], [type]='Severity'" Width="120" ElementSet="General"/>
        <Element Name="fld_priority" Class="Listbox" FieldName="priority" Label="Priority" SelectFrom="trac.enum.do.EnumDO[name], [type]='Priority'" Width="120" ElementSet="General"/>
        <Element Name="fld_status" Class="Listbox" FieldName="status" Label="Status" SelectFrom="trac.enum.do.EnumDO[name], [type]='Status'" Width="120" ElementSet="General"/>
        <Element Name="fld_resolution" Class="Listbox" FieldName="resolution" Label="Resolution" SelectFrom="trac.enum.do.EnumDO[name], [type]='Resolution'" Width="120" ElementSet="General"/>
        <Element Name="fld_keywords" Class="InputText" FieldName="keywords" Label="Keywords" ElementSet="General"/>
        
        <Element Name="fld_owner_id" Class="Hidden" FieldName="owner_id" Label="Owner Id" ElementSet="Contact"/>
        <Element Name="fld_owner" Class="InputPicker" FieldName="owner" Label="Owner" ValuePicker="system.form.UserPickForm" PickerMap="fld_owner_id:fld_Id,fld_owner:fld_username" ElementSet="Contact"/>
        <Element Name="fld_reporter" Class="LabelText" FieldName="reporter" Label="Reporter" ElementSet="Contact"/>
        <Element Name="fld_cc" Class="InputText" FieldName="cc" Label="Copy to" ElementSet="Contact"/>
        
        <Element Name="fld_time" Class="LabelText" FieldName="time" Label="Create Time" ElementSet="General"/>
        <Element Name="fld_changetime" Class="LabelText" FieldName="changetime" Label="Change Time" ElementSet="General"/>
        
        <Element Name="fld_comments" Class="Textarea" FieldName="" Label="Comments" ElementSet="Comment"/>
    </DataPanel>
    <ActionPanel>
        <Element Name="btn_save" Class="Button" Text="Save" CssClass="button_gray_m">
            <EventHandler Name="save_onclick" Event="onclick" EventLogMsg=""  Function="UpdateRecord()" RedirectPage="{@home:url}/trac/ticket_detail/{@trac.ticket.do.TicketDO:Field[Id].Value}" ShortcutKey="Ctrl+Enter" ContextMenu="Save" />
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

The new ticket edit form is changed to

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketedit1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketedit1.png)

Apply the similar changes on ticket new form. Keep in mind, a New form should not have "Id" element, or reporter and create time elements. Reporter and create time have special default values defined in TicketDO.xml, so they are generated automatically by core Openbiz BizDataObj class.
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketNewForm" Class="EasyForm" FormType="New" jsClass="jbForm" Title="New Ticket" Description="" BizDataObj="trac.ticket.do.TicketDO" TemplateEngine="Smarty" TemplateFile="ticket_detail.tpl" EventName="" MessageFile="">
    <DataPanel>
        <Element Name="fld_summary" Class="InputText" FieldName="summary" Label="Summary" ElementSet="Content"/>
        <Element Name="fld_description" Class="Textarea" FieldName="description" Label="Description" ElementSet="Content"/>
        
        <Element Name="fld_type" Class="Listbox" FieldName="type" Label="Type" SelectFrom="trac.enum.do.EnumDO[name], [type]='Type'" Width="120" ElementSet="General"/>
        <Element Name="fld_product" Class="Listbox" FieldName="product_id" Label="Product" SelectFrom="trac.product.do.ProductDO[name:Id]" Width="120" ElementSet="General">
            <EventHandler Name="onchange" Event="onchange" Function="UpdateForm()"/>
        </Element>
        <Element Name="fld_component" Class="Listbox" FieldName="component_id" Label="Component" SelectFrom="trac.component.do.ComponentDO[name:Id],[product_id]={@:Elem[fld_product].Value}" Width="120" ElementSet="General"/>
        <Element Name="fld_version" Class="Listbox" FieldName="version_id" Label="Version" SelectFrom="trac.version.do.VersionDO[name:Id]" Width="120" ElementSet="General"/>
        <Element Name="fld_milestone" Class="Listbox" FieldName="milestone_id" Label="Milestone" SelectFrom="trac.milestone.do.MilestoneDO[name:Id]" Width="120" ElementSet="General"/>
        <Element Name="fld_severity" Class="Listbox" FieldName="severity" Label="Severity" SelectFrom="trac.enum.do.EnumDO[name], [type]='Severity'" Width="120" ElementSet="General"/>
        <Element Name="fld_priority" Class="Listbox" FieldName="priority" Label="Priority" SelectFrom="trac.enum.do.EnumDO[name], [type]='Priority'" Width="120" ElementSet="General"/>
        <Element Name="fld_status" Class="Listbox" FieldName="status" Label="Status" SelectFrom="trac.enum.do.EnumDO[name], [type]='Status'" Width="120" ElementSet="General"/>
        <Element Name="fld_resolution" Class="Listbox" FieldName="resolution" Label="Resolution" SelectFrom="trac.enum.do.EnumDO[name], [type]='Resolution'" Width="120" ElementSet="General"/>
        <Element Name="fld_keywords" Class="InputText" FieldName="keywords" Label="Keywords" ElementSet="General"/>
        
        <Element Name="fld_owner_id" Class="Hidden" FieldName="owner_id" Label="Owner Id" ElementSet="Contact"/>
        <Element Name="fld_owner" Class="InputPicker" FieldName="owner" Label="Owner" ValuePicker="system.form.UserPickForm" PickerMap="fld_owner_id:fld_Id,fld_owner:fld_username" ElementSet="Contact"/>
        <Element Name="fld_cc" Class="InputText" FieldName="cc" Label="Copy to" ElementSet="Contact"/>
    </DataPanel>
    <ActionPanel>
        <Element Name="btn_save" Class="Button" Text="Save" CssClass="button_gray_m">
            <EventHandler Name="save_onclick" EventLogMsg="" Event="onclick" Function="InsertRecord()" RedirectPage="form=trac.ticket.form.TicketDetailForm&amp;fld:Id={@trac.ticket.do.TicketDO:Field[Id].Value}"  ShortcutKey="Ctrl+Enter" ContextMenu="Save" />
        </Element>
        <Element Name="btn_cancel" Class="Button" Text="Cancel" CssClass="button_gray_m">
            <EventHandler Name="cancel_onclick" Event="onclick" Function="SwitchForm()"  ShortcutKey="Escape" ContextMenu="Cancel"/>
        </Element>
    </ActionPanel> 
    <NavPanel>
    </NavPanel> 
    <SearchPanel>
    </SearchPanel>
</EasyForm>
```

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketnew1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketnew1.png)

## Add Search and Filter on Ticket List ##
On the ticket list form, it is convenient to allow users to filter by
  * type
  * status
  * priority
  * product
  * component

And a quick search on ticket summary is very useful as well.

In Cubi, the filters and search box can be easily implemented by adding elements in Form SearchPanel.

And add a menu link in mod.xml and update version to 0.1.6 and reload trac module  as all the search form or view interface
```
<?xml version="1.0" standalone="no"?>
<Module Name="trac" Description="trac module" Version="0.1.6" OpenbizVersion="3.0">
	<ACL>
		<Resource Name="trac">
			<Action Name="Access" Description="Access Trac Module Dashboard"/>
		</Resource>
		<Resource Name="trac.ticket">
            <Action Name="Access" Description="Access Trac Ticket"/>
            <Action Name="Manage" Description="Manage Trac Ticket"/>
		</Resource>
    	<Resource Name="trac.admin">
            <Action Name="Manage" Description="Manage Trac"/>
		</Resource>		
	</ACL>
    <Menu>
		<MenuItem Name="Trac" Title="Trac" Description="Trac Description" URL="/trac/dashboard" Parent="" Order="10">
			<MenuItem Name="Trac.Ticket" Title="Ticket" Description="Trac Ticket description" URL="" Parent="" Order="10">
				<MenuItem Name="Trac.Ticket.List" Title="Ticket Manage" Description=""  URL="/trac/ticket_list" Order="10"/>
				<MenuItem Name="Trac.Ticket.Search" Title="Ticket Search" Description=""  URL="/trac/ticket_search" Order="10"/>
			</MenuItem>
			<MenuItem Name="Trac.Admin" Title="Trac Admin" Description="" URL="" Parent="" Order="20">
				<MenuItem Name="Trac.Product.List" Title="Products" Description=""  URL="/trac/product_list" Order="10"/>
				<MenuItem Name="Trac.Component.List" Title="Components" Description=""  URL="/trac/component_list" Order="20"/>
				<MenuItem Name="Trac.Milestone.List" Title="Milestones" Description=""  URL="/trac/milestone_list" Order="30"/>
				<MenuItem Name="Trac.Version.List" Title="Versions" Description=""  URL="/trac/version_list" Order="40"/>
				<MenuItem Name="Trac.Enum.List" Title="Enumerations" Description=""  URL="/trac/enum_list" Order="50"/>	
			</MenuItem>
		</MenuItem>
	</Menu>
    <Dependency>
    	<Module Name="system"/>
    </Dependency>
</Module>
```

```
    <SearchPanel>
        <Element Name="type_filter"  BlankOption="Types" Class="Listbox" FieldName="type" Label="" SelectFrom="trac.enum.do.EnumDO[name], [type]='Type'" width="90" style="float:left;margin-right:5px">
            <EventHandler Name="status_filter_onchange" Event="onchange" Function="RunSearch()"/>
        </Element>
        <Element Name="status_filter"  BlankOption="Status" Class="Listbox" FieldName="status" Label="" SelectFrom="trac.enum.do.EnumDO[name], [type]='Status'" width="90" style="float:left;margin-right:5px">
            <EventHandler Name="status_filter_onchange" Event="onchange" Function="RunSearch()"/>
        </Element>  
		<Element Name="priority_filter"  BlankOption="Priorities" Class="Listbox" FieldName="priority" Label="" SelectFrom="trac.enum.do.EnumDO[name], [type]='Priority'" width="90" style="float:left;margin-right:5px">
            <EventHandler Name="priority_filter_onchange" Event="onchange" Function="RunSearch()"/>
        </Element>
        <Element Name="product_filter"  BlankOption="Products" Class="Listbox" FieldName="product_id" Label="" SelectFrom="trac.product.do.ProductDO[name:Id]" width="90" style="float:left;margin-right:5px">
            <EventHandler Name="product_filter_onchange" Event="onchange" Function="RunSearch()"/>
        </Element>
        <Element Name="component_filter"  BlankOption="Components" Class="Listbox" FieldName="component" Label="" SelectFrom="trac.component.do.ComponentDO[name], [product_id]='{@:Elem[product_filter].Value}'" width="90" style="float:left;margin-right:5px">
            <EventHandler Name="component_filter_onchange" Event="onchange" Function="RunSearch()"/>
        </Element>
    	<Element Name="qry_summary"  Class="InputText" FuzzySearch="Y" SelectFrom="" FieldName="summary" cssFocusClass="input_text_search_focus" CssClass="input_text_search" />
        <Element Name="btn_dosearch" Class="Button" text="Go" CssClass="button_gray">
            <EventHandler Name="search_onclick" Event="onclick" Function="RunSearch()" ShortcutKey="Enter"/>
        </Element> 
    </SearchPanel>
```

The ticket list form needs to have its own template, otherwise the search panel becomes too crowded. For that, we set ` TemplateFile="ticket_list.tpl" ` in TicketListForm.xml.

Create ticket\_list.tpl under /trac/template/ by copying system\_right\_listform.tpl.html under default cubi theme folder and make the change as below.
```
<form id='{$form.name}' name='{$form.name}'>
{literal}
<style>
#main #right_panel .content table.input_row td .label_text{
width:350px;
}
.action_panel{
width:310px;
}
.search_panel{
width:380px;
}
.search_panel select{
float:left;
margin-right:5px;
}
</style>
{/literal}
<div style="padding-left:25px;padding-right:40px;">
<div>
{include file="system_appbuilder_btn.tpl.html"}
<table><tr><td>
    {if $form.icon !='' }
    <div class="form_icon"><img  src="{$form.icon}" border="0" /></div>
    {/if}
    <div style="float:left; width:600px;">
    <h2>
    {$form.title}
    </h2> 
    <p class="form_desc">{$form.description}</p>
    </div>
</td></tr></table>
</div>
{if $actionPanel or $searchPanel }	
<div class="form_header_panel">	
    <div class="action_panel"  style="width:292px;">
    {foreach item=elem from=$actionPanel}
        {$elem.element}
    {/foreach}
    </div>
</div>
<div class="form_header_panel" style="margin-top:2px;">	
    <div class="action_panel" style="width:700px;">

    {foreach item=elem key=name from=$searchPanel}
        {if $elem.label} {$elem.label} {/if} 
        {$elem.element}
    {/foreach}
    </div>
</div>
{/if}	

<div class="from_table_container">
<!-- table start -->
<table border="0" cellpadding="0" cellspacing="0" class="form_table" id="{$form.name}_data_table">
<thead>		
 {foreach item=cell key=elems_name from=$dataPanel.elems}	
    {if $cell.type=='ColumnStyle'}
        {assign var=row_style_name value=$elems_name}     	
    {else}
        {if $cell.type=='RowCheckbox'}
            {assign var=th_style value="text-align:left;padding-left:10px;"}
        {else}
            {assign var=th_style value=""}
        {/if}
     <th onmouseover="this.className='hover'" 
        onmouseout="this.className=''"
            nowrap="nowrap" style="{$th_style}"
        >{$cell.label}</th>	 
    {/if}
 {/foreach}
</thead>
 {assign var=row_counter value=0}            
 {foreach item=row from=$dataPanel.data}
    
     {if $row.$row_style_name != ''}
        {assign var=col_style value=$dataPanel.data.$row_counter.$row_style_name}
     {else}
        {assign var=col_style value=''}
     {/if}
     {assign var=row_style value=''}
     
     {if $row_style != ''}
        <tr id="{$form.name}-{$dataPanel.ids[$row_counter]}" 
                style="{$row_style}"										
                onclick="Openbiz.CallFunction('{$form.name}.SelectRecord({$dataPanel.ids[$row_counter]})');">
     {elseif $form.currentRecordId == $dataPanel.ids[$row_counter]}  
     {assign var=default_selected_id value=$dataPanel.ids[$row_counter]}       	
        <tr id="{$form.name}-{$dataPanel.ids[$row_counter]}" 
                style="{$row_style}"
                class="selected"  normal="even" select="selected"
                onmouseover="if(this.className!='selected')this.className='hover'" 
                onmouseout="if(this.className!='selected')this.className='even'" 
                onclick="Openbiz.CallFunction('{$form.name}.SelectRecord({$dataPanel.ids[$row_counter]})');">
     {elseif $row_counter == 0 and $form.currentRecordId == ""}
     {assign var=default_selected_id value=$dataPanel.ids[$row_counter]}    
        <tr id="{$form.name}-{$dataPanel.ids[$row_counter]}" 
                style="{$row_style}"
                class="selected"  normal="even" select="selected"
                onmouseover="if(this.className!='selected')this.className='hover'" 
                onmouseout="if(this.className!='selected')this.className='even'" 
                onclick="Openbiz.CallFunction('{$form.name}.SelectRecord({$dataPanel.ids[$row_counter]})');">
      {elseif $row_counter is odd}
       <tr id="{$form.name}-{$dataPanel.ids[$row_counter]}" 
                style="{$row_style}"
                class="odd"  normal="odd" select="selected"
                onmouseover="if(this.className!='selected')this.className='hover'" 
                onmouseout="if(this.className!='selected')this.className='odd'"  
                onclick="Openbiz.CallFunction('{$form.name}.SelectRecord({$dataPanel.ids[$row_counter]})');">
     {else}
        <tr id="{$form.name}-{$dataPanel.ids[$row_counter]}" 
                style="{$row_style}"
                class="even"  normal="even" select="selected"
                onmouseover="if(this.className!='selected')this.className='hover'" 
                onmouseout="if(this.className!='selected')this.className='even'" 
                onclick="Openbiz.CallFunction('{$form.name}.SelectRecord({$dataPanel.ids[$row_counter]})');">
     {/if}
     
     {assign var=col_counter value=0}    
     {foreach item=cell key=cell_name from=$row}
        {if $col_counter eq 0}
            {assign var=col_class value=' class="row_header" '}    
        {else}
            {assign var=col_class value=' '}
        {/if}
        {if $cell_name != $row_style_name}
            {if $cell_name == 'fld_type'} 
                {if $col_style != ''}
                    {assign var=row_bgcolor value=background-color:#$col_style;background-image:none;}
                {else}
                    {assign var=row_bgcolor value=background-color:#ffffff;background-image:none;}
                {/if}
            {else}
                {assign var=row_bgcolor value=''}
            {/if}
            {if $cell != ''}            	
              <td {$col_class} style="{$row_bgcolor}" nowrap="nowrap" >{$cell}</td>
            {else}
              <td {$col_class} style="{$row_bgcolor}" nowrap="nowrap" >&nbsp;</td>
            {/if}
        {/if}
        {assign var=col_counter value=$col_counter+1}
     {/foreach}
              
    {assign var=row_counter value=$row_counter+1}
    </tr>
 {/foreach}
                        
</table>
</div>
<!-- status switch  -->
<script>
{if $form.status eq 'Enabled'}
{elseif $form.status eq 'Disabled'}
$('{$form.name}_data_table').fade({literal}{ duration: 0.5, from: 1, to: 0.35 }{/literal});
{/if}
</script>
<span id='{$form.name}_selected_id' style="display:none">{$default_selected_id}</span>
<!-- table end -->	

<div class="form_footer_panel">
    <div class="ajax_indicator">
        <div id='{$form.name}.load_disp' style="display:none" >
            <img src="{$image_url}/form_ajax_loader.gif"/>
        </div>
    </div>
    <div class="navi_panel">
{if $navPanel}
{foreach item=elem from=$navPanel}
    {if $elem.label} <label style="width:68px;">{$elem.label}</label>{/if}
    {$elem.element}
{/foreach}
{/if}
    
    </div>		
</div>
<div class="v_spacer"></div>
</div>
</form>
```

With the new template, the ticket list form is in good shape.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketlist3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketlist3.png)

## Build Other Ticket Pages ##
Now let's find out the missing features by checking feature requirements in Chapter 1. Besides main ticket management page, the trac application needs to some supporting pages
  * Search Tickets
  * My Tickets
  * Tickets reported by me
  * Saved Search

There is a common concept of the 4 pages, that is "search". My tickets are the search results on ticket owner. The ticket reported by me are the search results ticket reporter.

### Search Tickets ###
It is quite easy to build a separate ticket search page after we have created ticket edit form and ticket list form. If basically create a new view that includes ticket search input form (like the edit form) and search result form (like the list form). While there is a couple of special logic to cover in the search form.
  * Run the query and render the query results in the search results form.
  * Save the query executed from the user inputs.
Thus, we need a custom class for the search input form as well as special form template.

We only copy the first 2 line of the form xml here. The full xml file can be found in the trac download.
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="TicketSearchForm" Class="trac.ticket.form.TicketSearchForm" FormType="" jsClass="jbForm" Title="Search Ticket" Description="" BizDataObj="trac.ticket.do.TicketDO" TemplateEngine="Smarty" TemplateFile="ticket_search.tpl" EventName="" MessageFile="trac.msg">
```

The TicketSearchForm class. Here just lists two methods of the form class.
```
    class TicketSearchForm extends EasyForm 
    { 
    protected $ticketListForm = "trac.ticket.form.TicketResultsForm";
    protected $ticketQueryDO = "trac.ticket.do.TicketQueryDO";

    public function searchTicket()
    {
        include_once(OPENBIZ_BIN."/easy/SearchHelper.php");
        $searchRule = "";
        foreach ($this->m_DataPanel as $element)
        {
            if (!$element->m_FieldName)
                continue;

            $value = BizSystem::clientProxy()->getFormInputs($element->m_Name);
            if($element->m_FuzzySearch=="Y")
            {
                $value="*$value*";
            }
            if ($value)
            {
                $searchStr = inputValToRule($element->m_FieldName, $value, $this);
                if ($searchRule == "")
                    $searchRule .= $searchStr;
                else
                    $searchRule .= " AND " . $searchStr;
            }
        }
        
        $searchRuleBindValues = QueryStringParam::getBindValues();
        
        // get the ticket search results form object, set the search rule and redraw that form
        $listFormObj = BizSystem::getObject($this->ticketListForm);
        $listFormObj->setSearchRule($searchRule, $searchRuleBindValues);
        $listFormObj->rerender();
    }

    public function saveSearch()
    {
        // get non-empty input field value pairs
        $recArr = $this->readInputRecord();
        foreach ($recArr as $k=>$v) {	// ignore the empty inputs
            if (empty($v))
                unset($recArr[$k]);
        }
        $saveAs = BizSystem::clientProxy()->getFormInputs("input_saveas");
        
        // serialize it
        $data = serialize($recArr);
        
        // save them in the table
        $queryObj = BizSystem::getObject($this->ticketQueryDO);
        $records = $queryObj->directFetch("[name]='$saveAs'",1);
        if (count($records)>0) {
            $oldRec = $records[0];
            $dataRec = new DataRecord($oldRec, $queryObj);
        }
        else {
            $dataRec = new DataRecord(null, $queryObj);
        }
        $dataRec['name'] = $saveAs;
        $dataRec['search_rules'] = $data;

        try
        {
            $dataRec->save();
        }
        catch (BDOException $e)
        {
            $this->processBDOException($e);
            return;
        }

        // get the message string from a key QUERY_IS_SAVED which is defined in message file trac/message/trac.msg
        $message = $this->getMessage("QUERY_IS_SAVED", array($saveAs));
        // display an alert dialog on browser with given message
        BizSystem::clientProxy()->showClientAlert($message);
        return;
    }
```

With the special template under /trac/template/ticket\_search.tpl, the page is like

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketsearch.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketsearch.png)

### My Tickets and Other Pages ###
Like we discussed before, my ticket page and tickets reported by me page are pages special search criteria. The same rule applies on save query page that displays search results of a saved query. Therefore, they can use the same view with different query string as below.
  * My ticket page url. /trac/search\_ticket/q=my
  * Ticket reported by me url. /trac/search\_ticket/q=me
  * Saved query url. trac/search\_ticket/qid=save\_query\_id

The view xml includes SearchResultsForm.
```
<?xml version="1.0" standalone="no"?>
<EasyView Name="SearchTicketView" Description="Ticket Search Results" Class="EasyView" Access="trac.View_Ticket" TemplateEngine="Smarty" TemplateFile="ticket_view.tpl">
   <FormReferences>
       <Reference Name="trac.ticket.form.SearchResultsForm"/>
   </FormReferences>
</EasyView>
```

The SearchResultsForm is a list form that has its own class.
```
<EasyForm Name="SearchResultsForm" Class="trac.ticket.form.TicketSearchForm" Title="Tickets Search Results" FormType="List" jsClass="jbForm" BizDataObj="trac.ticket.do.TicketDO" TemplateEngine="Smarty" TemplateFile="grid.tpl" PageSize="10">
```

And add trac.msg under /trac/message like below
```
QUERY_IS_SAVED = "Search %s is saved." 
```

The methods that handle the special query logic are that should be added into TicketSearchForm.php
```
    public function fetchDataSet()
    {
        $this->prepareQuery();
        
        return parent::fetchDataSet();
    }

    protected function prepareQuery()
    {
        // handle search with saved query id
        if (isset($_GET['qid']))
        {
            // fetch the saved query record
            $queryObj = BizSystem::getObject($this->ticketQueryDO);
            $record = $queryObj->fetchById($_GET['qid']);
            
            $queryData = unserialize($record['search_rules']);
            $this->m_Title .= " [".$record['name']."]";
            
            include_once(OPENBIZ_BIN."/easy/SearchHelper.php");
            $searchRule = "";
            foreach ($queryData as $fieldName=>$value)
            {
                if ($value)
                {
                    $searchStr = inputValToRule($fieldName, $value, $this);
                    if ($searchRule == "")
                        $searchRule .= $searchStr;
                    else
                        $searchRule .= " AND " . $searchStr;
                }
            }
            
            $this->setFixSearchRule($searchRule,false);
            $this->m_SearchRuleBindValues = QueryStringParam::getBindValues();
        }
        // handle search for my ticket or ticket reported by me
        else if (isset($_GET['q'])) 
        {
            $profile = BizSystem::getUserProfile();
            if ($profile) {
                $userid = $profile['Id'];
                if ($_GET['q'] == 'my')
                    $this->setFixSearchRule("[owner_id]=$userid");
                else if ($_GET['q'] == 'me')
                    $this->setFixSearchRule("[reporter_id]=$userid");
            }
        }
    }
```

### The Saved Query List Form ###
Last we need to a page to view saved queries. This view can be simply created by gen\_meta command line. The steps of creating the metadata are skipped.

The metadata of SavedQueryForm is partially copied below.
```
<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="SavedQueryForm" Class="trac.ticket.form.TicketSearchForm" Title="My saved ticket searches" FormType="List" jsClass="jbForm" BizDataObj="trac.ticket.do.TicketQueryDO" TemplateEngine="Smarty" TemplateFile="grid.tpl" PageSize="10">
    <DataPanel>
        <Element Name="row_selections" Class="RowCheckbox" Label="" FieldName="Id"/>
        <Element Name="fld_Id" Class="ColumnText" FieldName="Id" Label="Id" Sortable="Y" AllowURLParam="N"/>
        <Element Name="fld_name" Class="ColumnText" FieldName="name" Link="{@home:url}/trac/search_ticket/qid={@:Elem[fld_Id].Value}" Label="Search name" Sortable="Y"/>
        <Element Name="fld_search_rules" Class="trac.ticket.form.ColumnSearchRule" FieldName="search_rules" Label="Search rules" Sortable="Y"/>	
    </DataPanel>
```

Please note that the search rules column has a custom element class defined under /trac/ticket/form/ColumnSearchRule.php. This class helps to unserialize the string stored in search\_rules column in trac\_query table, and display the text with ";" as delimiter.
```
class ColumnSearchRule extends ColumnText
{
    public function render()
    {
        $sHTML = "";
        $queryData = unserialize($this->m_Value);
        if (is_array($queryData)) {
            $i = 0;
            foreach ($queryData as $fieldName=>$value)
            {
                $sHTML .= "$fieldName = $value";
                $i++;
                if ($i < count($queryData))
                    $sHTML .= "; ";
            }
        }
        return $sHTML;
    }
}
```

The saved query form looks like
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketsavedsearch.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_ticketsavedsearch.png)