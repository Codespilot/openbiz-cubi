<?php
/**
 * Openbiz Cubi Application Platform
 *
 * LICENSE http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 *
 * @package   cubi.websvc.lib
 * @copyright Copyright (c) 2005-2011, Openbiz Technology LLC
 * @license   http://code.google.com/p/openbiz-cubi/wiki/CubiLicense
 * @link      http://code.google.com/p/openbiz-cubi/
 * @version   $Id$
 */

include_once 'Array2Xml.php';

/**
 * Base class of rest service
 *
 */
class RestService
{
	/*
	 * Resource DataObject name mapping
	 * Please change the following mapping in the extended classes
	 */
	protected $resourceDOMap = array('resource_name'=>'module.do.ResourceDO');
    
	/*
	 * Get DataObject name
	 *
	 * @param string $resource
     * @return string 
	 */
    public function getDOName($resource)
    {
		return $this->resourceDOMap[$resource];
    }
	
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
			if ($key == 'page' || $key == 'rows' || $key == 'sort' || $key == 'sorder' || $key == 'format') {
				continue;
			}
			if ($value !== null && $value !== '') {
				$queryParams[$key] = $value;			
			}
		}
		$page = $request->params('page');
		if (!$page) $page = 0;
		if ($page>=1) $page--;
		$rows = $request->params('rows');
		if (!$rows) $rows = 10;
		$sort = $request->params('sort');
		$sorder = $request->params('sorder');
		
		$dataObj = BizSystem::getObject($DOName);
		$dataObj->resetRules();
		//$dataObj->m_Stateless = 'N';
		$dataObj->setQueryParameters($queryParams);
		$dataObj->setLimit($rows, $page*$rows);
		if ($sort && $sorder) {
			$dataObj->setSortRule("[$sort] $sorder");
		}
		$dataSet = $dataObj->fetch();
		$total = $dataObj->count();
		$totalPage = ceil($total/$rows);
		
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode(array('totalPage'=>$totalPage,'data'=>$dataSet->toArray())));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->setDataAttribute('totalPage',$totalPage);
			$xml->createNode($dataSet->toArray());
			$response->body($xml);
		}
		return;
    }
	
	/*
	 * Query by page, rows, sort, sorder
	 *
	 * @param string $resource
	 * @param Object $request, Slim Request object
	 * @param Object $response, Slim Response object
     * @return void 
	 */
	public function queryChildren($resource, $id, $childresource, $request, $response)
    {
		$DOName = $this->getDOName($resource);
		if (empty($DOName)) {
			$response->status(404);
			$response->body("Resource '$resource' is not found.");
			return;
		}
		// handle child resource
		if ($childresource) {
			$childDOName = $this->getDOName($childresource);
			if (empty($childDOName)) {
				$response->status(404);
				$response->body("Child Resource '$childresource' is not found.");
				return;
			}
		}
		// get page and sort parameters
		$allGetVars = $request->get();
		$queryParams = array();
		foreach ($allGetVars as $key=>$value) {
			if ($key == 'page' || $key == 'rows' || $key == 'sort' || $key == 'sorder' || $key == 'format') {
				continue;
			}
			if ($value !== null && $value !== '') {
				$queryParams[$key] = $value;			
			}
		}
		$page = $request->params('page');
		if (!$page) $page = 0;
		if ($page>=1) $page--;
		$rows = $request->params('rows');
		if (!$rows) $rows = 10;
		$sort = $request->params('sort');
		$sorder = $request->params('sorder');
		
		// main DO
		$dataObj = BizSystem::getObject($DOName);
		$rec = $dataObj->fetchById($id);
		// get child DO
		$childDataObj = $rec->getRefObject($childDOName);
		$childDataObj->resetRules();
		//$dataObj->m_Stateless = 'N';
		$childDataObj->setQueryParameters($queryParams);
		$childDataObj->setLimit($rows, $page*$rows);
		if ($sort && $sorder) {
			$childDataObj->setSortRule("[$sort] $sorder");
		}
		$dataSet = $childDataObj->fetch();
		$total = $childDataObj->count();
		$totalPage = ceil($total/$rows);
		
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode(array('totalPage'=>$totalPage,'data'=>$dataSet->toArray())));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->setDataAttribute('totalPage',$totalPage);
			$xml->createNode($dataSet->toArray());
			$response->body($xml);
		}
		return;
    }
    
	/*
	 * Get data record by id
	 *
	 * @param string $resource
	 * @param mixed $id
	 * @param Object $request, Slim Request object
	 * @param Object $response, Slim Response object
     * @return void 
	 */
    public function get($resource, $id, $request, $response)
    {
		$DOName = $this->getDOName($resource);
		if (empty($DOName)) {
			$response->status(404);
			$response->body("Resource '$resource' is not found.");
			return;
		}
		$dataObj = BizSystem::getObject($DOName);
		$rec = $dataObj->fetchById($id);
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode($rec->toArray()));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->createNode($rec->toArray());
			$response->body($xml);
		}
		return;
    }
	
	/*
	 * Insert data record
	 *
	 * @param string $resource
	 * @param Object $request, Slim Request object
	 * @param Object $response, Slim Response object
     * @return void 
	 */
	public function post($resource, $request, $response)
    {
		$DOName = $this->getDOName($resource);
		if (empty($DOName)) {
			$response->status(404);
			$response->body("Resource '$resource' is not found.");
			return;
		}
		$dataObj = BizSystem::getObject($DOName);
		$dataRec = new DataRecord(null, $dataObj);
		$inputRecord = json_decode($request->getBody());
        foreach ($inputRecord as $k => $v) {
            $dataRec[$k] = $v; // or $dataRec->$k = $v;
		}
        try {
           $dataRec->save();
        }
        catch (ValidationException $e) {
            $response->status(400);
			$errmsg = implode("\n",$e->m_Errors);
			$response->body($errmsg);
			return;
        }
        catch (BDOException $e) {
            $response->status(400);
			$response->body($e->getMessage());
			return;
        }
		
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode($dataRec->toArray()));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->createNode($dataRec->toArray());
			$response->body($xml);
		}
		return;
    }
	
	/*
	 * Update data record by id
	 *
	 * @param string $resource
	 * @param mixed $id
	 * @param Object $request, Slim Request object
	 * @param Object $response, Slim Response object
     * @return void 
	 */
	public function put($resource, $id, $request, $response)
    {
		$DOName = $this->getDOName($resource);
		if (empty($DOName)) {
			$response->status(404);
			$response->body("Resource '$resource' is not found.");
			return;
		}
		$dataObj = BizSystem::getObject($DOName);
		$rec = $dataObj->fetchById($id);
		if (empty($rec)) {
			$response->status(400);
			$response->body("No data is found for $resource $id");
			return;
		}
		$dataRec = new DataRecord($rec, $dataObj);
		$inputRecord = json_decode($request->getBody());
        foreach ($inputRecord as $k => $v) {
            $dataRec[$k] = $v; // or $dataRec->$k = $v;
		}
		
        try {
           $dataRec->save();
        }
        catch (ValidationException $e) {
            $response->status(400);
			$errmsg = implode("\n",$e->m_Errors);
			$response->body($errmsg);
			return;
        }
        catch (BDOException $e) {
            $response->status(400);
			$response->body($e->getMessage());
			return;
        }
		
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode($dataRec->toArray()));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->createNode($dataRec->toArray());
			$response->body($xml);
		}
		return;
    }
	
	/*
	 * Delete data record by id
	 *
	 * @param string $resource
	 * @param mixed $id
	 * @param Object $request, Slim Request object
	 * @param Object $response, Slim Response object
     * @return void 
	 */
	public function delete($resource, $id, $request, $response)
    {
		$DOName = $this->getDOName($resource);
		if (empty($DOName)) {
			$response->status(404);
			$response->body("Resource '$resource' is not found.");
			return;
		}
		$dataObj = BizSystem::getObject($DOName);
		$rec = $dataObj->fetchById($id);
		if (empty($rec)) {
			$response->status(400);
			$response->body("No data is found for $resource $id");
			return;
		}
		$dataRec = new DataRecord($rec, $dataObj);
        try {
           $dataRec->delete();
        }
        catch (BDOException $e) {
            $response->status(400);
			$response->body($e->getMessage());
			return;
        }
		
		$format = strtolower($request->params('format'));
		
		$response->status(200);
		//$message = "Successfully deleted record of $resource $id";
		if ($format == 'json') {
			$response['Content-Type'] = 'application/json';
			$response->body(json_encode($dataRec->toArray()));
		}
		else {
			$response['Content-Type'] = "text/xml; charset=utf-8"; 
			$xml = new array2xml('Data');
			$xml->createNode($dataRec->toArray());
			$response->body($xml);
		}
		return;
    }
}

?>