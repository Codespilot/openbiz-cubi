<?xml version="1.0" encoding="UTF-8"?>
<EasyForm Name="DocumentListDetailForm" Class="EasyForm" FormType="List" jsClass="jbForm" Title="" Description="" BizDataObj="collab.document.do.DocumentDO" PageSize="-1" DefaultForm="Y" TemplateEngine="Smarty" TemplateFile="element_listform_lite.tpl.html"  Access="collab_document.access" >
    <DataPanel>           
        <Element Name="fld_share" Class="ColumnShare" MyPrivateImg="{RESOURCE_URL}/collab/document/images/icon_document_private.png" MySharedImg="{RESOURCE_URL}/collab/document/images/icon_document_shared.png" MyAssignedImg="{RESOURCE_URL}/collab/document/images/icon_document_assigned.png" MyDistributedImg="{RESOURCE_URL}/collab/document/images/icon_document_distributed.png" GroupSharedImg="{RESOURCE_URL}/collab/document/images/icon_document_shared_group.png" OtherSharedImg="{RESOURCE_URL}/collab/document/images/icon_document_shared_other.png" FieldName="create_by" Label="Share" Sortable="Y" AllowURLParam="N" Translatable="N" OnEventLog="N" Link="javascript:;">
 		</Element>	
		<Element Name="fld_Id" Class="common.element.ColumnTitle" Hidden="N" FieldName="Id" Label="ID" Sortable="Y"/>

        <Element Name="fld_title" MaxLength="20" Class="ColumnText" FieldName="title" Label="Title" Link="{APP_INDEX}/collab/document_detail/{@:Elem[fld_Id].Value}" Sortable="Y" >
         	<!-- <EventHandler Name="fld_subject_onclick" Event="onclick" Function="ParentSwitchForm(collab.document.form.DocumentDetailForm,{@:Elem[fld_Id].Value})"   /> -->
         </Element>	
        <Element Name="fld_description" Class="ColumnText" MaxLength="20" FieldName="description" Label="Description" Sortable="Y" AllowURLParam="N" Translatable="N" OnEventLog="N"/>	
     
		<Element Name="fld_type" Class="ColumnText" Style="line-height:24px;" FieldName="type_name" Label="Type" Sortable="Y" AllowURLParam="N" Translatable="N" OnEventLog="N"/>						        
        <Element Name="fld_color" Class="ColumnStyle" FieldName="type_color" Label="Type"  Sortable="Y" AllowURLParam="N" Translatable="N" OnEventLog="N" />
    </DataPanel>
    <ActionPanel>
    </ActionPanel> 
    <NavPanel>

    </NavPanel> 

</EasyForm>
