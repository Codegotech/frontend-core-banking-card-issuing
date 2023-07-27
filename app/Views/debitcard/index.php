<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>

<?php echo $this->section("body")?>
<style>
.act{
	border: 1px solid #cecece;
	padding: 8px;
	border-radius: 15px;
}
</style>
        <div class="transition_history middle_content" style="padding-left:17px;">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard">Home</a></li>
                    <li>Debit Cards</li>
                </ul>
            </div>            
            <!-- Title -->
            <h2 class="title">Debit Cards
			<a href="<?php echo BASE_URL; ?>debitcard-portfolio" class="btn btn-primary btn-block" style="float: right;"><span class="btn-label-icon left fa fa-arrow-right"></span> Settings</a>
			</h2>
			<?php if (session()->getFlashdata('msg')) : ?>
				<div class="alert alert-warning">
					<?= session()->getFlashdata('msg') ?>
				</div>
			<?php endif; ?>
			<div class="wallet_bottom" style="padding:30px 0px 5px;">
			<div class="row">
				<div class="col-xxl-4 col-sm-4">
					<div class="cate_prz_block">
						<!--i><img src="images/dogecoin-blue.svg" alt=""></i-->
						<div class="dtl">
							<small>DebitCard Balance</small>
							<span>€ <?php if($total_balance>0){echo floatvalue($total_balance); }else{ echo '0.00' ;}; ?>  </span>
						</div>
					</div>
				</div>
			</div>
			<div class="deposit_sec" style="margin-left: 10px;">
				<div class="row">					
					<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-4 act" style="margin-right: 10px;">
						<a href="#" title="Order Debit Card" data-bs-toggle="modal" data-bs-target="#OrderPrepaidCardModal">
						<div class="block">
							<i><img src="<?php echo base_url();?>assets/usertheme/images/deposit_icon_3.svg" alt=""></i>
							<span>Order Debit Card</span>
						</div>
						</a>					
                    </div>					
					<?php if(!empty($card_details)){?>
					<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-4 act">
						<a href="#" title="Send Gift Card" data-bs-toggle="modal" data-bs-target="#ActivatecardModal">
						<div class="block">
							<i><img src="<?php echo base_url();?>assets/usertheme/images/deposit_icon_3.svg" alt=""></i>
							<span>Activate Debit Card</span>
						</div>
						</a>
                    </div>
					<?php } ?>
				</div>
			</div>			
            <div class="table_info card_tran">
            	<div class="table-responsive">
                	<table class="table caption-top">
                        <thead>
                        	<tr>
                            	<th class="types">Card</th>
                            	<th class="types">Card Number</th>
                            	<th>Amount</th>
                                <th>Status</th>                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
						<?php 
							
							if(!empty($card_details))
							{
								foreach($card_details as $card_detail)
								{
								
								isset($card_detail['balance']) ? $balance = $card_detail['balance'] : $balance = '0.00';	
								isset($card_detail['card_status']) ? $card_status = $card_detail['card_status'] : $card_status = 'Not Ordered';	
								isset($card_detail['card_number']) ? $card_number = $card_detail['card_number'] : $card_number = '';	
								isset($card_detail['card_id']) ? $card_id = $card_detail['card_id'] : $card_id = '';										
								?>
								<tr>
								<td>Debit Card</td>
								<td><?php echo $card_number;?></td>
								<td>€<?php echo $balance;?></td>
								<td><?php echo $card_status;?></td>
								
								<td>
								<?php if($card_detail['card_status']=='Verification Progress' || $card_detail['card_status']=='Active Card'){?>
									<?php if($card_detail['card_lock']=='Locked'){ ?>
									<a href="<?php echo BASE_URL; ?>debitcard-unlock-card/<?php echo $card_id?>" class="btn btn-info btn-small" onclick="return confirm('Are you sure to unlock debitcard?')">Un Lock Card</a>
									<?php }else{?>
									<a href="<?php echo BASE_URL; ?>debitcard-lock-card/<?php echo $card_id?>" class="btn btn-info btn-small" onclick="return confirm('Are you sure to lock debitcard?')">Lock Card</a>
									<?php } ?>
									
									<a href="<?php echo BASE_URL; ?>debitcard-reset-pin/<?php echo $card_id?>" class="btn btn-info">Resend Pin</a>
									<a href="<?php echo BASE_URL; ?>debitcard-transactions/<?php echo $card_id?>" class="btn btn-info">Transactions</a>
									
									<?php } ?>
								<?php } ?>
								</td>
								
								</tr>	                        	
							<?php  }else{?>
								<tr><td colspan="4">No Card Ordered</td></tr>
							<?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>		
		<!--OrderPrepaidCardModal -->
		<div class="modal fade modal_info tranj_modal new_card" id="OrderPrepaidCardModal" tabindex="-1" aria-labelledby="OrderPrepaidCardModal" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<div class="modal-body">
						<div class="transfer_data">
							<i><img src="<?php echo base_url();?>assets/usertheme/images/card.svg" alt=""></i>
							<p>Order Debit Card</p>	
							<small>Card cost <?php echo to_decimal($card_order_fee,2); ?> EUR<br>Cost of shipping <?php echo to_decimal($shipping_cost,2); ?> EUR</small>
							<button class="btn text-uppercase" id="confirm_order_btn">Confirm Order</button>
						</div>
					</div>
				</div>
			</div>
		</div>	
			
	  <!-- Activate Card Modal -->
            <div class="modal fade modal_info bitcoin_info Activecard" id="ActivatecardModal" tabindex="-1" aria-labelledby="ActivatecardModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
                        	<div class="wire_detail">
                            	<i class="icon"><img src="<?php echo base_url();?>assets/usertheme/images/card.svg" alt=""></i>
                                <h3>Activate Your Card</h3>
								<small>Card Activation: <?php echo to_decimal($card_activate_fee,2); ?> EUR</small>
								<form id="activate_form" action="">								
                                <div class="amt_detail">
                                	<div class="row">
                                    	<div class="col-sm-12">
                                        	<div class="form-block">
                                                <label>Card Number</label>
                                                <input type="text" name="card_number" id="card_number" class="form-control" placeholder="Enter Card Number">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                        	<div class="form-block">
                                                <label>CVV</label>
                                                <input type="text" name="cvv" id="cvv" class="form-control" placeholder="CVV Code">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-6">
                                        	<div class="form-block">
                                                <label>Expiry</label>
                                                <input type="text" name="expiry_date" id="expiry_date" class="form-control" placeholder="MM/YY">
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <button class="btn text-uppercase">SUBMIT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<!-- Loadcard Modal -->
            <div class="modal fade modal_info" id="LoadcardModal" tabindex="-1" aria-labelledby="BuyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
							<form id="loadcard_frm" method="POST" action="">
							<input type="hidden" name="card_id" id="card_id" class="form-control" value="">
                        	<div class="wire_detail sell_detail">
                            	<i class="icon"><img src="<?php echo base_url();?>assets/usertheme/images/tranjection_icon_2.svg" alt=""></i>
                                <h3>Load Debit Card</h3>
                                <div class="amt_detail" id="part1">
                                	<div class="form-block">
                                    	<label>Enter Amount (€)</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="€0.00">
                                    </div>
									<button type="submit" name="submit" value="submit" class="btn text-uppercase">Load</button>
                                </div>
                                
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>	
  <?php echo $this->endSection()?>
    <?php echo $this->section("scripts");?>
<script>
$(document).ready(function (){
	$.validator.addMethod("datecheck", function(value) {
		return value.match(/^\d{1,2}\/\d{2}$/);
	});
	 $("#confirm_order_btn").click(function(){
		$.ajax({
			url: "<?php echo base_url() ?>debitcard-ordercard", 
			type: "POST",  
			data: "",
			cache: false,             
			processData: false,      
			success: function(obj) 
			{	       
				var data = JSON.parse(obj);
				if(data.status == 1){	
					$('#OrderPrepaidCardModal').modal('hide');
					swal({
					  title: '',
					  text: data.message,
					  icon: "success",  
					  dangerMode: false,
					}).then(function(){
						  window.location.reload();
					  });
				}else{
					swal({
					  title: '',
					  text: data.message,
					  icon: "error",  
					  dangerMode: false,
					}).then(function(){
					  window.location.reload();
				  });		
				}
			}
		});	
    }); 
	$('#activate_form').validate({
	rules: {
	  card_number: {
			required: true, 
	  },cvv: {
			required: true, 
	  },expiry_date: {
			required: true, 
			datecheck: true, 
	  }
	},
	messages: {
		card_number: {
			required: "Please enter card number",					
		},cvv: {
			required: "Please enter cvv number",					
		},expiry_date: {
			required: "Please mention expiry date",					
			datecheck: "Please mention expiry month and year MM/YY",					
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
		
		var data = $('#activate_form').serialize();
		$.ajax({
			url: "<?php echo base_url() ?>debitcard-activatecard", 
			type: "POST",  
			data: data,
			cache: false,             
			processData: false,      
			success: function(obj) 
			{	       
				var data = JSON.parse(obj);
				if(data.status == 1){
					$('#card_number').val('');
					$('#cvv').val('');
					$('#expiry_date').val('');
					$('#ActivatecardModal').modal('hide');

					swal({
					  title: '',
					  text: data.message,
					  icon: "success",  
					  dangerMode: false,
					}).then(function(){
						  window.location.reload();
					  });
				}else{
					$('#card_number').val('');
					$('#cvv').val('');
					$('#expiry_date').val('');
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
  
  $('#loadcard_frm').validate({
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
		
		var data = $('#loadcard_frm').serialize();
		$.ajax({
			url: "<?php echo base_url() ?>debitcard-loadcard", 
			type: "POST",  
			data: data,
			cache: false,             
			processData: false,      
			success: function(obj) 
			{	       
				var data = JSON.parse(obj);
				if(data.status == 1){
					$('#card_number').val('');
					$('#cvv').val('');
					$('#expiry_date').val('');
					$('#ActivatecardModal').modal('hide');

					swal({
					  title: '',
					  text: data.message,
					  icon: "success",  
					  dangerMode: false,
					}).then(function(){
						  window.location.reload();
					  });
				}else{
					$('#card_number').val('');
					$('#cvv').val('');
					$('#expiry_date').val('');
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
});
</script>
  <?php echo $this->endSection()?>
  


