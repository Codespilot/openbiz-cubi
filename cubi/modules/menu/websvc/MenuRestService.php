<?php

include_once MODULE_PATH.'/websvc/lib/RestService.php';
include_once OPENBIZ_BIN.'data/private/BizDataObj_SQLHelper.php';

class MenuRestService extends RestService
{
	protected $resourceDOMap = array('menus'=>'menu.do.MenuTreeDO');
	
	/*
	 * Query by page, rows, sort, sorder
	 *
	 * @param string $resource
	 * @param Object $request, Slim Request object
	 * @param Object $response, Slim Response object
     * @return void 
	 */
	public function query($resource, $request, $response)
    {
		$DOName = $this->getDOName($resource);
		if (empty($DOName)) {
			$response->status(404);
			$response->body("Resource '$resource' is not found.");
			return;
		}
		// get page and sort parameters
		$allGetVars = $request->get();
		$queryParams = array();
		foreach ($allGetVars as $key=>$value) {
			if ($key == 'depth' || $key == 'format') {
				continue;
			}
			//if ($value !== null && $value !== '') {
				$queryParams[$key] = $value;
			//}
		}
		$depth = $request->params('depth');
		if (!$depth) $depth = 1;
		
		$dataObj = BizSystem::getObject($DOName);
		$tree = $dataObj->fetchTreeByQueryParams($queryParams, $depth);
		/*
		// include app tab - PId's sibling nodes
		$PId = $request->params('PId');
		// first find the menu record with Id=PId and get its app_root_menu_PId
		$appRootMenuRec = $dataObj->fetchById($PId);
		$appRootMenuRecPId = $appRootMenuRec['PId'];
		// then find menu records whose PId=app_root_menu_PId
		$appTab = $dataObj->fetchTreeBySearchRule("[PId]='$appRootMenuRecPId' AND [published]=1", 1);
		
		$comboMenus = array('tree'=>$tree,'tab'=>$appTab);
		*/
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode($tree));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->createNode($tree);
			$response->body($xml);
		}
		return;
    }
}
?>