<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>

<style>
.table_info .type_tag {
  padding: 7px 15px;
  margin: 0;
  display: flex;
  font-size: 14px;
  color: #4fac68;
  font-weight: 600;
  border-radius: 5px;
  background:#fff;
  width: 205px;
}
</style>
        <div class="transition_history middle_content" style="padding-left:17px;">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard">Home</a></li>
                    <li>Beneficiary List</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">Beneficiary List</h2>
			<?php if (session()->getFlashdata('error')) : ?>
				<div class="alert alert-warning">
				<?= session()->getFlashdata('error') ?>
				</div>
			<?php endif; ?>
			<?php if (session()->getFlashdata('success')) : ?>
				<div class="alert alert-success">
				<?= session()->getFlashdata('success') ?>
				</div>
			<?php endif; ?>	
			  <div class="deposit_sec">
				<div class="row">
					<div class="col-xxl-5 col-sm-5">
						<a href="#" title="Add New Beneficiary" data-bs-toggle="modal" data-bs-target="#AddBeneficiaryModal">
						<div class="cate_prz_block">
							<i><img src="<?php echo base_url();?>assets/usertheme/images/deposit_icon_3.svg" alt=""></i>
						<div class="dtl">
							<span>Add New Beneficiary</span>
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
                            	<th class="types" width="50%">Name</th>
                                <th  width="50%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php if(!empty($beneficiaries)){
									foreach($beneficiaries as $beneficiary){
										isset($beneficiary['name']) ? $name = $beneficiary['name'] : $name= '';
										isset($beneficiary['image']) ? $image = $beneficiary['image'] : $image= '';
										
										?>
								<tr>
								<td><span class="type_tag"><img src="<?php echo $image;?>" alt="" style="width:30px;"> <?php echo ucwords($name);?></span></td>
								
								
                                <td>
								
								<a onclick="setModal('<?php echo $beneficiary['unique_id']?>','<?php echo ucwords($name);?>')" data-bs-toggle="modal" data-bs-target="#SendMoneyModal" class="btn btn-danger" >Send Money</a>
								
								<a href="<?php echo BASE_URL; ?>delete-beneficiary/<?php echo $beneficiary['unique_id'];?>" class="btn btn-danger"  onclick="return confirm('Are you sure to delete beneficiary?')" style="background:#e7788a;">Delete</a>
								
								</td>
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


   <!-- AddBeneficiaryModal Modal -->
            <div class="modal fade modal_info" id="AddBeneficiaryModal" tabindex="-1" aria-labelledby="AddBeneficiaryModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
							<form id="addbeneficiaryfrm" method="POST" action="">
                        	<div class="wire_detail sell_detail">
                            	<i class="icon"><img src="<?php echo base_url();?>assets/usertheme/images/tranjection_icon_2.svg" alt=""></i>
                                <h3>Add New Beneficiary</h3>
                                <div class="amt_detail">
									<div class="form-block">
                                    	<label>Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="">
                                    </div>
                               
									<button type="submit" name="submit" value="submit" class="btn text-uppercase">Create</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>		
			
<!-- SendMoneyModal Modal -->
            <div class="modal fade modal_info" id="SendMoneyModal" tabindex="-1" aria-labelledby="BuyModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="modal-body">
							<form id="sendmoney_frm" method="POST" action="">
							
							<input type="hidden" name="beneficiary_id" id="beneficiary_id" class="form-control" value="">
							
                        	<div class="wire_detail sell_detail">
                            	<i class="icon"><img src="<?php echo base_url();?>assets/usertheme/images/tranjection_icon_2.svg" alt=""></i>
                                <h3>Send Money to <span id="ben"></span></h3>
                                <div class="amt_detail" id="part1">
                                	<div class="form-block">
                                    	<label>Enter Amount (€)</label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="€0.00">
                                    </div>
									<button type="submit" name="submit" value="submit" class="btn text-uppercase">Send</button>
                                </div>
                                <div class="amt_detail" id="part2" style="display:none;">
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
											<input type="text" name="confirm_code" id="confirm_code" class="form-control" placeholder="Confirmation Code">
                                            </div>
                                        </div>
									</div>
                     
									<button type="submit" name="confirm" value="confirm" class="btn text-uppercase">Confirm</button>
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

function setModal(beneficiary_id,ben_name)
{
	
	$('#beneficiary_id').val(beneficiary_id);
	$('#ben').html(ben_name);
}
$(document).ready(function () {
	$('#addbeneficiaryfrm').validate({
				rules: {
				 email: {
						email: email, 
						required: true, 
				  }
				},
				messages: {
					email: {
						required: "Please enter email",					
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
					var email=$("#email").val();
					var data = $('#addbeneficiaryfrm').serialize();
					$.ajax({
						url: "<?php echo base_url() ?>add-beneficiary", 
						type: "POST",  
						data: data,
						cache: false,             
						processData: false,      
						success: function(obj) 
						{	       
							var data = JSON.parse(obj);
							if(data.status == 1){	
							//console.log(data);
								$('#email').val('');
								$('#AddBeneficiaryModal').modal('hide');
								swal({
								  title: '',
								  text: data.message,
								  icon: "success",  
								  dangerMode: false,
								}).then(function(){
                                      window.location.reload();
                                  });
							}else{								
								$('#email').val('');
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
			  
			  
			  $('#sendmoney_frm').validate({
				rules: {
				  amount: {
						required: true, 
				  }, confirm_code: {
						required: true, 
				  }
				},
				messages: {
					amount: {
						required: "Please enter amount",					
					},
					confirm_code: {
						required: "Please enter confirm code",					
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
					
					var data = $('#sendmoney_frm').serialize();
					$.ajax({
						url: "<?php echo base_url() ?>beneficiaries-sendmoney", 
						type: "POST",  
						data: data,
						cache: false,             
						processData: false,      
						success: function(obj) 
						{	       
							var data = JSON.parse(obj);
							if(data.status == 1){
								
								swal({
								  title: '',
								  text: data.message,
								  icon: "success",  
								  dangerMode: false,
								}).then(function(){
                                      window.location.reload();
                                  });
							}else if(data.status == 2){
								swal({
								  title: '',
								  text: data.message,
								  icon: "success",  
								  dangerMode: false,
								}).then(function(){
                                     
                                  });
								$('#part1').hide();
								$('#part2').show();
								
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

	

});
</script>
  <?php echo $this->endSection()?>
  


