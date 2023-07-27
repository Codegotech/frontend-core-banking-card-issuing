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
                    <li><a href="<?php echo BASE_URL; ?>debitcard">Debit Cards</a></li>
                    <li>Debit Card Portfolio</li>
                </ul>
            </div>            
            <!-- Title -->
            <h2 class="title">Debit Cards<a href="<?php echo BASE_URL; ?>debitcard" class="btn btn-primary btn-block" style="float: right;"><span class="btn-label-icon left fa fa-arrow-left"></span> Back</a></h2>
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
			<div class="wallet_bottom" style="padding:30px 0px 5px;">
			
			<div class="row">
			<div class="portfolio_balance">
                        	<div class="pb_top">
                            	<div class="row align-items-end">
                                	<div class="col-lg-6 col-md-6 col-sm-6">
                                    	<label>Your Portfolio Balance :</label>
                                        <strong>€ <?php if($debitcard['portfolio']>0){echo floatvalue($debitcard['portfolio']); }else{ echo '0.00' ;}; ?></strong>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-sm-end">
                                    	<a href="<?php echo base_url();?>debitcard-settings" class="btn btn-bordered"><i class="fa fa-cog me-2"></i> Settings</a>
                                    	<a href="<?php echo base_url();?>debitcard-sort" class="btn btn-bordered"><i class="fa fa-refresh me-2"></i> Sorting</a>
                                    </div>
                                </div>
                            </div>
                            <div class="pb_bottom">
							<?php 
							if(!empty($debitcard['coin']))
							{
								foreach($debitcard['coin'] as $coin)
								{
								
								isset($coin['balance']) ? $balance = $coin['balance'] : $balance = '€ 0.00';	
								isset($coin['title']) ? $title = $coin['title'] : $title = '';	
								isset($coin['crypto_balance']) ? $crypto_balance = $coin['crypto_balance'] : $crypto_balance = '';	
								isset($coin['currency_name']) ? $currency_name = $coin['currency_name'] : $currency_name = '';	
								isset($coin['image']) ? $image = $coin['image'] : $image = '';										
								?>
                            	<div class="mov">
                                    <i class="icon" style="background:#d0e4ff;"><img src="<?php echo $image?>" alt=""></i>
                                    <div class="details">
                                        <p><?php echo $title?> <small><?php echo $currency_name?></small></p>
                                        <p class="text-end align-self-end"><?php echo $balance?>
										<br>
										<small class="text-end align-self-end"><?php echo $crypto_balance?></small>
										</p>
                                        
                                    </div>
                                </div>
							<?php }} ?>
                            </div>
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
  


