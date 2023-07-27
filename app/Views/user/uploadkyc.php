<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>

<?php

   if(isset($validation)){

     print_r($validation->listErrors());
   }

?>

<?php echo $this->section("body")?>
<style>	
	fieldSet
    {
		border: 1px solid lightgray;
        width: 97%; 
        margin-left: 10px;
        border:0;
        margin:0;
    }
    legend
    {

        border-style:none;
        background-color: #4fac68;
        font-family: Tahoma, Arial, Helvetica;
        font-weight: bold;
        font-size: 9.5pt;
        Color: White;
        width:40%;
        padding-left:10px;

    }
</style>
  <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="profile_content">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url()?>business/dashboard">Home</a></li>
                    <li>KYC Documents</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">KYC Documents  <?php //echo $name; ?></h2>
            
            <ul class="nav nav-tabs profile_tabs" id="myTab1" role="tablist">
                <li class="nav-item" role="presentation">
                	<button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">
                    	<i><img src="<?php echo base_url();?>assets/userpanel/images/personal.svg" alt=""></i>
                        <span>KYC Documents</span>
                    </button>
                </li>
       
            </ul>
			  <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('msg') ?>
                    </div>
                <?php endif; ?>
            <div class="tab-content" id="myTabContent1">
                <div class="tab-pane fade show active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                	<div class="responsive-tabs">
                        <!--ul class="nav nav-tabs verticale_tabs" role="tablist2">
                            <li class="nav-item">
                                <a id="tab-A" href="#pane-A" class="nav-link active" data-bs-toggle="tab" role="tab">
                                	<i><img src="<?php echo base_url();?>assets/userpanel/images/menu_icon3.svg" alt=""></i>
                                	<span>Documents To Upload</span>
                                </a>
                            </li>
                        </ul-->
                        <div id="content" class="tab-content form-content" role="tablist2">
                            <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                                <div class="card-header" role="tab" id="heading-A">
                                    <h5 class="mb-0">
                                        <a data-bs-toggle="collapse" href="#collapse-A" aria-expanded="true" aria-controls="collapse-A">
                                            <i><img src="<?php echo base_url();?>assets/userpanel/images/personal_green.svg" alt=""></i> <span></span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-A" class="collapse show" data-bs-parent="#content" role="tabpanel" aria-labelledby="heading-A">
                                    <div class="card-body">
										<form id="kycform"  class="form_info" method="POST" action="" enctype="multipart/form-data">
                                    	
										<div class="row">
										<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
											<div class="input_block">
												<label>Document</label>
												<select class="form-control" id="document_id" name="document_id">
												<option value="">Select Document</option>
												<?php if(!empty($documents)){
												foreach($documents as $document){
														if(!array_key_exists($document['name'],$kyc_array)){
													?>
													<option value="<?php echo $document['id']?>"><?php echo $document['name']?></option>
														<?php } } } ?>  
												</select>
											</div>
										</div>
										<div id="div_id_proof" style="display:none;">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="input_block">
													<label>Document Type</label>
													<select class="form-control" id="document_type" name="document_type">
														<option value="passport">Passport</option>
														<option value="idproof">ID Proof</option>
													</select>
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="input_block">
													<label id="document_number_label">Passport Number</label>
													<input type="text" class="form-control" placeholder="Passport Number" name="document_number" id="document_number">
												</div>
											</div>
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="input_block">
													<label>Upload Proof(Front)</label>
													<input type="file" class="form-control" name="front_proof" id="front_proof" >
												</div>
											</div>
											<div id="back_div" style="display:none;">
												<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
													<div class="input_block">
														<label>Upload Proof(Back) </label>
														<input type="file" class="form-control" name="back_proof" id="back_proof" >
													</div>
												</div>
											</div>
										</div>
										<div id="div_address_proof" style="display:none;">
											<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="input_block">
													<label>Upload a Address Proof</label>
													<input type="file" class="form-control" name="address_proof" id="address_proof" >
												</div>
											</div>
										</div>
                                            <div class="col-12">
                                            	<button class="btn form-btn">Save</button>
                                            </div>
                                        </div>
                                         </form>
                                    </div>
                                </div>
                            </div>
                            
                           
                        </div>
                    </div>
                </div>
               
                </div>
            </div>

        </div>
    </div>
  <!-- /.content-wrapper -->
  <?php echo $this->endSection()?>
    <?php echo $this->section("scripts");?>
<script>
$(document).ready(function () {
	$('#document_id').on('change', function() {
		if(this.value==1)
		{
			$('#div_id_proof').show();
			$('#div_address_proof').hide();
		}else{
			$('#div_id_proof').hide();
			$('#div_address_proof').show();
		}
	});
	$('#document_type').on('change', function() {
		if(this.value=='passport')
		{
			$('#document_number_label').text('Passport Number');
			$('#document_number').attr("placeholder", "Passport Number");
			$('#back_div').hide();
		}else{
			$('#document_number_label').text('Document Number');
			$('#document_number').attr("placeholder", "Document Number");
			$('#back_div').show();
		}
	});
	$('#kycform').validate({
		rules: {
		  document_id: {
			required: true,  
		  },document_number: {
			required: true,  
		  },front_proof: {
			required: true,  
		  },back_proof: {
			required: true,  
		  },address_proof: {
			required: true,  
		  }
		},
		messages: {
			document_id: {
				required: "Please select document type",
			},document_number: {
				required: "Please enter document_number",
			},
			front_proof: {
				required: "Please upload ID proof front",
			},back_proof: {
				required: "Please upload ID proof back",
			},
			address_proof: {
				required: "Please upload address proof",
			}
		}
	});

	

});
</script>
  <?php echo $this->endSection()?>
  


