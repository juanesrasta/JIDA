var app = angular.module("App",['ngRoute','angularUtils.directives.dirPagination']);
app.controller("AppCtrl", function($scope,  $http, $location, $route){
	localStorage.setItem("cid", 0);
	$scope.data = {};
	$scope.initSession = function(){
		$http.post(
			'index.php?ctl=session',
			{
				data : $scope.data
			}
		).success(function(session){
			console.log(session);
			if(session.data.status == 'connected'){
				location.href = 'index.php?ctl=home';
				$scope.getPosts();
			}else{
				$scope.form_doc1 = true;
				return false;
			}
		}).error(function(){
			alert("Error iniciando sesión");
		});
	};	
	
	$scope.getPosts = function(){
		$http.post(
			'index.php?ctl=getposts'
		).success(function(posts){
			$scope.getData = posts
		}).error(function(){
			alert("Error obteniendo datos");
		});
	};
});

app.controller("AppCtrl1", function($scope,  $http, $location, $route){	
	$scope.data = {};
	$scope.cases = 'create';
	$scope.getPosts = function(){
		$http.post(
			'index.php?ctl=getposts'
		).success(function(posts){
			$scope.getData = posts
		}).error(function(){
			alert("Error obteniendo datos");
		});
	};
	
	$scope.createNew = function(){
		location.href = 'index.php?ctl=new'
	};
	
	$scope.create = function(){
		if($scope.data !== "" && $scope.data !== undefined){
			if($scope.data.name == "" || $scope.data.name == undefined|| 
			$scope.data.description == "" || $scope.data.description == undefined ){
				return false;
			}else{
				if($scope.cases == 'create'){
					$scope.executeCreate($scope.data);
				}else if($scope.cases == 'edit'){
					$scope.executeEdit($scope.data);
				}
			}
		}
	};
	
	$scope.executeCreate = function(data){
		$http.post(
			'index.php?ctl=create',
			{
				data : data
			}
		).success(function(create){
			if(create.status == "ok"){
				alert("Exito creando Posts. Este alert es esteticamente mejorable!");
				$scope.clean();
			}else{
				alert("No fue posible crear Posts");
			}
			//$scope.clean();
		}).error(function(){
			alert("Error creando posts");
		});
	};
	
	$scope.preEdit = function(edata){
		$scope.data = edata;
		$scope.cases = 'edit';
	};
	
	$scope.executeEdit = function(data){
		$http.post(
			'index.php?ctl=edit',
			{
				data : data
			}
		).success(function(edit){
			if(edit.status == "ok"){
				alert("Exito modificando Posts. Este alert es esteticamente mejorable!");
				$scope.getPosts();
			}else{
				alert("No fue posible modificar Posts");
			}
		}).error(function(){
			alert("Error editando posts");
		});
	};
	
	$scope.executeRemove = function(id){
		$http.post(
			'index.php?ctl=remove',
			{
				id : id
			}
		).success(function(remove){
			if(remove.status == "ok"){
				alert("Exito eliminando Posts. Este alert es esteticamente mejorable!");
				$scope.getPosts();
			}else{
				alert("No fue posible eliminar Posts");
			}
		}).error(function(){
			alert("Error eliminando posts");
		});
	};
	
	$scope.clean = function(){
		$scope.data = {
			id: "",
			name: "",
			description: "",
		};
		$scope.cases = 'create';
	};
	
	$scope.home = function(){
		location.href = 'index.php?ctl=home'
	};
	
	$scope.logout = function(){
		location.href = 'index.php?ctl=logout'
	};
	
	$scope.getPosts();
	$scope.clean();
});