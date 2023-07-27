<?php echo $this->extend("Views\loginlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>

<?php

   if(isset($validation)){

     print_r($validation->listErrors());
   }

?>

<?php echo $this->section("body")?>
<style>
.formheading{
	font-size: 14px;
	font-weight: 306;
	color: #64a5ff;
	padding: 0px;
	margin-bottom: 20px;
	}
</style>
<!-- Get Section -->
<section class="get_sec head_curve">
    <div class="container">
    	<div class="login_info">
        	<div class="row g-0">
            	 <div class="col-xl-12 col-lg-12 col-md-12">				
					 <form class="form_info" style="margin-top: -45px;" id="signupform" action="<?php echo base_url(); ?>/user/registerAuth" method="POST">
						 <?php $validation=validation_list_errors();?>
						<?php if (!empty($validation)) : ?>
							<div class="alert alert-warning">
								<?=  $validation; ?>
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
						<h2 class="title font_lato"><small><?php echo $data['page'];?></small> Create new account!</h2>
                        <p>Please fill details to create account.</p>
						<?php   
						$countries=$data['countries'];
						$nationality=$data['nationality'];
						$income_sources=$data['income_sources'];
						$email=$data['email'];						
						?>
						<span class="formheading">Personal Details</span>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">First name</label>
								  <input type="text" class="form-control" id="name" name="name" placeholder="First name" >
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Surname</label>
								  <input type="text" id="surname" name="surname"  class="form-control"  placeholder="Surname">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Email</label>
								  
								  <input type="email" class="form-control" id="email" name="email"  placeholder="Email" value="<?php echo $email;?>" readonly  >
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Phone</label>
								   <div class="input-group">
								   <select class="form-control" id="phonecode" name="phonecode" style="width: 155px;margin: 0; padding: 0 20px; font-weight: 400; font-size: 16px; color: #dadee3; border: 1px solid #dadee3; border-radius: 5px; height: 37px; box-shadow: none; transition: all .1s ease-in-out;background-color: #fff;">
									<option value="">PhoneCode</option>
									<?php if(!empty($countries)){
										foreach($countries as $country){?>
											<option value="<?php echo $country['phonecode']?>#<?php echo $country['id']?>">+<?php echo $country['phonecode']?></option>
										<?php } } ?>
								  </select>
								  <input type="text" class="form-control" id="phone" name="phone"  placeholder="Phone" style="float:right;width: 65%;" >
								  </div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Password</label>
								  <input type="password" class="form-control" id="password" name="password"  placeholder="Password"  >
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Confirm Password</label>
								  <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"  placeholder="Confirm Password"  >
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Country of Residence</label>
								 <select class="form-control" id="country_of_residence" name="country_of_residence">
									<option value="">Select Country</option>
									<?php if(!empty($countries)){
										foreach($countries as $country){?>
											<option value="<?php echo $country['id']?>"><?php echo $country['country_name']?></option>
										<?php } } ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Date Of Birth</label>
								  <input type="date" class="form-control" id="dob" name="dob"  placeholder="Date Of Birth" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Nationality</label>
								 <select class="form-control" id="nationality" name="nationality">
									<option value="">Select Nationality</option>
									<?php if(!empty($nationality)){
										foreach($nationality as $country){?>
											<option value="<?php echo $country['id']?>"><?php echo $country['country_name']?></option>
										<?php } } ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Gender</label>
								 <select class="form-control" id="gender" name="gender">
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
							
						</div>
					
						<span class="formheading">Other Details</span>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Tax Country</label>
								 <select class="form-control" id="country_pay_tax" name="country_pay_tax">
									<option value="">Select Country</option>
									<?php if(!empty($countries)){
										foreach($countries as $country){?>
											<option value="<?php echo $country['id']?>"><?php echo $country['country_name']?></option>
										<?php } } ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Tax Number </label>
								  <input type="text" class="form-control" id="tax_personal_number" name="tax_personal_number"  placeholder="Tax Number " >
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Work Country</label>
								 <select class="form-control" id="work_country" name="work_country">
									<option value="">Select Country</option>
									<?php if(!empty($countries)){
										foreach($countries as $country){?>
											<option value="<?php echo $country['id']?>"><?php echo $country['country_name']?></option>
										<?php } } ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Income Source</label>
								   <select class="form-control" id="income_soruce" name="income_soruce">
									<option value="">Select Income Source</option>
									<?php if(!empty($income_sources)){
										foreach($income_sources as $key=>$income){?>
											<option value="<?php echo $income?>"><?php echo $income?></option>
										<?php } } ?>
								</select>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Political Person </label>
								  <select class="form-control" id="political_person" name="political_person">
									<option value="No">No</option>
									<option value="Yes">Yes</option>
								  </select>
							</div>
						</div>
						<span class="formheading">Address Details</span>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom01">Country</label>
								 <select class="form-control" id="country_id" name="country_id">
									<option value="">Select Country</option>
									<?php if(!empty($countries)){
										foreach($countries as $country){?>
											<option value="<?php echo $country['id']?>"><?php echo $country['country_name']?></option>
										<?php } } ?>
								</select>
							</div>
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">City</label>
								  <input type="text" class="form-control" id="city" name="city"  placeholder="City" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 mb-3">
								  <label for="validationCustom02">Zipcode</label>
								  <input type="text" class="form-control" id="zipcode" name="zipcode"  placeholder="Zipcode" >
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 mb-3">
								  <label for="validationCustom01">Address</label>
								   <textarea  class="form-control" id="address" name="address"  placeholder="Address" >	</textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="1" id="is_same" name="is_same" checked >
								<label class="form-check-label" for="invalidCheck" style="margin-left: 14px;">
									&nbsp;Is shipping address same
							</label>
							</div>
						</div>
						<button class="btn " type="submit">Sign Up</button>
					</form>
				 </div>
            </div>
        </div>
    </div>
</section>
<?php echo $this->endSection()?>
<?php echo $this->section("scripts")?>
<script>jQuery(document).ready(function () {
	$.validator.addMethod("noSpace", function(value){
		  return value.indexOf(" ") < 0 && value != ""; 
	});
    $('#signupform').validate({
		rules: {
		  name: {
			required: true,  
		  }, 
		  surname: {
			required: true,  
		  }, 
		  email: {
			required: true,  
			noSpace: true,
		  },phone: {
			required: true,  
			
		  },
		  password: {
			required: true,
			noSpace: true,
			
		  },
		  confirmpassword: {
			required: true,
			noSpace: true,
			equalTo: "#password"
			
		  },
		  country_of_residence: {
			required: true,
		  },
		  dob: {
			required: true,
		  },
		  nationality: {
			required: true,
		  },
		  country_pay_tax: {
			required: true,
		  },work_country: {
			required: true,
		  },tax_personal_number: {
			required: true,
		  },
		  income_soruce: {
			required: true,
		  },
		  country_id: {
			required: true,
		  },
		  city: {
			required: true,
		  },
		  zipcode: {
			required: true,
		  },
		  address: {
			required: true,
		  }
		},
		messages: {
		  name: {
			required: "Please enter name",
		  },
		  surname: {
			required: "Please enter surname",
		  },
		  email: {
			required: "Please enter email address",
			noSpace: "No space in email",
		  },
		  phone: {
			required: "Please enter phone",
		  },
		  password: {
			required: "Please enter password",
			noSpace: "No space in password"
		  },
		  confirmpassword: {
			required: "Please enter confirm password",
			noSpace: "No space in confirm password",
			equalTo: "Confirm password doesn't match with password"
			
		  },
		  country_of_residence: {
			required: "Please select country of residence",
		  },
		  dob: {
			required: "Please enter dob",
		  },
		  nationality: {
			required: "Please select nationality",
		  },
		  country_pay_tax: {
			required: "Please select tax country",
		  },tax_personal_number: {
			required: "Please enter personal tax number",
		  },work_country: {
			required: "Please select work country",
		  },
		  income_soruce: {
			required: "Please select income source",
		  },
		  country_id: {
			required: "Please select address country",
		  },
		  city: {
			required: "Please enter city",
		  },
		  zipcode: {
			required: "Please enter zipcode",
		  },
		  address: {
			required: "Please enter address",
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


});</script>  
<?php echo $this->endSection()?>