<div class="menu_title" >
<h2>{$widget.title}</h2>
<p style="float:right;display:block;padding-top:4px;">
<span style="display: block;float: left;"><a class="menu_index_link" href="{$app_index}/system/general_default">{t}Index{/t}</a></span> 
<a href="{$app_index}/system/general_default"><img id="system_dashboard" class="btn_dashboard"  src="{$image_url}/spacer.gif" border="0" /></a></p>
</div>
<div ng-controller="LeftMenuController" ng-init="init('{$form.name}','{$form.dataService}','{$form.queryString}')">
<ul class="toplevel {$widget.css} left_menu">
	<li ng-repeat="node in treeNodes">
		<a onclick="show_submenu(this)">
			<img ng-class="node.m_IconCSSClass" ng-src="{$image_url}/{literal}{{{/literal}node.m_IconImage{literal}}}{/literal}" />
			{literal}{{{/literal}node.m_Name{literal}}}{/literal}
		</a>	
		<ul class="secondlevel module">
			<li ng-repeat="subitem in node.m_ChildNodes">		
				<a class="{$submenu_class}" href="{literal}{{{/literal}subitem.m_URL{literal}}}{/literal}">
				{literal}{{{/literal}subitem.m_Name{literal}}}{/literal}</a>
			</li>
		</ul>
	</li>
</ul>
</div>
<div class="v_spacer"></div>