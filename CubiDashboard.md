# Introduction #

Cubi provides developers a set of classes to configure dashboard where end user can add/edit/delete and drag-n-drop pre-configured widgets.

# Use Dashboard #

Cubi dashboard is a special page that allows user to add widgets on it. Different user has it own dashboard widgets. An user can re-arrange the widgets by drag and drop them with mouse.

In Cubi release package, you can find the dashboard page by clicking "My Account" link on the top right of the page, then selecting "My Dashboard" link on the left menu area.

### Empty My Dashboard area ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_1.png)

### Pick widget ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_2.png)

### Widget is added ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_3.png)

### Drag and drop a widget ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_4.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/dashboard_4.png)

# Configure Dashboard #

Dashboard is a special view with a dashboard template. Here we use myaccount/view/MyDashboard.xml to show how to configure a dashboard view.

```
<EasyView Name="MyDashboardView" Description="Account Dashboard" class="common.view.DashboardView" TemplateEngine="Smarty" TemplateFile="dashboard_view.tpl" Access="myaccount.access">
    <FormReferences>

    </FormReferences>
</EasyView>
```

A dashboard view needs to have
  * implementation class as "common.view.DashboardView" or its subclass
  * a template file that include system\_dashboard\_view.tpl.html. dashboard\_view.tpl includes system\_dashboard\_view.tpl.html

## Configure Dashboard Widget ##

As mentioned above, widgets are the blocks which can be added and moved on a dashboard view. Adding a widget in Cubi is easy, just add an entry in 

&lt;Widget&gt;

 section of mod.xml.

For example, in myacount/mod.xml
```
    <Widgets>
        <Widget Name="myaccount.widget.DashboardWidget" Title="My Account Features" Description="" Ordering="10" />
        <Widget Name="myaccount.widget.EventLogWidget" Title="My Event Logs" Description="" Ordering="20" />
    </Widgets>
```

A widget is typical a Form, can also be MenuWidget or a Form-like UI container. A widget needs to be resized in a dashboard area. So try to avoid fixed width in widget template. You can find widget template example from myaccount/template/widget\_grid.tpl.