  <!doctype html>
<html lang="en">

<head>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/ico" href="">
  <!-- Bootstrap CSS -->
  <link href="<?php echo BASE_URL; ?>assets/front/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!--- Custom css --->
  <link href="<?php echo BASE_URL; ?>assets/front/css/style1.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/front/css/responsive.css" rel="stylesheet">
  <link href="<?php echo BASE_URL; ?>assets/front/css/font-awesome.css" rel="stylesheet">
  <script src="<?php echo BASE_URL; ?>assets/usertheme/js/sweetalert.min.js"></script>
  <title>Codego Sandbox</title>
<style>
.formheading{
	font-size: 14px;
	font-weight: 306;
	color: #64a5ff;
	padding: 0px;
	margin-bottom: 20px;
	}
.error{ color:red !important;}
</style>
  <?php echo $this->renderSection("styles");?>
</head>
<body>
 <?php echo view('templates/front_header'); ?>
<div class="container">
  <h2></h2>

  <?php echo $this->renderSection("body");?>
  
</div>


<?php echo view('templates/front_footer'); ?>
 
  <?php echo $this->renderSection("scripts");?>
</body>
</html>
