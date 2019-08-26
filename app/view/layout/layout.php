<html ng-app="App" >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="app/view/public/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="app/view/public/css/style.css" rel="stylesheet" />
		
		<script src="app/view/public/js/angular.js"></script>
		<script src="app/view/public/js/angular-route.js"></script>
		<script src="app/view/public/js/dirPagination.js"></script>
		<script src="app/view/public/js/jquery-2.1.1.min.js"></script>
		<script src="app/view/public/bootstrap/js/popper.min.js"></script>
		<script src="app/view/public/bootstrap/js/bootstrap.min.js"></script>
		<script src="app/view/public/js/controller.js"></script>
		<script src="app/view/public/js/functionjquery.js"></script>
		<script src="app/view/public/js/validation.js"></script>
	</head>
	<body >
		<div class="" >
			<?php echo $content;?>
		</div>
	</body>
	<script>
    ! function(window, document, $) {
        "use strict";
        $("input").not("[type=submit]").jqBootstrapValidation();
    }(window, document, jQuery);
    </script>
</html>