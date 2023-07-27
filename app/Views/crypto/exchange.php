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
</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">	
<div class="content-wrapper">
	<?php 	

	if($page == 'No-Access-Trade')
	{
	?>
		<div class="wire_detail sell_detail Preview_info">
			<h3 class="onboarding-title" style="font-size: 20px;">
				Sorry, Not enable trading <b><?php echo $coin; ?></b> right now.<br> If you need more help please contact to admin support
			</h3>
		</div>
	<?php 	
	}else if($page == 'not-found')
	{
	?>
		<div class="wire_detail sell_detail Preview_info">
			<h3 class="onboarding-title" style="font-size: 20px;">
				<?php echo $message; ?>
			</h3>
		</div>	
	<?php 	
	}else if($page == 'confirm-exchange')
	{
	?>	
	<div class="wire_detail">			
		<h3>Confirm Convert <?php echo strtoupper($coinlist['cryptobalance']['symbol']);  ?></h3>
		<div class="tab-content">			
			<div class="tab-pane tb active">
				<form id="confirm_exchange" name="confirm_exchange" method="POST" action="<?php echo base_url().'crypto/confirm_exchange/'.$coin; ?>" >
				<div class="amt_detail">
					<p>Check your email for a confirmation code and enter it. If you enter the wrong code, your account will be suspended.</p>
					<div class="">
						<div class="form-block">										
							<input style="border-color:#4fac68;" class="form-control" placeholder="Enter confirmation code" type="text" value="" name="confirm_code" id="confirm_code" >
						</div>	
						<div class="form-block">										
							<select name="status" class="form-control" style="border-color:#4fac68;" >
								<option value="Completed">Approved</option>
								<option value="Canceled">Canceled</option>
							</select>
						</div>
					</div>                                
					<button class="btn text-uppercase" name="submitBtn" id="submitmoveBtns" onclick="disablebtn('submitmoveBtns')">Confirm</button>					
				</div>
				</form>
			</div>
		</div>		
	</div>
	<script>
	function disablebtn(id)
	{							
		setTimeout(function(){ $('#'+id).prop('disabled', true); },300);
		setTimeout(function(){ $('#'+id).prop('disabled', false); },5000);
	}
	$(document).ready(function(){			
		$('#confirm_exchange').validate({ 
			rules: {
				confirm_code: {
					required: true,  
				}
			},	
			messages: {
				confirm_code: {
					required: "Please enter confirm code",
				}
			},
			invalidHandler: function(form, validator) {
			  if (!validator.numberOfInvalids())
			  {
				return;
			  }
			  else
			  {
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
				// call ajax
				 $.ajax({
					url: "<?php echo base_url() ?>crypto/confirm_exchange/", 
					type: "POST",  
					data: $('#confirm_exchange').serialize(),
					cache: false,             
					processData: false,      
					success: function(obj) 
					{	 
						var data = JSON.parse(obj);
						if(data.status == 2)
						{
							
							$("#amount").val('');	
							$("#confirm_code").val('');	
							$("#confirm_withdraw_euro").hide();
							$("#withdraw_euro").show();	
							
							swal({
								title: '',
								text: data.message,
								icon: "error",  
								dangerMode: false,
							});	
							setTimeout(function(){ 
								window.location.href="<?php echo base_url().'crypto/exchange/'.$coin; ?>";	
							},3000);
						}else if(data.status == 1)
						{			
							$("#amount").val('');	
							$("#confirm_code").val('');	
							$("#confirm_withdraw_euro").hide();
							$("#withdraw_euro").show();	
							swal({
								title: '',
								text: data.message,
								icon: "success",  
								dangerMode: false,
							});	
							setTimeout(function(){ 
								window.location.href="<?php echo base_url().'crypto/exchange/'.$coin; ?>";					
							},3000);
						}else{
							swal({
								title: '',
								text: data.message,
								icon: "error",  
								dangerMode: false,
							});		
						}
					}
				});	
			}
		});				
	});
	</script>
	<?php
	}else if($page == 'exchange')
	{
	?>	
	<style>
	.error {color: red; text-align: center;	width: 100%; }
	input { font-size: 40px; }
	.mybox { color:#938e8e; background-color: transparent !important;	border-color: transparent !important;	outline: transparent !important;	max-width: 318px;	width: 100%;	text-align:center;}
	.btn-primary{ width: 100%;padding: 14px;color: #fff;font-size: 17px ;font-weight: 500; }
	.tb .active{ display:block; }
	.uptext{  text-transform: uppercase; margin: 11px 0px 24px; }
	.swap{  margin-bottom: 10px; }
	.form-control {border: 1px solid #f5f5f5;}
	.conv_info {padding: 17px;}
	.uptext span{ font-weight:600; }
	.conv_info .price i {background-color: #fff;}
	.form-select{ width:100px; float:right ; }
	</style>
		<div class="wire_detail sell_detail">			
			<h3>Convert <?php echo strtoupper($coinlist['cryptobalance']['symbol']);  ?></h3>
			<div class="tab-content">
				<div class="tab-pane tb active" id="tab_sell">
					<div class="amt_detail">
						<form id="sell_exchange" name="sell_exchange" method="POST" action="<?php echo base_url().'crypto/exchange_post/'.$coin; ?>">
							<div class="form">							 
								<input type="text" onkeypress="return isNumberKey(event)" class="mybox" placeholder="Amount <?php echo ($coinlist['cryptobalance']['symbol']); ?>" id="sell_amount" name="amount" >		
								<input type="hidden" class="from_symbol_bal" id="fsb">	
								<div class="row-fluid">
									<div class="selectdiv span12 text-center uptext">
										<span id="click_fsb"  style="margin: 0px; font-size:12px">use max</span> 
									</div>
								</div> 
								
								<div class="form-control conv_info">
									<div class="row">
										<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
											<div class="price">
												<i><img src="<?php echo $coinlist['image']; ?>" alt=""></i>
											</div>
										</div>
										<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">
											<select class="form-select" name="from_symbol" id="from_symbol_1" style="border:0px;">
												 <option value="<?php echo $coinlist['cryptobalance']['symbol']; ?>" ><?php echo strtoupper($coinlist['cryptobalance']['symbol']); ?> </option>
											</select>
										</div>
									</div>
								</div>
								<div class="swap"><a href="javascript:void"  onclick="changetb(1)"><img src="<?php echo base_url(); ?>assets/userpanel/images/swap.svg" alt=""></a></div>											
								<div class="form-control conv_info">							
									<div class="row">
										<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
											<div class="price">
												<i><img src="" id="up_image" alt=""></i>
											</div>
										</div>
										<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">
											<select class="form-select" name="to_symbol" id="to_symbol_1" style="border:0px;">								  
												<?php 								
												if(!empty($coinlist['from_coin']))
												{ 
													foreach($coinlist['from_coin'] as $from_coin)
													{ 
												?>
													<option value="<?php echo $from_coin['to_symbol']; ?>"  ><?php echo strtoupper($from_coin['to_symbol']); ?> </option>
												<?php } } ?>
											</select>
										</div>
									</div>
								</div>	
								
								<div class="form-group" style="margin-top:20px;">
									<button type="submit" class="btn text-uppercase">Convert</button>
								</div>
							</div>	
						</form>							
					</div>
				</div>
				<div class="tab-pane tb" id="tab_buy">
					<div class="amt_detail">
						<form id="buy_exchange" name="buy_exchange" method="POST" action="<?php echo base_url().'crypto/exchange_post/'.$coin; ?>">
						  <div class="form">							 
							<input type="text" class="mybox" onkeypress="return isNumberKey(event)" placeholder="Amount" id="buy_amount" name="amount">
							<input type="hidden" id="to_symbol_bal_2">	
							<div class="row-fluid">
								<div class="selectdiv span12 text-center uptext">
									<span id="click_to_symbol"  style="margin:0px; font-size:12px">use max</span> 
								</div>
							</div>	
							
							<div class="form-control conv_info">							
								<div class="row">
									<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">
										<div class="price">
											<i><img src="" id="low_image" alt=""></i>
										</div>
									</div>
									<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
										<select class="form-select" name="from_symbol" id="from_symbol_2" style="border:0px;">								  
											<?php 								
											if(!empty($coinlist['from_coin']))
											{ 
												foreach($coinlist['from_coin'] as $from_coin)
												{ 
											?>
												<option value="<?php echo $from_coin['to_symbol']; ?>"  ><?php echo strtoupper($from_coin['to_symbol']); ?> </option>
											<?php } } ?>
										</select>
									</div>
								</div>
							</div>	
							<div class="swap"><a href="javascript:void"  onclick="changetb(2)"><img src="<?php echo base_url(); ?>assets/userpanel/images/swap.svg" alt=""></a></div>						
							
							<div class="form-control conv_info">
								<div class="row">
									<div class="col-xxl-7 col-xl-7 col-lg-7 col-md-7 col-sm-7 col-7">
										<div class="price">
											<i><img src="<?php echo $coinlist['image']; ?>" alt=""></i>
										</div>
									</div>
									<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-5 col-5">
										<select class="form-select" name="to_symbol" id="to_symbol_2" style="border:0px;" readonly>
											<option value="<?php echo $coinlist['cryptobalance']['symbol']; ?>" ><?php echo strtoupper($coinlist['cryptobalance']['symbol']); ?> </option>
										</select>
									</div>
								</div>						  
							</div>											
							<div class="form-group" style="margin-top:20px;">
								<button type="submit" class="btn text-uppercase">Convert</button>
							</div>
						</div>	
						</form>							
					</div>
				</div>
			</div>		
		</div>
		<script>
		var cb =  <?php echo json_encode($coinlist['from_coin']); ?>;	
		var mini_amt = <?php echo $coinlist['cryptobalance']['mini_amt']; ?>;
		//console.log(cb);	
		$(document).ready( function(){
			var ts1 = $("#to_symbol_1").val();	
			var balance_1 = cb[ts1]['balance']; 		
			$("#to_symbol_bal_1").text(balance_1+' '+ts1);	
			$(".from_symbol_bal").text("<?php echo $coinlist['cryptobalance']['balance'].' '.$coinlist['cryptobalance']['symbol']; ?>");
			var image_1 = cb[ts1]['image']; 
			$('#up_image').attr('src',image_1);
			
			var fs2 = $("#from_symbol_2").val();
			var balance_2 = cb[fs2]['balance']; 	
			$("#to_symbol_bal_2").text(balance_2+' '+fs2);	
			$('#buy_amount').attr('placeholder', 'Amount '+fs2);
			
			var image_2 = cb[fs2]['image']; 
			$('#low_image').attr('src',image_2);
			
			$( "#to_symbol_1" ).change(function() {
				var ts1 = $("#to_symbol_1").val();		
				var balance_1 = cb[ts1]['balance']; 
				$("#to_symbol_bal_1").text(balance_1+' '+ts1);	
				var image_1 = cb[ts1]['image']; 
				$('#up_image').attr('src',image_1);
			});
			
			$( "#from_symbol_2" ).change(function() {
				
				var fs2 = $("#from_symbol_2").val();		
				var balance_2 = cb[fs2]['balance']; 
				$("#to_symbol_bal_2").text(balance_2+' '+fs2);	
				$('#buy_amount').attr('placeholder', 'Amount '+fs2);
				
				var image_2 = cb[fs2]['image']; 
				$('#low_image').attr('src',image_2);
			});		
			
			$("#click_fsb").click(function() {
				var fsb = $("#fsb").text();
				var bal = fsb.split(' ');
				$("#sell_amount").val(bal[0]);
			});
			$("#click_to_symbol").click(function() {
				var fsb = $("#to_symbol_bal_2").text();
				var bal = fsb.split(' ');
				$("#buy_amount").val(bal[0]);
			});
			
			$('#sell_exchange').validate({
				rules: {
					amount: {
						required: true,  
					}
				},
				messages: {
					amount: {
						required: "Please enter amount",
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
					const sell_amount = $("#amount").val();
					if(sell_amount < mini_amt)
					{	
						swal({
						  title: '',
						  text: "Minimum trade amount is "+ mini_amt,
						  icon: "error",  
						  dangerMode: false,
						});					
					}else{
						return true;				
					}
				}
			  });  
			  $('#buy_exchange').validate({
				rules: {
				  amount: {
						required: true,  
						noSpace: true,
				  }
				},
				messages: {
				  amount: {
						required: "Please enter amount",
						noSpace: "No space in amount",
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
					const buy_amount = $("#amount").val();
					if(buy_amount < mini_amt)
					{	
						swal({
						  title: '',
						  text: "Minimum trade amount is "+ mini_amt,
						  icon: "error",  
						  dangerMode: false,
						});					
					}else{
						return true;				
					}
				}
			  }); 
			
			var success_close_poup =  "<?= session()->getFlashdata('success_close_poup') ?>";
			var success =  "<?= session()->getFlashdata('success') ?>";
			var error =  "<?= session()->getFlashdata('error') ?>";
			if(success!=""){		
				swal({
				  title: '',
				  text: success,
				  icon: "success",  
				  dangerMode: false,
				});	
			}
			if(error!=""){
				swal({
				  title: '',
				  text: error,
				  icon: "error",  
				  dangerMode: false,
				});
			}
			if(success_close_poup == 1)
			{
				setTimeout(parent.window.closepop(), 5000);	
			}
		});
		
		function changetb(arg)
		{
			$("#sell_amount").val('');
			$("#buy_amount").val('');
			if(arg == 1)
			{
				$("#tab_buy").show();	
				$("#tab_sell").hide();	
			}else{
				$("#tab_sell").show();	
				$("#tab_buy").hide();	
			}
		}
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode
			if ((charCode > 34 && charCode < 41) || (charCode > 47 && charCode < 58) || (charCode == 46) || (charCode == 8) || (charCode == 9))
				return true;
			return false;
		}
	</script>

	<?php
	}else{ 
	$this->session = session();
	$exchange_crypto = $this->session->get('exchange_crypto');	
	
	$type = $exchange_crypto['type'];
	$endtime = $exchange_crypto['time'];
	$starttime =  time();
	$diff = $endtime - $starttime;
	if($diff < 0)
	{
		$diff = 1;
	}
	?>
	<style>
		.Preview_info h5 {
		  margin: 0 0 15px 0;
		  padding: 0;
		  font-size: 16px;
		  color: #494940;
		  font-weight: 600;
		}
		.pre_table {
		  margin: 0;
		  padding: 0;
		  width: 100%;
		}
		.pre_table th {
		  margin: 0;
		  padding: 10px 0;
		  font-size: 14px;
		  color: #484845;
		  font-weight: 500;
		}
		.pre_table td {
		  margin: 0;
		  padding: 10px 0;
		  font-size: 14px;
		  color: #484845;
		  text-align: right;
		}
	</style>
	<div class="wire_detail sell_detail Preview_info">
		<h3>Preview Convert Order </h3>
		<div class="amt_detail pb-3">
			
			<div class="row">
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
					<h5>Convert Order</h5>
				</div>
				
				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 text-end">
					<span>
					<?php 
					$type = 'sell';
					if($type == 'buy')
					{
						echo $exchange_crypto['received_amount'].' '.strtoupper($exchange_crypto['from_symbol']);
					}else{
						echo $exchange_crypto['amount'].' '.strtoupper($exchange_crypto['from_symbol']);
					}
					
					?>
					</span>
				</div>
			</div>
			
			<div class="table_info">
				<table class="pre_table">	
					<tr>
						<th>Market</th>
						<td> <?php echo strtoupper($exchange_crypto['market']); ?></td>
					</tr>
					<?php 
					if($type == 'buy')
					{
					?>
					<tr>
						<th>1 <?php echo strtoupper($exchange_crypto['from_symbol']); ?> Price</th>
						<td> <?php echo number_format($exchange_crypto['price'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>
					<tr>
						<th>You Pay</td><th><?php echo number_format($exchange_crypto['crypto_amount'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>
					<tr>
						<th>Conversion Fee</th><td><?php echo number_format($exchange_crypto['fee'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>					
					<tr>
						<th><b>You Will Get <?php echo strtoupper($exchange_crypto['from_symbol']); ?></b> </th><td><?php echo number_format($exchange_crypto['received_amount'],8).' '.strtoupper($exchange_crypto['from_symbol']); ?></td>
					</tr>
					<?php }else{ ?>
					<tr>
						<th>1 <?php echo strtoupper($exchange_crypto['from_symbol']); ?> Price</th>
						<td> <?php echo number_format($exchange_crypto['price'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>
					<tr>
						<th>You Pay</th><td><?php echo number_format($exchange_crypto['amount'],8).' '.strtoupper($exchange_crypto['from_symbol']); ?></td>
					</tr>
					
					<tr>
						<th>Convert </th><td><?php echo number_format($exchange_crypto['crypto_amount'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>
					<tr>
						<th>Conversion Fee</th><td><?php echo number_format($exchange_crypto['fee'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>
					<tr>
						<th><b>You Will Get  <?php echo strtoupper($exchange_crypto['to_symbol']); ?></b> </th><td><?php echo number_format($exchange_crypto['received_amount'],8).' '.strtoupper($exchange_crypto['to_symbol']); ?></td>
					</tr>
					<?php }	?>	
				</table>
				<div style="text-align:center;">
					<progress value="0" max="<?php echo $diff; ?>" id="progressBar"></progress>
				</div>
				<div class="row">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">						
						<a href="#null" onclick="return confirm('cancel')" class="btn btn-bordered text-uppercase subbtn" data-dismiss="modal">Cancel</a>
					</div>
					
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
						<a href="#null"  onclick="return confirm('submit')" class="btn text-uppercase subbtn">Submit</a>
					</div>
				</div>					
			</div>			
		</div>			
	</div>
	
    <script>    
		function confirm(arg)
		{
			$('.subbtn').hide();
			if(arg == 'cancel')
			{
				 window.location.href="<?php echo base_url().'crypto/cancel_exchnage'; ?>";
			}else if(arg == 'submit')
			{
				 window.location.href="<?php echo base_url().'crypto/submit_exchange'; ?>";
			}			
			return true;
		}
		
		$(document).ready(function () 
		{
			var timeleft = <?php echo $diff; ?>;
			var downloadTimer = setInterval(function(){
			  if(timeleft <= 0){
				clearInterval(downloadTimer);
			  }
			  var t = <?php echo $diff; ?> - timeleft;
			  if(t >= <?php echo $diff; ?>)
			  {
				  window.location.href="<?php echo base_url().'crypto/cancel_exchnage'; ?>";
			  }
			  document.getElementById("progressBar").value = t;
			  timeleft -= 1;
			}, 1000);			 
		});  
	</script>    
	<?php } ?>
	</div>	
</body>
</html>
