# Cubi Report #

Cubi Reportis an open source Report, Business Intelligent (BI) application released under GPL V3 license.

## Installation ##

Download the source from SVN. https://openbiz-cubi.googlecode.com/svn/trunk/apps/report

As Report is a Cubi application, you can copy the report folder into cubi/modules/. The load Report into Cubi platform with command
```
# cd cubi/bin/tool/
# php load_module.php report
```

Launch Cubi in your browser, you should see a new tab called "Report" in the application tab area. Click "Report" tab to start exploring Report application.

## Cubi Report Features ##

With Cubi Report, you can
  * Generate reports on live databases
  * Manipulate data by applying custom query, sort and group by
  * Present data in data grid and charts
  * Apply filters on report data
  * Summarize data on pivot table page
  * Organize reports in folders
  * Manage user access to reports

## Report Page ##

Report Page Layout
A typical report page includes
  * left navigation tree
  * report filter form for applying search criteria
  * data grid(s)
  * data chart(s)

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_layout.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_layout.png)

Report Page - Apply Filters

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_apply_filter.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_apply_filter.png)

Report Page - Pivot Table

User can click "Set Pivot" button to configure pivot table

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot_cfg.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot_cfg.png)

Click "Go Pivot" to enter interactive pivot page. User can drag the pivot column or row title to rotate pivot on the fly.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot.png)

Rotate pivot by drag-n-drop column field to row

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot2.png)

## Managing Reports ##

### Creating Reports ###

Steps to create a custom report
  * Create Data Source
    * Create database connection
    * Map table to data table
    * Map table columns to fields

  * Create Report
    * Create report page
    * Create report forms (data, chart or filter forms)
    * Create form elements (columns, chart series or inputs)

### Managing Reports - Databases ###

Report database list

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_database.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_database.png)

Edit report database

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_database_edit.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_database_edit.png)

### Managing Reports - Data Tables and Fields ###

Report table list

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table.png)

Report table detail. If user clicks on "Populate Fields" button, all table columns will loaded as report table fields

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table_detail.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table_detail.png)

User can add join from another table to the main table and add column from join table

Add join table

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table_addjoin.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table_addjoin.png)

Add join field from join table

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table_addjoinfield.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_table_addjoinfield.png)


### Managing Reports - Report Pages ###

After configure report database and tables, Report page can be setup on top of the data layer

Report page list

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report.png)

Report page edit. Group is used for access control

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_edit.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_edit.png)

A report page may contain multiple report forms. Each form is a UI block to present data. There are 3 form types:
  * Filter form for user to enter query
  * Data grid form
  * Data chart form

### Managing Reports - Report Forms ###

Report page forms

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form.png)

User can edit report form with four tabs

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit1.png)

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit2.png)

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit3.png)

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit4.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_edit4.png)

### Managing Reports - Elements ###

In the report form detail page, user can click "Load Forms" to create data grid form with elements populated from table fields automatically

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_elems.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_report_form_elems.png)

### Manage Report Tree ###

Report Map provides tree structure to organize report pages.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_map_mgr.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_map_mgr.png)

User can edit a node in the tree and set group for access control

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_map_edit.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_map_edit.png)


## My Report ##

Once report pages are created and mapped properly in report tree, user can see his/her reports that are visible to the user on My report page.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_myreport.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_myreport.png)

## Normal View for report ##

The above section introduce you how to create report with Report Admin. User does not need to write code to generate reports. On the other hand, developers can write normal Cubi views with report layout and pivot layout. These views have their own xml metadata files and own urls.

Sample report view can be found at report/view/SampleSalesReportView.xml
```
<?xml version="1.0" standalone="no"?>
<EasyView Name="SampleSalesReportView" Description="Sample sales report" Class="EasyView" Tab="" TemplateEngine="Smarty" TemplateFile="view_report.tpl.html">
   <FormReferences>
   	<Reference Name="report.sample.form.SalesListGrid"/>
        <Reference Name="report.sample.form.SalesColumnChart"/>
        <Reference Name="report.sample.form.SalesColumnChart2"/>
   </FormReferences>  
</EasyView>
```

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_normal_view.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_normal_view.png)

Also pivot table is a special form with example at report/view/SamplePivotTableView.xml
```
<?xml version="1.0" standalone="no"?>
<EasyView Name="SamplePivotTableView" Description="report.sample" Class="EasyView" Tab="" TemplateEngine="Smarty" TemplateFile="view_report.tpl.html" Access="">
   <FormReferences>
   	<Reference Name="report.sample.form.SamplePivotTableForm"/>
   </FormReferences> 
</EasyView>
```

The form xml is at /report/sample/form/SamplePivotTableForm.xml. Please notice a new attribute "PivotType" is added in Form Element definition.
```
<EasyForm Name="SamplePivotTableForm" Class="common.form.PivotTableForm" FormType="" jsClass="Openbiz.TableForm" Title="Sales of TVs" Description="" BizDataObj="report.sample.do.SampleSalesDO" TemplateEngine="PHP" TemplateFile="pivot_table.tpl.html">
    <DataPanel> 
        <Element Name="fld_division" Class="common.element.PivotColumnText" FieldName="division" Label="Division" PivotType="Column"/>
        <Element Name="fld_product" Class="common.element.PivotColumnText" FieldName="product" Label="Product" PivotType="Column"/>
        <Element Name="fld_year" Class="common.element.PivotColumnText" FieldName="year" Label="Year" PivotType="Row"/>
        <Element Name="fld_revenue" Class="common.element.PivotColumnText" FieldName="revenue" Label="Revenue" PivotType="Data"/>
        <Element Name="fld_cost" Class="common.element.PivotColumnText" FieldName="cost" Label="Cost" PivotType="Data" />
    </DataPanel>
...
```

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot_table.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/report/report_pivot_table.png)