<?php
class homeController extends Controller{
	
	public function __construct(){
		$this->verifySession(); 
	}
	
	//////////////MUESTRA LA PAGINA DE BIENVENIDA LUEGO DE LOGIN/////////
	public function home(){
		require("app/view/modules/home.php");
	}
	
	public function getPosts(){
		$postData = file_get_contents("php://input");
		$dataObject = json_decode($postData);
		$url = 'https://api.dev.graphs.social/v4/graphs';
		$http = 'POST'; 
		$data = array(				
				'access_token'=>$_SESSION['Bearer'],
		);
		$response = $this->realizaPeticionGet($url, $http, $data);	
		$response = json_decode($response);
		
	
		/*$compare=0;
		if(empty($_SESSION['response'])){
			$_SESSION['response'] = $response; ///si el array respose esta vacio lo defined
		}
		$compare = $this->compareData($_SESSION['response'], $response);
		if($compare == 1){
			$_SESSION['response'] = $response;
		}
		
		$response = $_SESSION['response'];	*/	
		$posts=array();
		$entries = $this->getKeysEntries($response);//Se obtienen los keys del array entries
		$data_ids = $this->getDataEntries($response, $entries);//Se obtienen los datos del array entries
		$documnet = $this->getDocument($response, $entries);//Se obtienen los datos posts del array document
				
		for($doc=0; $doc < count($documnet); $doc ++){
			if(isset($documnet[$doc]->title) && !empty($documnet[$doc]->title) && isset($documnet[$doc]->description) && 
			!empty($documnet[$doc]->description)){
				$id = $data_ids["id"][$doc];
				$name = $documnet[$doc]->title;
				$description = $documnet[$doc]->description;
				$posts[]=array("id"=>$id, "name"=>$name, "description"=>$description);
			}
		}
		echo json_encode($posts);
	}
	
	public function create(){
		require("app/view/modules/create.php");
	}
	
	public function createPosts(){
		$postData = file_get_contents("php://input");
		$dataObject = json_decode($postData);
		$url = 'https://api.dev.graphs.social/v4/graphs/';
		$http = 'POST'; 
		$data = array(
			'access_token'=>$_SESSION['Bearer'],
			'entity'=>'post',
			'container_id'=>'5d0051fc3039353ff68410e8',          
			'title'=>$dataObject->data->name,
			'description'=>$dataObject->data->description
		);
		$response = $this->realizaPeticionPost($url, $http, $data);
		print_r($response);
	}
	
	public function editPosts(){
		$postData = file_get_contents("php://input");
		$dataObject = json_decode($postData);
		$url = 'https://api.dev.graphs.social/v4/graphs/'.$dataObject->data->id.'?access_token='.$_SESSION['Bearer'].'&title='.$dataObject->data->name.'&description='.$dataObject->data->description;
		$http = 'PUT'; 
		$data = array(
		);
		$response = $this->realizaPeticionPut($url, $http, $data);
		print_r($response);
	}
	
	public function removePosts(){
		$postData = file_get_contents("php://input");
		$dataObject = json_decode($postData);
		$url = 'https://api.dev.graphs.social/v4/graphs/'.$dataObject->id.'?access_token='.$_SESSION['Bearer'];
		$http = 'DELETE'; 
		$data = array(
		);
		$response = $this->realizaPeticionDelete($url, $http, $data);
		print_r($response);
	}
} 
?>