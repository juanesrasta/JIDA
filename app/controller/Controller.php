<?php
session_start();
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
class Controller{
	public $conexion = 'https://auth.dev.graphs.social';
	public $id = '5b51eb29303935456453d09a';
	
	
	public function login(){
		$_SESSION['Bearer']="";
		$_SESSION['response']=array();
		require("app/view/modules/login.php");
	}
	
	public function initSession(){
		$postData = file_get_contents("php://input");
		$dataObject = json_decode($postData);
		$url = $this->conexion.'/v3/login?email='
		.$dataObject->data->email.'&password='.$dataObject->data->password.'&application_id='.$this->id;
		$http = 'GET'; 
		
		$data = array();
		////CONSUMIMOS DE LA API////////////////
		try{
			$response = $this->realizaPeticionGet($url, $http, $data);
			$response = json_decode($response);
			if(isset($response->data->access_token) && !empty($response->data->access_token) && $response->data->status == 'connected'){
				echo json_encode(array('status'=>$response->data->status,'data'=>$response->data));
				$_SESSION['Bearer'] = $response->data->access_token;
			}else{
				$_SESSION['Bearer'] = "";
				echo json_encode(0);
			}
			
		}catch(Exception $e){
			echo json_encode(0);
		}
	}
	
	public function logout(){
		$url = $this->conexion.'/v4/login/logout?access_token='.$_SESSION['Bearer'];
		$http="GET";
		$data=array();
		$response = $this->realizaPeticionGet($url, $http, $data);
		header("location: index.php?ctl=login"); 
	}
	//////////////////////////////////////////////////////////////////////
	//////////"INSTANCIAREMOS ESTE METODO PARA CONSUMIR API CON GET"/////	
	public function realizaPeticionGet($url, $http, $data){
		Requests::register_autoloader();
		$request = Requests::get($url,
			array('Content-Type' => 'application/json'),
			$data
		);
		return($request->body);       
    }
	
	///////////////////////////////////////////////////////////////////////
	//////////"INSTANCIAREMOS ESTE METODO PARA CONSUMIR API CON POST"/////	
	public function realizaPeticionPost($url, $http, $data){
		Requests::register_autoloader();
		$request = Requests::post($url, array(), $data);
		return($request->body);       
    }
	
	///////////////////////////////////////////////////////////////////////
	//////////"INSTANCIAREMOS ESTE METODO PARA CONSUMIR API CON PUT"/////	
	public function realizaPeticionPut($url, $http, $data){
		Requests::register_autoloader();
		$request = Requests::put($url, array(), $data);
		return($request->body);       
    }
	
	///////////////////////////////////////////////////////////////////////
	//////////"INSTANCIAREMOS ESTE METODO PARA CONSUMIR API CON DELETE"/////	
	public function realizaPeticionDelete($url, $http, $data){
		Requests::register_autoloader();
		$request = Requests::delete(
			$url, 
			array(
				'Content-Type' => 'application/json'
			), 
			$data
		);
		return($request->body);       
    }
	
	public function getKeysEntries($response){
		$entries = array();
		for($d=0; $d < count(get_object_vars($response->data->entries)); $d ++){
			$object = get_object_vars($response->data->entries);
			$entries = array_keys($object);
		}
		return $entries;
	}
	
	public function compareData($session_response, $response){
		$session_entries = $this->getKeysEntries($session_response);
		$response_entries = $this->getKeysEntries($response);
		$diff = 0;
		for($e=0; $e< count($session_entries); $e++){
			$objsession[] =  get_object_vars($session_response->data->data);
			$objresponse[] =  get_object_vars($response->data->data);
			if($objsession[$e][$session_entries[$e]]->time_updated != $objresponse[$e][$response_entries[$e]]->time_updated){
				$diff = 1;
			}
		}
		return $diff;
	}
	
	public function getDataEntries($response, $entries){
		$arr_id = array();
		$arr_create = array();
		$arr_update = array();
		$arr_all=array();
		for($e=0; $e < count($entries); $e++){
			$objid[] = get_object_vars($response->data->data);
			$arr_id[] = $objid[$e][$entries[$e]]->id;
			$arr_create[] = $objid[$e][$entries[$e]]->time_created;
			$arr_update[] = $objid[$e][$entries[$e]]->time_updated;			
		}
		return $arr_all=array("id"=>$arr_id, "time_created"=>$arr_create, "time_updated"=>$arr_update);
	}
	
	public function getDocument($response, $entries){
		$document = array();
		for($e=0; $e < count($entries); $e++){
			$objdocument[] = get_object_vars($response->data->data);
			$document[] = $objdocument[$e][$entries[$e]]->document;
		}
		return $document;
	}
	
	public function verifySession(){
		if(isset($_SESSION['Bearer']) && !empty($_SESSION['Bearer'])){
			return true;
		}else{
			header('location:index.php?ctl=login');
		}
	}
} 
?>