function sendData(){
	if($("#usr").val() == "" || $("#usr").val() == undefined){
		
	}else if($("#pswd").val() == "" || $("#pswd").val() == undefined){
		
	}else{
		executeSendData();
	}
}

function executeSendData(){
	angular.element(document.getElementById('wrapper')).scope().initSession();
}