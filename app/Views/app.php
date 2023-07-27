  <!doctype html>
<html lang="en">

<head>
  <meta name="google-site-verification" content="jlByZLO42gqjZgfAEj29-VYfJC2hEwUj1KSeQpiGJcI" />
  <link rel="canonical" href="https://techarise.com/" />
  <meta name="author" content="TechArise">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/ico" href="">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <!--- Custom css --->
  <!--link href="<?php //print HTTP_CSS_PATH; ?>sticky-footer-navbar.css" rel="stylesheet">
  <link href="<?php //print HTTP_CSS_PATH; ?>style.css" rel="stylesheet"-->
  <title>Test CodeIgniter</title>
  <style>
    .error{ color:red;}
  </style>
  <?php echo $this->renderSection("styles");?>
</head>
<body>
 <?php echo view('templates/header'); ?>
<div class="container">
  <h2></h2>
    <?php if(session()->get('success')){?>
        <div class="alert alert-success">
            <?php echo session()->get('success');?>
        </div>
    <?php } ?>
    <?php if(session()->get('error')){?>
         <div class="alert alert-error">
            <?php echo session()->get('error');?>
        </div>
    <?php } ?>
  <?php echo $this->renderSection("body");?>
  
</div>


<?php echo view('templates/footer'); ?>
 
  <?php echo $this->renderSection("scripts");?>
</body>
</html>
