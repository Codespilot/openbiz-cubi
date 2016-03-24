# Learn Cubi By Examples Chapter 3 - Add Components #

At the end of previous chapter, we used the metadata generation tool to create 'trac' module and metadata files for ticket. You should be able to view and enter data in ticket view. This chapter will guide you to add components in trac module as well as enhance ticket forms.

## Add Components ##
If you tried to create a new ticket on the ticket form created in previous chapter, you must notice that you have to enter free text for ticket's type, priority, severity, status and resolution. Also you don't know what to enter for product id, component id, version id, milestone id, owner id and reporter id. It apparently has something missing. Let's add these components one by one.

### Add Product ###
As we learned from previous chapter, here we use gen\_meta to generate metadata for product. The table is "trac\_product" and we want to put the component under cubi/modules/trac/product/.
```
# php gen_meta.php Default trac_product trac.product
---------------------------------------
Please select metadata naming:
1. module path: \trac\product, object name: TracProduct, module name: trac.product
2. module path: \trac\product, object name: Product, module name: trac.product
S. specify a custom module path, object name and module name
Please select: [1/2/s] (1) : 2

Access control options:
1. Access and Manage (default)
2. Access, Create, Update and Delete
3. No access control
Please select access control type [1/2/3] (1) :

---------------------------------------
Target dir: C:\xampp\htdocs\test\cubi4\modules\trac\product
Medata file to create:
  do/ProductDO.xml
  form/Product...Form.xml
  view/ProductView.xml
Do you want to continue? [y/n] (y) :
---------------------------------------
Do you want to generate data Object? [y/n] (y) :
Generate Data Object metadata file ...
Start generate dataobject ProductDO.
Create directory C:\xampp\htdocs\test\cubi4\modules/trac/product/do
        /trac/product/do/ProductDO.xml is generated.
---------------------------------------
Do you want to generate form Object? [y/n] (y) :
Generate Form Object metadata files ...
Start generate form object ProductListForm.
Create directory C:\xampp\htdocs\test\cubi4\modules/trac/product/form
        /trac/product/form/ProductListForm.xml is generated.

Start generate form object ProductNewForm.
        /trac/product/form/ProductNewForm.xml is generated.

Start generate form object ProductEditForm.
        /trac/product/form/ProductEditForm.xml is generated.

Start generate form object ProductDetailForm.
        /trac/product/form/ProductDetailForm.xml is generated.

Start generate form object ProductCopyForm.
        /trac/product/form/ProductCopyForm.xml is generated.

---------------------------------------
Do you want to generate view Object? [y/n] (y) :
Generate view Object metadata files ...
Start generate form object ProductListView.
        /trac/view/ProductListView.xml is generated.
---------------------------------------
Do you want to generate module dashboard files? [y/n] (y) : n
---------------------------------------
Do you want to modify mod.xml? [y/n] (y) :
Modify mod.xml ...
Start modify mod.xml.
        /trac/mod.xml is modified.
```

The mod.xml is changed by the gen\_meta as well.
```
<?xml version="1.0" standalone="no"?>
<Module Name="trac" Description="trac module" Version="0.1.1" OpenbizVersion="3.0">
    <ACL>
        <Resource Name="trac">
            <Action Name="Access" Description="Access Trac Module Dashboard"/>
        </Resource>
        <Resource Name="trac.ticket">
            <Action Name="Access" Description="Access Trac Ticket"/>
            <Action Name="Manage" Description="Manage Trac Ticket"/>
        </Resource>
            <Resource Name="trac.product">
            <Action Name="Access" Description="Access TracProduct"/>
            <Action Name="Manage" Description="Manage TracProduct"/>
        </Resource>
    </ACL>
    <Menu>
        <MenuItem Name="Trac" Title="Trac" Description="Trac Description" URL="/trac/dashboard" Parent="" Order="10">
            <MenuItem Name="Trac.Ticket" Title="Ticket" Description="Trac Ticket description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Ticket.List" Title="Ticket Manage" Description=""  URL="/trac/ticket_list" Order="10"/>
            </MenuItem>	
            <MenuItem Name="Trac.Product" Title="Product" Description="Trac Product description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Product.List" Title="Product Manage" Description=""  URL="/trac/product_list" Order="10"/>
            </MenuItem>
        </MenuItem>
	</Menu>
    <Dependency>
    	<Module Name="system"/>
    </Dependency>
</Module>
```

In order to load the newly added parts (ACL and menu items) in mod.xml to Cubi, you need to increase the version number.
```
<Module Name="trac" Description="trac module" Version="0.1.1" OpenbizVersion="3.0">
```

Then use the command line below to load the trac to Cubi
```
# php load_module.php trac
Start loading trac module ...
--------------------------------------------------------
[2011-10-09T22:52:00-07:00] Loading module trac
[2011-10-09T22:52:00-07:00] Install Module trac
[2011-10-09T22:52:00-07:00] Install Module ACL.
[2011-10-09T22:52:00-07:00] Install Module Menu.
[2011-10-09T22:52:00-07:00] Install Module Widget.
[2011-10-09T22:52:00-07:00] Install Module Resource.
[2011-10-09T22:52:00-07:00] Install Module Change Logs.
[2011-10-09T22:52:00-07:00] Copy resource files to /cubi/resources folder.
[2011-10-09T22:52:00-07:00] trac is loaded.

Give admin to access all actions of module 'trac'
--------------------------------------------------------
End loading trac module
```

You can see a new item is added in the trac dashboard page
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_dashboard1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_dashboard1.jpg)

Clicking "Product Manage" link to land on the product management view where you can do the basic create/edit/delete operations.
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_product.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_product.jpg)

Following what we did for product, we can easily create other components:
  * product component.
  * milestone
  * version
  * enumeration for ticket type, priority, severity, status and resolution

#### Add Component ####
# php gen\_meta.php Default trac\_component trac.component

Please select #2 in the metadata naming options (in the first question)

Let's no worry about how to link product component with product and owner now. We will come to it in next paragraphs.

#### Add Milestone ####
# php gen\_meta.php Default trac\_milestone trac.milestone

Please select #2 in the metadata naming options (in the first question)

#### Add Version ####
# php gen\_meta.php Default trac\_version trac.version

Please select #2 in the metadata naming options (in the first question)

#### Add enumeration ####
# php gen\_meta.php Default trac\_enum trac.enum

Please select #2 in the metadata naming options (in the first question)

### A Quick Review ###
After we generate metadata in previous steps, the mod.xml becomes
```
<?xml version="1.0" standalone="no"?>
<Module Name="trac" Description="trac module" Version="0.1.2" OpenbizVersion="3.0">
    <ACL>
        <Resource Name="trac">
            <Action Name="Access" Description="Access Trac Module Dashboard"/>
        </Resource>
        <Resource Name="trac.ticket">
            <Action Name="Access" Description="Access Trac Ticket"/>
            <Action Name="Manage" Description="Manage Trac Ticket"/>
        </Resource>
            <Resource Name="trac.product">
            <Action Name="Access" Description="Access TracProduct"/>
            <Action Name="Manage" Description="Manage TracProduct"/>
        </Resource>
            <Resource Name="trac.component">
            <Action Name="Access" Description="Access TracComponent"/>
            <Action Name="Manage" Description="Manage TracComponent"/>
        </Resource>
        <Resource Name="trac.milestone">
            <Action Name="Access" Description="Access TracMilestone"/>
            <Action Name="Manage" Description="Manage TracMilestone"/>
        </Resource>
        <Resource Name="trac.version">
            <Action Name="Access" Description="Access TracVersion"/>
            <Action Name="Manage" Description="Manage TracVersion"/>
        </Resource>
        <Resource Name="trac.enum">
            <Action Name="Access" Description="Access TracEnum"/>
            <Action Name="Manage" Description="Manage TracEnum"/>
        </Resource>
    </ACL>
    <Menu>
        <MenuItem Name="Trac" Title="Trac" Description="Trac Description" URL="/trac/dashboard" Parent="" Order="10">
            <MenuItem Name="Trac.Ticket" Title="Ticket" Description="Trac Ticket description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Ticket.List" Title="Ticket Manage" Description=""  URL="/trac/ticket_list" Order="10"/>
            </MenuItem>	
            <MenuItem Name="Trac.Product" Title="Product" Description="Trac Product description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Product.List" Title="Product Manage" Description=""  URL="/trac/product_list" Order="10"/>
            </MenuItem>
            <MenuItem Name="Trac.Component" Title="Component" Description="Trac Component description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Component.List" Title="Component Manage" Description=""  URL="/trac/component_list" Order="10"/>
            </MenuItem>
            <MenuItem Name="Trac.Milestone" Title="Milestone" Description="Trac Milestone description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Milestone.List" Title="Milestone Manage" Description=""  URL="/trac/milestone_list" Order="10"/>
            </MenuItem>
            <MenuItem Name="Trac.Version" Title="Version" Description="Trac Version description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Version.List" Title="Version Manage" Description=""  URL="/trac/version_list" Order="10"/>
            </MenuItem>
            <MenuItem Name="Trac.Enum" Title="Enum" Description="Trac Enum description" URL="" Parent="" Order="10">
                <MenuItem Name="Trac.Enum.List" Title="Enum Manage" Description=""  URL="/trac/enum_list" Order="10"/>
            </MenuItem>
        </MenuItem>
	</Menu>
    <Dependency>
    	<Module Name="system"/>
    </Dependency>
</Module>
```

Let's increase the Version to 0.1.3, then load module with
# php load\_module.php trac

The new dashboard looks like
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_dashboard2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_dashboard2.jpg)

## Change ACL and Menu ##
By the production requirement, we want to put the management pages for product, component, milestone, version and enumeration into a "Trac Admin" menu group with single access control. This is to say that if one can manage product, the same user can manage component, milestone, version and enumeration. Meanwhile we want to leave all ticket operations in the "Ticket" menu group with ticket specific access control. Thus we change the mod.xml as below.
```
<?xml version="1.0" standalone="no"?>
<Module Name="trac" Description="trac module" Version="0.1.5" OpenbizVersion="3.0">
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

As we changed the ACL in mod.xml, we need to change the "Access" attribute in corresponding metadata files. To make it simple, we can just replace the following text with "trac.admin.Manage" in all metadata file under trac/.

(for example:
in EnumDO.xml
change  CreateCondition="trac.enum.Manage" UpdateCondition="trac.enum.Manage" DeleteCondition="trac.enum.Manage"
to
CreateCondition="trac.admin.Manage" UpdateCondition="trac.admin.Manage" DeleteCondition="trac.admin.Manage"

in EnumListForm.xml
change
four Access="trac.enum.Manage"
to     Access="trac.admin.Manage"

and
change
EnumListForm.xml's Access and EnumListView.xml's Access attribute to
EasyForm Name="EnumListForm" Class="EasyForm" FormType="List" jsClass="jbForm" Title="Enum Management" Description="" BizDataObj="trac.enum.do.EnumDO" PageSize="10" DefaultForm="Y" TemplateEngine="Smarty" TemplateFile="grid.tpl" EventName="" MessageFile="" Access="trac.admin.Manage"
)
  * trac.version.Access, trac.version.Manage
  * trac.milestone.Access, trac.milestone.Manage
  * trac.product.Access, trac.product.Manage
  * trac.component.Access, trac.component.Manage
  * trac.enum.Access, trac.enum.Manage

Let's increase the Version to 0.1.5, then load module with
# php load\_module.php trac

The new dashboard looks like
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_dashboard3.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/learnbyexamples/trac_dashboard3.jpg)

Now that we have the supporting components created, we can come back to enrich the ticket forms in the next chapter [Enrich Ticket Forms](LearnCubiByExamplesC4.md)