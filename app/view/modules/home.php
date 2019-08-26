<?php
ob_start();
?>
<div class="card" ng-controller="AppCtrl1">
    <div class="card-body">
		<div class="form-group col-md-4" style="float: left;">
             <h4 class="card-title">Jida Testing</h4>
        <h6 class="card-subtitle">Web Service</h6> 
		</div>	
       
		<div class="button-group col-md-8" style="float: right; text-align:right; margin-top:1%;">
            <button ng-click="logout();" type="button" class="btn waves-effect waves-light btn-outline-secondary">Log out</button>
        </div>	
		<br />		
		<br />		
		<hr />
		
		<div class="button-group col-md-2" style="float: right; text-align:right; padding-top: 1%;">
            <button class="btn waves-effect waves-light btn-outline-secondary" ng-click="createNew();">Create new</button>
        </div>	
		
		<div class="form-group col-md-8" style="float: left;">
            <input type="text" class="form-control" ng-model="search" style="border-left:none; border-right:none; border-top:none;border-radius:0px;"  placeholder="Search"> 
		</div>		
			
        <div class="table-responsive m-t-40">			
            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
					<th>
						<input type="text" name="text" ng-model="data.id" class="form-control" required="" data-validation-required-message="This field is required" disabled> 
						<div class="help-block"></div>
					</th>
					<th>
						<input type="text" name="text" ng-model="data.name" class="form-control" required="" data-validation-required-message="This field is required"> 
						<div class="help-block"></div>
					</th>			
					<th colspan="2">
						<input type="text" name="text"  ng-model="data.description" class="form-control" required="" data-validation-required-message="This field is required"> 
						<div class="help-block"></div>
					</th>
					<th>
						<button class="btn  btn-success" ng-click="create();">Execute Edit</button>
					</th>
				</thead>
				<thead>
					<th>Id</th>
					<th>Title</th>			
					<th>Description</th>			
					<th>Editar</th>			
					<th>Remove</th>			
                </thead>
                <tbody>
					<tr dir-paginate="data in getData |orderBy:sortKey:reverse| filter: search|itemsPerPage:5">
						<td>{{data.id}}</td>
						<td>{{data.name}}</td>
						<td>{{data.description}}</td>
						<td><button class="btn waves-effect waves-light btn-outline-success" ng-click="preEdit(data);">Edit</button></td>
						<td><button class="btn waves-effect waves-light btn-outline-danger" ng-click="executeRemove(data.id);">Remove</button></td>
					</tr>
                </tbody>
            </table>
			<dir-pagination-controls
				max-size="5"
				direction-links="true"
				boundary-links="true" >
			</dir-pagination-controls>
        </div>
    </div>
</div>
<?php 
	$content = ob_get_clean()
?>
<?php include("app/view/layout/layout.php");
?>