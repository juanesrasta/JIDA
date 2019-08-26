<?php
ob_start();
?>


<div class="page-wrapper" style="min-height: 254px;">
<div class="container-fluid" >
<div class="card" ng-controller="AppCtrl1">
	<div class="card-body">
		<div class="form-group col-md-4" style="float: left;">
             <h4 class="card-title">Module Create</h4>
        <h6 class="card-subtitle">Create New Posts</h6> 
		</div>	
       
		<div class="button-group col-md-8" style="float: right; text-align:right; margin-top:1%;">
            <button ng-click="home();" type="button" class="btn waves-effect waves-light btn-outline-secondary">Home</button>
        </div>	
		<br />		
		<br />		
		<hr />   
        <form class="m-t-40" novalidate="" style="padding-top:3%; padding-bottom:15%;">
			<div class="form-group col-sm-6" style="display:inline-block;float:left">
                <h5>Title <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="text" ng-model="data.name" class="form-control" required="" data-validation-required-message="This field is required"> 
					<div class="help-block"></div>
				</div>
            </div>
            <div class="form-group col-sm-6" style="display:inline-block;">
                <h5>Description <span class="text-danger">*</span></h5>
                <div class="controls">
                    <input type="text" name="text"  ng-model="data.description" class="form-control" required="" data-validation-required-message="This field is required"> 
					<div class="help-block"></div>
				</div>
            </div>
            
			<div class="" style="text-align: center">
                <button class="btn  btn-success" ng-click="create();">Save</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>

<?php 
	$content = ob_get_clean()
?>
<?php include("app/view/layout/layout.php");
?>