/**
 * Openbiz browser javascript library
 * @author rockys swen
 */

// MenuService
var openbizServices = angular.module('Openbiz.services', []);
openbizServices.service('MenuService',function ($http, $location) {

	var dataService;
    var appMenuTree;
	var appMainTab;
	var breadcrumb;
	var onRequest = false;
	var menuList;
	
	this.init = function (dataService) {
		this.dataService = dataService;
	}
	
	this.getMenuTree = function (queryString, callback) {
		console.log("enter getMenuTree");
		var url = this.dataService+'/q?format=json';
		if (queryString) url += '&'+queryString;
		$http.get(url).success(function(responseObj) {
			console.log("return getMenuTree responseObj");
			callback(responseObj);
			//return responseObj;
		});
    }
    /*
    this.getAppMenu = function (queryString) {
		this.appMenuTree = this.getMenuTree(queryString);
		this.matchLocationPath();
		return this.appMenuTree;
    }
	
	this.getMainTab = function (queryString) {
		this.appMainTab = this.getMenuTree(queryString);
		return this.appMainTab;
	}
	*/
	this.getBreadcrumb = function () {
		return this.breadcrumb;
	}
	
	this.matchLocationPath = function (menuTree) {
		console.log("enter matchLocationPath");
		// find the current node by matching with location url
		for (var i=0; i<menuTree.length; i++) {
			menuTree[i].m_Current = $location.path() == menuTree[i].m_URL ? 1:0;
			if (menuTree[i].m_ChildNodes) {
				for (var j=0; j<menuTree[i].m_ChildNodes.length; j++) {
					menuTree[i].m_ChildNodes[j].m_Current = $location.path() == menuTree[i].m_ChildNodes[j].m_URL ? 1:0;
					if (menuTree[i].m_ChildNodes[j].m_Current == 1) {
						menuTree[i].m_Current = 1;
						console.log(menuTree[i].m_ChildNodes[j]);
						//break;
					}
				}
			}
			/*if (menuTree[i].m_Current == 1) {
				break;
			}*/
		}
	}
});

/**
 * Define a parent controller.
 *
 * @param {Object} $scope
 */
function TableFormController($scope, $http, $location) {
	$scope.currentPage = 1;
	$scope.totalPage = 1;
	$scope.sort = "";
	$scope.sorder = "";
	$scope.urlPath = $location.path();

	$scope.init = function(name, dataService) {
		$scope.name = name;
		$scope.dataService = dataService;
		
		$scope.gotoPage(1);
	}

	$scope.gotoPage = function(page) {
		if (page < 1) return;
		if (page > $scope.totalPage) return;
		$scope.fetchData(page, $scope.sort, $scope.sorder, null);
	}
	
	$scope.sortRecord = function(field) {
		// if sort on the field, toggle the sort order
		if (field == $scope.sort) {
			if ($scope.sorder == "") fieldOrder = "asc";
			else if ($scope.sorder == "asc") fieldOrder = "desc";
			else fieldOrder = "asc";
		}
		else {
			fieldOrder = "asc";
		}
		$scope.fetchData(1, field, fieldOrder, null);
	}
	
	$scope.search = function() {
		// run search with user input on searchPanel
		if (typeof $scope.searchPanel != 'undefined' && $scope.searchPanel != null) {
			var elemValues = [];
			for (var key in $scope.searchPanel) {
				elemValues.push(key+"="+$scope.searchPanel[key]);
			}
			var queryString = elemValues.join("&");
			$scope.fetchData(1, $scope.sort, $scope.sorder, queryString);
		}
	}
	
	$scope.fetchData = function (page, sortField, sortOrder, queryString) {
		var url = $scope.dataService+'/q?format=json';
		if (page != null) url += '&page='+page;
		if (sortField && sortOrder) url += '&sort='+sortField+'&sorder='+sortOrder;
		if (queryString) url += '&'+queryString;
		$http.get(url).success(function(responseObj) {
			$scope.dataset = responseObj.data;
			$scope.totalPage = responseObj.totalPage;
			$scope.currentPage = page;
			$scope.sort = sortField;
			$scope.sorder = sortOrder;
		});
	}
}

function LeftMenuController($scope, $http, $location, MenuService) {
	$scope.init = function(name, dataService, queryString) {
		$scope.name = name;
		$scope.dataService = dataService;
		/*
		var url = $scope.dataService+'/q?format=json';
		if (queryString) url += '&'+queryString;
		$http.get(url).success(function(responseObj) {
			$scope.treeNodes = responseObj;
			$scope.matchLocationPath();
			//$scope.matchTreeNodes();
		});*/
		MenuService.init(dataService);
		$scope.treeNodes = MenuService.getMenuTree(queryString, function(data){
			MenuService.matchLocationPath(data);
			$scope.treeNodes = data;
		});
		
		console.log("location path is "+$location.path());
	}
	
	$scope.matchTreeNodes = function() {
		// find the current node by matching with application breadcrumb
		bcIds = [];
		for (var k=0; k<breadCrumb.length; k++) {
			bcIds.push(breadCrumb[k].id);
		}
		for (var i=0; i<$scope.treeNodes.length; i++) {
			$scope.treeNodes[i].m_Current = bcIds.indexOf($scope.treeNodes[i].m_Id) >= 0 ? 1:0;
			if ($scope.treeNodes[i].m_Current == 1) {
				if ($scope.treeNodes[i].m_ChildNodes) {
					for (var j=0; j<$scope.treeNodes[i].m_ChildNodes.length; j++) {
						$scope.treeNodes[i].m_ChildNodes[j].m_Current = bcIds.indexOf($scope.treeNodes[i].m_ChildNodes[j].m_Id) >= 0 ? 1:0;
						if ($scope.treeNodes[i].m_ChildNodes[j].m_Current == 1) break;
					}
				}
				console.log($scope.treeNodes[i]);
				break;
			}
		}
	}
	
	$scope.matchLocationPath = function() {
		// find the current node by matching with location url
		for (var i=0; i<$scope.treeNodes.length; i++) {
			$scope.treeNodes[i].m_Current = $location.path() == $scope.treeNodes[i].m_URL ? 1:0;
			if ($scope.treeNodes[i].m_ChildNodes) {
				for (var j=0; j<$scope.treeNodes[i].m_ChildNodes.length; j++) {
					$scope.treeNodes[i].m_ChildNodes[j].m_Current = $location.path() == $scope.treeNodes[i].m_ChildNodes[j].m_URL ? 1:0;
					if ($scope.treeNodes[i].m_ChildNodes[j].m_Current == 1) {
						$scope.treeNodes[i].m_Current = 1;
						console.log($scope.treeNodes[i].m_ChildNodes[j]);
						break;
					}
				}
			}
			//console.log($scope.treeNodes[i]);
			if ($scope.treeNodes[i].m_Current == 1) {
				break;
			}
		}
	}
	
	$scope.isCurrent = function(path) {
		return $location.path() == path;
	}
}

function CFormController($scope, $resource, $window, $location) {
	$scope.dataobj = {};
	$scope.id = '';
	
	$scope.init = function(name, dataService, queryString) {
		$scope.name = name;
		$scope.dataService = dataService;
		$scope.id = getQueryVariable(queryString, 'Id');
		
		var Model = $resource(dataService+'/:id'+'?format=json',{id: $scope.id});
		
		if ($scope.id == '' || $scope.id == null) {
			$scope.dataobj = new Model();
		}
		else {
			// get the data with given record id
			$scope.dataobj = Model.get({}, function() {
				console.log($scope.dataobj);
			}, function(errorObj) {
				console.log(errorObj);
			});
		}
	}
	
	$scope.save = function(redirectPage) {
		var formData = angular.copy($scope.dataobj);
		formData.$save(function(data) {
			console.log("Data is successfully saved.");
			var redirectUrl = APP_INDEX+redirectPage+data.Id;
			console.log("Redirect to page "+redirectUrl);
			//$window.location.href = redirectUrl;	// this is full page load
			$location.path(redirectUrl);	// this is not full page load
		}, function(errorObj) {
			console.log(errorObj);
		});
	}
	
	$scope.delete = function() {
	
	}
	
	$scope.submit = function() {
	
	}
	
	$scope.back = function() {
		history.go(-1);
	}
}

function getQueryVariable(queryString, variable) {
    var vars = queryString.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}