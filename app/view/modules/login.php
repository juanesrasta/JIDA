<?php
ob_start();
?>
<section id="wrapper" ng-controller="AppCtrl">
    <div class="login-register" style="background-image:url(app/view/public/assets/images/b1.jpg); ">        
        <div class="login-box card">
        <div class="card-body">
            <form id="loginform" >
                <h3 class="box-title m-b-20">Sign In</h3>
				<div class="form-group">
                    <h5>Email <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" ng-model="data.email" class="form-control" required data-validation-required-message="This field is required"> 
					</div>
                </div>
                <div class="form-group">
                    <h5>Password<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="password" name="password" ng-model="data.password" class="form-control" required data-validation-required-message="This field is required"> 
						</div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button ng-click="initSession();" type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">
							Log In
						</button>
                    </div>
                </div>
                <div class="form-group m-b-0">
                    <div class="col-sm-12 text-center">
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>  
</section>
<div class="row">
    <div class="col-md-4">
        <div  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Ventajas y Desventajas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-title">
									<strong>Ventajas:</strong>
								</p>
									<p>La actividad no es nada complicada. Se puede realizar en un periodo de tiempo breve.</p>
                                <p class="modal-title">
									<strong>Desventajas:</strong>
								</p>
									<p>Flujo de información.</p>
									<p>Dudas sobre la lógica de Cache. Por lo general se emplea para evitar realizar consultas	al Servidor, cuando no han ocurrido cambios en la data, sin embargo estamos yendo al servidor para refrescar la información, luego estamos comparando, en busca de cambios. Pero ya hicimos la petición al servidor. ???</p>   
									<p>Modificar un grafo no especifica parametro CAMPOS A EDITAR. {status: "error", code: "404", message: "That's an invalid action call."}</p>
									<p>Eliminar un grafo no especifica parametro ID. Eror {status: "error", code: "404", message: "That's an invalid action call."}</p>
									<p>Listado de POSTS Funciona con GET</p>
									<p>La API array(document nodevuelve title, devuelve name)</p>
									<p>Luego de crear el prmer POSTS la estructura del array que me envia es distinta a lo indicado 
									el api.md </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <span id="modal" data-toggle="modal" data-target=".bs-example-modal-lg" ></span>
    </div>                 
</div>
<script>
	$("#modal").trigger("click");
</script>
<?php 
	$content = ob_get_clean()
?>
<?php include("app/view/layout/layout.php");
?>