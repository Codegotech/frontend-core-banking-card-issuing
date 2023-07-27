<?php 
echo $this->extend("Views\userlayout"); 
echo $this->section("title");
echo $this->endSection();
if(isset($validation))
{
	print_r($validation->listErrors());
}
isset($wallet['wallet']['iban']) ? $iban = $wallet['wallet']['iban'] : $iban= '';			
echo $this->section("body");

?>
 <style>
  .table_info .type_tag_red {
  padding: 7px 15px;
  margin: 0;
  display: flex;
  font-size: 14px;
  color: #f95e5d;
  font-weight: 600;
  border-radius: 5px;
  background: #fef8de;
  width: 105px;
}
@media (max-width: 1800px)
.bal_block_1 {
	padding: 25px;
}
.bal_block_1 {
	text-align: center;
	padding: 40px;
	margin: 0 0 20px 0;
}
 </style>
        <div class="dashboard">
			<?php if(isset($card) && !empty($card)){ ?>
            <div class="row">
            	<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                	<div class="left_part">
                    	<!-- Breadcrumb -->
                        <div class="breadcrumb_info">
                        	<ul>
                            	<li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                                <li><?php echo $card['wallet'];?> Wallet</li>
                            </ul>
                        </div>                       
                        <!-- Title -->
                        <h2 class="title"><?php echo $card['wallet'];?></h2>
						 <!-- Balance -->
                        <div class="balance">
                			<div class="row">
                            	<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                	<div class="bal_block">
                                    	<h3><?php echo $card['wallet'];?> Balance</h3>
                                        <div class="row">
                                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-7 col-7">
                                                <div class="amt"><?php echo $card['wallet_balance'];?></div>
                                            </div>
                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-5">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php if(isset($card['type_wallet']) && ($card['type_wallet']=='debitcard')){ ?>
									<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4" style="cursor:pointer;">
										<div class="row">										
											<a href="javascript:void" data-bs-target="#move_money_debit_main" data-bs-toggle="modal" data-backdrop="static" data-keyboard="false" >
												<div class="bal_block_1">
													<i><img src="<?php echo base_url();?>assets/userpanel/images/tranjection_icon_1.svg" alt=""></i>
													<h3 style="color:#4FAC68;padding-top:10px;">Transfer To Main Wallet</h3>
												</div>
											</a>		
										</div>
									</div>
								<?php } ?>
                            </div>					
						 </div>
                     </div>
				</div>
			</div>
			<?php }else{ ?>
			<div class="row">
            	<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                	<div class="left_part">
                    	<!-- Breadcrumb -->
                        <div class="breadcrumb_info">
                        	<ul>
                            	<li><a href="<?php echo base_url();?>dashboard">Dashboard</a></li>
                                <li><?php echo $wallet['wallet'];?> Wallet</li>
                            </ul>
                        </div>                       
                        <!-- Title -->
                        <h2 class="title"><?php echo $wallet['wallet'];?></h2>
						 <!-- Balance -->
                        <div class="balance">
                			<div class="row">
                            	<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                	<div class="bal_block">
                                    	<h3><?php echo $wallet['wallet'];?> Balance</h3>
                                        <div class="row">
                                            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-7 col-7">
                                                <div class="amt"><?php echo $wallet['wallet_balance'];?></div>
                                            </div>
                                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-5">
                                             <div class="qr"><span><img src="<?php if($wallet['wallet']=='Main Wallet'){ echo $wallet['qrcode']; }else{echo $wallet['image'];}?>" alt=""></span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php if($wallet['wallet']=='Main Wallet'){ ?>
									<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4" style="cursor:pointer;">
										<div class="row">									
											<a href="javascript:void" onclick="openpop('wt')" >
											<div class="bal_block_1">
												<i><img src="<?php echo base_url();?>assets/userpanel/images/tranjection_icon_1.svg" alt=""></i>
												<h3 style="color:#4FAC68;padding-top:10px;">Wire Transfer</h3>
											</div>
											</a>															
										</div>										
									</div>
									<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4" style="cursor:pointer;">
										<div class="row">										
											<a href="javascript:void" data-bs-target="#move_money" data-bs-toggle="modal" data-backdrop="static" data-keyboard="false" >
												<div class="bal_block_1">
													<i><img src="<?php echo base_url();?>assets/userpanel/images/png-icon-2.png" alt=""></i>
													<h3 style="color:#4FAC68;padding-top:10px;">Transfer To Debit Wallet</h3>
												</div>
											</a>		
										</div>
									</div>
								<?php }	?>
                              </div> 					
							</div>
                        </div>
					</div>
				</div>
			<?php } ?>
			 <div class="row" style="padding:30px 15px 30px 30px;">
            	<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
					<h3 class="title">Recent Transactions</h3>
					<div class="table_info">
						<div class="table-responsive">
							<table class="table caption-top" style="font-size:11px;">
								<thead>
									<tr>
										<th>Transaction ID</th>
										<th class="types text-center" align="center">Type</th>
										<th>Description</th>
										<th>Total Amount</th>
										<th>Fee</th>
										<th>Status</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
										<?php 
										foreach($transactions as $wallets)
										{											
										$iconimg="icon_in";
										$cls="type_tag";
										if($wallets['type'] == 'debit'){
											$iconimg="icon_out";
											$cls="type_tag_red";
										}
										?>
										<tr>
										<td><?php echo $wallets['transaction_id']?></td>
										<td><span class="type_tag <?php echo $cls; ?>" ><img src="<?php echo base_url();?>assets/userpanel/images/<?php echo $iconimg;  ?>.svg" alt="" >  <?php echo $wallets['type']?></span></td>
										<td><?php echo $wallets['description']?></td>
										<td><?php echo $wallets['total']?></td>
										<td><?php echo $wallets['fees']?></td>
										<td><span class="status_tag"><img src="images/tickmark.svg" alt=""><?php echo $wallets['status']?></span></td>
										<td><?php echo date('d M Y H:i',strtotime($wallets['created'])); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		 </div>		
		<?php if(isset($card['type_wallet']) && ($card['type_wallet']=='debitcard')){ ?>
		<div class="modal fade modal_info" id="move_money_debit_main" tabindex="-1" aria-labelledby="move_money_debit_main" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<div class="modal-body">
						<div class="wire_detail sell_detail">												
							<form id="movebalancedebittomain" name="movebalancedebittomain" method="POST" >
								<h3 style="margin:20px 0px;">Move Balance</h3>
								<p>You can move your debit card wallet balance to your main wallet balance.</p>							
								<div class="">
									<div class="form-block">
										<label>Current Debit Wallet Balance: <?php echo $card['wallet_balance']; ?></label>
										<input style="border-color:#4fac68;" class="form-control" placeholder="Enter Amount" type="text" value="" name="amount" id="amount_1" onkeypress="return isNumberKey(event)" >
									</div>							
								</div>                                
								<button class="btn text-uppercase" name="submitBtn" id="submitmoveBtn" onclick="disablebtn('submitmoveBtn')">Transfer</button>
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php 
		} 
		if($wallet['wallet']=='Main Wallet'){ 
		?>	
		<div class="modal fade modal_info tranj_modal" id="onboardingFormModal" tabindex="-1" aria-labelledby="onboardingFormModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<div class="modal-body">
						<div class="wt"  style="display:none;">
							<div class="wire_detail">
								<i class="icon"><img src="<?php echo base_url();?>assets/userpanel/images/wire_icon.svg" alt=""></i>
								<h3>Wire Transfer</h3>
								<p>First of all, enter transfer amount and then submit. After submit you will bank detail and reference id.</p>
								<div class="onboarding-text" id="dep_bank_detail" style="display:none;">
									<p>ReferenceId: <span id="reference" style="font-weight:600;">..</span> <a href="javascript:void()" onclick="copy_functions('reference')"><img src="<?php echo base_url();?>assets/userpanel/images/copy_sm.svg" alt="copy reference code"></a></p>
									
									<p>Account Holder: <span id="account_holder" style="font-weight:600;"></span></p>
									<p>Account: <span id="account" style="font-weight:600;"></span></p>
									<p>Bic Swift: <span id="memo" style="font-weight:600;"></span></p>
								</div>
								
								<form id="deposit" method="post" action="">
									<div class="amt_detail">
										<div class="form-block">
											<label>Select Currency</label>
											<select class="form-control" name="wire_currency" id="wire_currency">
												<option value="">Select Currency</option>
												<?php if(!empty($wire_currencies)){ 
														foreach($wire_currencies as $key=>$wire_country){ ?>
												<?php ?>
												<option value="<?php echo strtoupper($key)?>"><?php echo strtoupper($key)?></option>
												<?php } } ?>
											</select>
										</div>
										<?php if(!empty($wire_currencies)){ 
												foreach($wire_currencies as $key=>$wire_country){ ?>
												<?php ?>
												<div class="form-block countryselect" id="div_<?php echo$key?>" style="display:none;">
											<label>Select Country</label>
											<select class="form-control" name="wire_country" id="wire_country_<?php echo$key?>">
												<option value="">Select Country</option>
												<?php if(!empty($wire_country)){ 
														foreach($wire_country as $country){ ?>
												<?php ?>
												<option value="<?php echo $country?>"><?php echo $country?></option>
												<?php } } ?>
											</select>
										</div>
											<?php } } ?>
										<div class="form-block" id="wire_amount" style="display:none;">
											<label>Enter Amount</label>
											<input id="deposit_amount" class="form-control" placeholder="Enter Amount" name="amount" type="text" value="">
										</div>
									</div>									
									<button class="btn text-uppercase" type="submit">Submit</button>
								</form>
							</div>
						</div>
					
					 </div>
				</div>
			</div>
		</div>		
		<div class="modal fade modal_info" id="move_money" tabindex="-1" aria-labelledby="move_money" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<div class="modal-body">
						<div class="wire_detail sell_detail">												
							<form id="movebalance" name="movebalance" method="POST" >
								<h3 style="margin:20px 0px;">Move Balance</h3>
								<p>You can move your wallet balance to your debit wallet balance.</p>							
								<div class="">
									<div class="form-block">
										<label>Current Balance: <?php echo $wallet['wallet_balance'];?></label>
										<input style="border-color:#4fac68;" class="form-control" placeholder="Enter Amount" type="text" value="" name="amount" id="amount" onkeypress="return isNumberKey(event)" >
									</div>							
								</div>                                
								<button class="btn text-uppercase" name="submitBtn" id="submitmoveBtn" onclick="disablebtn('submitmoveBtn')">Transfer</button>
							</form>	

							<form id="confirmmovebalance" name="confirmmovebalance" method="POST" style="display:none;" >
								<h3 style="margin:20px 0px;">Move Balance</h3>
								<p>Check your email for a confirmation code and enter it. If you enter the wrong code, your account will be suspended..</p>
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
							</form>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	<script>
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : evt.keyCode
		if ((charCode > 34 && charCode < 41) || (charCode > 47 && charCode < 58) || (charCode == 46) || (charCode == 8) || (charCode == 9))
			return true;
		return false;
	}	
	function disablebtn(id)
	{							
		setTimeout(function(){ $('#'+id).prop('disabled', true); },300);
		setTimeout(function(){ $('#'+id).prop('disabled', false); },5000);
	}
	function openpop(arg)
	{
		if(arg=='wt')
		{
			$("#onboardingFormModal").modal('show');
			$(".wtvc_btc").hide();
			if(arg == 'wt')
			{								
				$(".wt").show();
				$(".vc").hide();					
			}else{
				$(".wt").hide();
				$(".vc").show();
			}
		}
	}
	
	$(document).ready(function(){ 
		<?php if(isset($card['type_wallet']) && ($card['type_wallet']=='debitcard')){ ?>
		$('#movebalancedebittomain').validate({
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
				url: "<?php echo base_url() ?>movebalancedebittomain", 
				type: "POST",  
				data: $('#movebalancedebittomain').serialize(),
				cache: false,             
				processData: false,      
				success: function(obj) 
				{	 
					var data = JSON.parse(obj);
					if(data.status == 1)
					{		
						$("#amount_1").val('');							
						swal({
							title: '',
							text: data.message,
							icon: "success",  
							dangerMode: false,
						});	
						setTimeout(function(){ location.reload();  },3000);
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
		<?php } ?>
		<?php if($wallet['wallet']=='Main Wallet'){ ?>	
		$('#movebalance').validate({
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
				url: "<?php echo base_url() ?>movebalancedebit", 
				type: "POST",  
				data: $('#movebalance').serialize(),
				cache: false,             
				processData: false,      
				success: function(obj) 
				{	 
					var data = JSON.parse(obj);
					if(data.status == 1)
					{		
						$("#amount").val('');	
						$("#confirm_code").val('');	
						$("#movebalance").hide();
						$("#confirmmovebalance").show();						
						swal({
							title: '',
							text: data.message,
							icon: "success",  
							dangerMode: false,
						});	
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

		$('#confirmmovebalance').validate({ 
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
				url: "<?php echo base_url() ?>confirmmovebalance", 
				type: "POST",  
				data: $('#confirmmovebalance').serialize(),
				cache: false,             
				processData: false,      
				success: function(obj) 
				{	 
					var data = JSON.parse(obj);
					if(data.status == 2)
					{			
						$("#amount").val('');	
						$("#confirm_code").val('');	
						$("#confirmmovebalance").hide();
						$("#movebalance").show();	
						swal({
							title: '',
							text: data.message,
							icon: "error",  
							dangerMode: false,
						});	
						setTimeout(function(){ location.reload();  },3000);
					}else if(data.status == 1)
					{			
						$("#amount").val('');	
						$("#confirm_code").val('');	
						$("#confirmmovebalance").hide();
						$("#movebalance").show();	
						swal({
							title: '',
							text: data.message,
							icon: "success",  
							dangerMode: false,
						});	
						setTimeout(function(){ location.reload();  },3000);
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
		
		$('#deposit').validate({
		rules: {
		  amount: {
				required: true, 
				number: true
		  },wire_currency: {
				required: true
		  },wire_country: {
				required: true	
		  }
		},
		messages: {
			amount: {
				required: "Please enter amount",					
			},
			wire_currency: {
				required: "Please select currency",					
			},
			wire_country: {
				required: "Please select country",					
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
			var wire_currency=$("#wire_currency").val().toLowerCase();
			var wire_country=$("#wire_country_"+wire_currency).val();
			$.ajax({
				url: "<?php echo base_url() ?>wiredeposit", 
				type: "POST",  
				data: 'amount='+$("#deposit_amount").val()+'&country='+wire_country+'&wire_currency='+$("#wire_currency").val(),
				cache: false,             
				processData: false,      
				success: function(obj) 
				{	       
					var data = JSON.parse(obj);
					if(data.status == 1){
						$("#dep_bank_detail").show();
						$("#deposit").hide();
						$("#reference").text(data.reference); 
						$("#account_holder").text(data.account_holder); 
						$("#account").text(data.account); 
						$("#memo").text(data.memo); 
						//console.log(data);
						setTimeout(function(){ 
							$("#dep_bank_detail").hide();
							$("#deposit").show();
							$('#wire_amount').hide();
							$('.countryselect').hide();
						}, 20000);
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
			return false;
		}
		}); 	
		<?php } ?>	
		$('#wire_currency').on('change', function(){
			var curr=this.value.toLowerCase();
				$('.countryselect').hide();
				$("#div_"+curr).show();
			if(curr!='')
			{
				$('#wire_amount').show();
			}else{
				$('#wire_amount').hide();
			}				
		});
	}); 
	function copy_functions(containerid)
	{	
		if (document.selection) { 
			var range = document.body.createTextRange();
			range.moveToElementText(document.getElementById(containerid));
			range.select().createTextRange();
			document.execCommand("copy"); 
			//$('#'+containerid).html('COPIED');

		} else if (window.getSelection) {
			var range = document.createRange();
			range.selectNode(document.getElementById(containerid));
			window.getSelection().addRange(range);
			document.execCommand("copy");
			//$('#'+containerid).html('COPIED'); 
		}	
	}
</script>
<?php echo $this->endSection()?>