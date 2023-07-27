<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>


        <div class="transition_history middle_content" style="padding-left:17px;">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard">Home</a></li>
                    <li>Giftcards</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">Giftcards</h2>
			 <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
			  <div class="deposit_sec">
				<div class="row">
					<div class="col-xxl-6 col-sm-6">
						<a href="#" title="Send Gift Card" data-bs-toggle="modal" data-bs-target="#GiftCardModal">
						<div class="cate_prz_block">
							<i><img src="<?php echo base_url();?>assets/usertheme/images/deposit_icon_3.svg" alt=""></i>
						<div class="dtl">
							<span>Send Gift Card</span>
						</div>
						</div> 
						</a>
					</div>
				</div>
			 </div>
            <div class="table_info card_tran">
            	<div class="table-responsive">
                	<table class="table caption-top">
                        <thead>
                        	<tr>
                            	<th class="types">Name</th>
                            	<!--th class="types">Email</th-->
                            	<th class="types">Card Number</th>
                            	<th>Total Paid</th>
                            	<th>Loaded Amount</th>
                            	<th>Balance</th>
                                <th>Status</th>
                                <th>Date</th>
                                <!--th>Action</th-->
                            </tr>
                        </thead>
                        <tbody>
							<?php if(!empty($giftcards)){
									foreach($giftcards as $giftcard){
										isset($giftcard['name']) ? $name = $giftcard['name'] : $name= '';
										isset($giftcard['email']) ? $email = $giftcard['email'] : $email= '';
										
										
										?>
								<tr>
								<td><?php echo $name;?></td>
								<!--td><?php echo $email;?></td-->
								<td><?php echo $giftcard['card_number'];?></td>
								<td>€<?php echo $giftcard['total_pay'];?></td>
								<td>€<?php echo $giftcard['loaded_amount'];?></td>
								<td>€<?php echo $giftcard['balance'];?></td>
								<td><?php echo $giftcard['card_status'];?></td>
                            	
                                <td><?php echo $giftcard['created'];?></td>
                                <!--td>
								
								<a href="<?php echo BASE_URL; ?>giftcards/view/<?php echo $giftcard['unique_id'];?>" class="btn btn-danger" >View</a>
								<?php // } ?>
								
								
								<a href="<?php echo BASE_URL; ?>giftcards/block/<?php echo $giftcard['unique_id'];?>" class="btn btn-danger"  onclick="return confirm('Are you sure to block card?')" style="background:#e7788a;">Block Card</a>
								
								</td-->
								</tr>	
							<?php }
							}else{?>
							<tr><td colspan="4">No Records</td></tr>
							<?php } ?>
                        	
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


   <!-- GiftCard Modal -->
            <div class="modal fade modal_info" id="GiftCardModal" tabindex="-1" aria-labelledby="BuyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
                        <div id="create_div">
							<form id="sendgiftcardfrm" method="POST" action="">
                        	<div class="wire_detail sell_detail">
                            	<i class="icon"><img src="<?php echo base_url();?>assets/usertheme/images/tranjection_icon_2.svg" alt=""></i>
                                <h3>Send GiftCard</h3>
                                <div class="amt_detail" id="part1">
									<div class="form-block">
                                    	<label>Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="">
                                    </div>
									<div class="form-block">
                                    	<label>Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="">
                                    </div>
                                	<div class="form-block">
                                    	<label>Enter Amount (€)</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="€0.00">
                                    </div>
									<button type="submit" name="submit" value="submit" class="btn text-uppercase">Send</button>
                                </div>
                                <div class="amt_detail" id="part2" style="display:none;">
									<div class="form-block">
                                    	<label>GiftCard Fee : </label>
										€<span id="issue_virtual_gift_card_fee">0.00</span>
                                    </div>
                                	<div class="form-block">
                                    	<label>Load Card Fee : </label>
											€<span id="loadcard_fee_fixed">0.00</span>
										
                                    </div>
									 <div class="form-block">
											<label>Load Card Fee : </label>
											<span id="loadcard_fee_percentage">0.00</span>%
									 </div>
									 <div class="form-block">
											<label>Total Payable Amount : </label>
											€<span id="total_amount">0.00</span>
									 </div>
									 <button type="submit" name="send" value="send" class="btn text-uppercase">Send</button>
                                </div>
                                
                                
                            </div>
                            </form>
                        </div>
						<div id="confirm_div" style="display:none;">
							<form id="giftcardconfirm_frm" method="POST" action="">
								<div class="wire_detail sell_detail">
									<i class="icon"><img src="<?php echo base_url();?>assets/usertheme/images/tranjection_icon_2.svg" alt=""></i>
									<h3>Confirm GiftCard Request</h3>
									<div class="row">
                                    	<div class="col-sm-12">
                                        	<div class="form-block">
                                                <label>Select </label>
                                                <select name="status" id="status" class="form-control">
													<option value="Completed">Completed</option>
													<option value="Canceled">Canceled</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                        	<div class="form-block">
                                               <label>Confirmation Code</label>
											<input type="text" name="confirm_code" id="confirm_code" class="form-control" placeholder="Access Code">
                                            </div>
                                        </div>
									</div>
                     
									<button type="submit" name="confirm" value="confirm" class="btn text-uppercase">Confirm</button>
								</div>
							</form>
						</div>
                        </div>
                    </div>
                </div>
            </div>		
  <?php echo $this->endSection()?>
    <?php echo $this->section("scripts");?>
<script>
$(document).ready(function () {
	$('#sendgiftcardfrm').validate({
				rules: {
				  name: {
						required: true, 
				  },email: {
						required: true, 
				  },amount: {
						required: true, 
						number: true
				  }
				},
				messages: {
					name: {
						required: "Please enter name",					
					},email: {
						required: "Please enter email",					
					},amount: {
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
					var amount=$("#amount").val();
					var email=$("#email").val();
					var data = $('#sendgiftcardfrm').serialize();
					$.ajax({
						url: "<?php echo base_url() ?>creategiftcard", 
						type: "POST",  
						data: data,
						cache: false,             
						processData: false,      
						success: function(obj) 
						{	       
							var data = JSON.parse(obj);
							if(data.status == 1){
								
								$('#part1').hide();
								$('#part2').show();
								$('#total_amount').text(data.total_amount);
								$('#issue_virtual_gift_card_fee').text(data.issue_virtual_gift_card_fee);
								$('#loadcard_fee_fixed').text(data.loadcard_fee_fixed);
								$('#loadcard_fee_percentage').text(data.loadcard_fee_percentage);
								
							}else if(data.status == 2){	
							//console.log(data);
								$('#create_div').hide();
								$('#confirm_div').show();
								$('#amount').val('');
								$('#email').val('');
								$('#total_amount').text('');
								$('#issue_virtual_gift_card_fee').text('');
								$('#loadcard_fee_fixed').text('');
								$('#loadcard_fee_percentage').text('');
								
							}else{
								$('#part1').show();
								$('#part2').hide();
								$('#amount').val('');
								$('#email').val('');
								$('#total_amount').text('');
								$('#issue_virtual_gift_card_fee').text('');
								$('#loadcard_fee_fixed').text('');
								$('#loadcard_fee_percentage').text('');
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
			  
	$('#giftcardconfirm_frm').validate({
		rules: {
		  confirm_code: {
			required: true,  
		  },status: {
			required: true,  
		  }
		},
		messages: {
			confirm_code: {
				required: "Please enter verification code sent on your email address",
			},
			status: {
				required: "Please select status",
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

			var data = $('#giftcardconfirm_frm').serialize();
			$.ajax({
				url: "<?php echo base_url() ?>confirmgiftcard", 
				type: "POST",  
				data: data,
				cache: false,             
				processData: false,      
				success: function(obj) 
				{	       
					var data = JSON.parse(obj);
					if(data.status == 1){
						$('#confirm_code').text('');
						swal({
							title: '',
							text: data.message,
							icon: "success",  
							dangerMode: false,
						}).then(function(){
							window.location.reload();
						});
					}else{
						$('#confirm_code').text('');
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
  


