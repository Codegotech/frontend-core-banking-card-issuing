<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<meta name="theme-color" content="#4FAC68" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/favicon.png" />
<title><?php echo $title; ?></title>
<!-- Bootstrap -->
<link href="<?php echo BASE_URL; ?>assets/usertheme/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>assets/usertheme/css/style.css"  rel="stylesheet">
<link href="<?php echo BASE_URL; ?>assets/usertheme/css/theme.css"  rel="stylesheet">
<link href="<?php echo BASE_URL; ?>assets/usertheme/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo BASE_URL; ?>assets/usertheme/css/responsive.css" rel="stylesheet">
<!-- Custom scrollbars CSS -->
<link href="<?php echo BASE_URL; ?>assets/usertheme/css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- Owl Stylesheets -->
<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/usertheme/css/owl.carousel.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/usertheme/js/sweetalert.min.js"></script>
<style>
.error{ color:red !important;}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">	
	<div class="content-wrapper">
		<?php echo $this->renderSection("body");?>
	</div>	
</body>
</html>
