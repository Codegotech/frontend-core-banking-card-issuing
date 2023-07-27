<?php echo $this->extend("Views\loginlayout") ?>
<?php echo $this->section("title")?>
<?php echo $this->endSection()?>
<?php echo $this->section("body")?>
<script src='https://www.google.com/recaptcha/api.js'></script>
<section class="get_sec head_curve">
    <div class="container">
    	<div class="login_info">
        	<div class="row g-0">
            	<div class="col-xl-5 col-lg-6 col-md-5">
                	<figure><img src="<?php echo BASE_URL?>assets/front/images/6195495_3129575.jpg" alt=""></figure>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-7">
                    <form class="form_info" action="" method="post" id="signupform">
						<?php $validation=validation_list_errors();?>
						<?php if (!empty($validation)) : ?>
							<div class="alert alert-warning">
								<?=  $validation; ?>
							</div>
						<?php endif; ?>
						<?php if (session()->getFlashdata('msg')) : ?>
							<div class="alert alert-warning">
								<?= session()->getFlashdata('msg') ?>
							</div>
						<?php endif; ?>
						 <?php if (session()->getFlashdata('success')) : ?>
							<div class="alert alert-success">
								<?= session()->getFlashdata('success') ?>
							</div>
						<?php endif; ?>
						 <?php if (session()->getFlashdata('error')) : ?>
							<div class="alert alert-danger">
								<?= session()->getFlashdata('error') ?>
							</div>
						<?php endif; ?>
                    	<h2 class="title font_lato"><small>Signup</small>Create Account</h2>
                        <p>Please Signup to create your account.</p>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Email Address</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>">
                            </div> 
							<div class="form-group col-12">                               
                                <div class="g-recaptcha" data-sitekey="<?php echo GOOGLE_SITE_KEY;?>"></div>  
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-gradient">sign up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php echo $this->endSection()?>
<?php echo $this->section("scripts")?>
<script>
jQuery(document).ready(function () {
	$.validator.addMethod("noSpace", function(value) {

		  return value.indexOf(" ") < 0 && value != ""; 

	});

    $('#signupform').validate({
		rules: {		 
		  email: {
			required: true,  
			noSpace: true,
		  },		
		},
		messages: {
		  email: {
			required: "Please enter email address",
			noSpace: "No space in email",
		  }
		},
		invalidHandler: function(form, validator) {
		if (!validator.numberOfInvalids())
		{
			return;
		}else{
			var error_element=validator.errorList[0].element;
			error_element.focus();
		}
		},
		highlight: function (element) {
		 
		},
		unhighlight: function (element) {
		  $(element).parent().removeClass('error')
		},
		submitHandler: function(form) 
		{
			var recaptcha = $("#g-recaptcha-response").val();
			if (recaptcha === ""){
				swal({
					title: '',
					text: 'Please verify captcha',
					icon: "error",  
					dangerMode: false,
					timer: 3000
				});
			}else{			
				return true;	
			}
		}
	  }); 
	});
</script>  
<?php echo $this->endSection()?>
