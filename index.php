<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>GM Panel - Regnum World</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="view/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="view/plugins/select2/select2.min.css">
<link rel="stylesheet" href="view/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="view/plugins/iCheck/all.css">
<link rel="stylesheet" href="view/plugins/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="view/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="view/dist/css/skins/skin-blue.min.css">
<link rel="stylesheet" href="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    
<?php
	//Init Sessions
	session_start();

	define('DIR_SERVER', 'C:\\Server\\');

	require_once '../library/request.php';
	require_once '../library/interface.php';
	require_once '../library/hex.php';
	require_once 'model/Model.php';
	require_once 'view/view.php';
	require_once 'controller/controller.php';
	require_once '../library/SQLConnection.php';
		
	$header = $_SERVER['HTTP_USER_AGENT'];
	
	//Compare if client can visualize GM Panel
//	if( (Request::getHeader('HTTP_STDHANDLE') == 'MAEDOSANDURR')  )
	{
		//Get Controller from Link
		$controller = Request::get('page');
		$action = Request::get('action');
		$todo = '';
		$allowed = array();
		
		//If action its null, get the parameter 3
		if( $action == '' )
			$todo = Request::getByOrder(2);
	
		//Default Controller
		if( $controller == '' )
			$controller = 'Login';

		//Filters Page
		if( Request::getSession('level') == 1 && $action != 'logout' )
		{
			if( $controller != 'Main' || $controller != 'user' )
				$controller = 'Main';

			/*if( $controller == 'user' && $action == 'addcredits' )
				$controller = 'Main';*/
		}

		if( !Request::getSession('account') )
		{
			array_push( $allowed, 'Login' );

			if( !in_array( $controller, $allowed) )
				$controller = 'Login';
		}
		else if( Request::getSession('account') && Request::getSession('token') && $controller === 'Login' && $action != 'logout' )
		{
			$controller = 'Main';

			//Token isnt valid?
			if( !Model::CheckToken(Request::getSession('account'),Request::getSession('token')))
			{
				$controller = 'Login';
				$action = 'logout';
			}
		}
						
		//Verify if Controller File exists
		if (file_exists("controller/{$controller}Controller.php")) 
			require_once "controller/{$controller}Controller.php";
		else 
		{
			UI::ShowError('The controller not exist.');
			exit;
		}
	
		//Controller Name + Controller
		$controller .= 'Controller';
		
		//Create a pointer Controller
		$controller = new $controller();
		
		//Get action to Controller
		if( $action == '' && $todo == '' )
			$action = 'index';
		else if( $action == '' && $todo != '' )
			$action = $todo;
			
		//Execute Action from Controller
		if (method_exists($controller, $action))
			$controller->$action();
		else
		{
			UI::ShowError('The action not exist.');
			exit;
		}
	}
	/*else
	{
		header('Location: http://user.fortresspt.net/userpanel');
		exit;
	}
	*/
?>

</div>

<!-- jQuery 2.1.4 -->
<script src="view/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="view/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="view/plugins/select2/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="view/dist/js/app.min.js"></script>
<!-- Data Table -->
<script src="view/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="view/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- Date Range -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="view/plugins/daterangepicker/daterangepicker.js"></script>
<!-- InputMask -->
<script src="view/plugins/input-mask/jquery.inputmask.js"></script>
<script src="view/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="view/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- iCheck 1.0.1 -->
<script src="view/plugins/iCheck/icheck.min.js"></script>
<script src="view/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>

<script>       
	$('#dataTables').DataTable();      
</script>

<script>
if (window.location.href.indexOf("?page=support&open") > -1)
	$("#opentct").addClass("active");
else if (window.location.href.indexOf("?page=support&reply") > -1)
{
}
else if (window.location.href.indexOf("?page=support&closed") > -1)
	$("#closetct").addClass("active");
else
	$("#alltct").addClass("active");
</script>

<script type="text/javascript">
  $('select').select2();
  
  //Datemask2 mm/dd/yyyy
  $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
  
  //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
</script>

<script>
  $(function () {
	//bootstrap WYSIHTML5 - text editor
	$(".textarea").wysihtml5(
		{
			useLineBreaks: true, 
		}
	);
  });
</script>

<script type="text/javascript">
$(document).ready( function () {
    $('#data1').DataTable();
    $('#data2').DataTable();
    $('#data3').DataTable();
    $('#data4').DataTable();
    $('#data5').DataTable();
    $('#data6').DataTable();
    $('#data7').DataTable();
    $('#data8').DataTable();
    $('#data9').DataTable();
    $('#data10').DataTable();
} );
</script>

</body>
</html>
