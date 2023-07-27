<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>
 <div class="profile_content middle_content">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url()?>dashboard">Dashboard</a></li>
                    <li>Profile</li>
                </ul>
            </div>            
            <!-- Title -->              
            <ul class="nav nav-tabs profile_tabs" id="myTab1" role="tablist">
                <li class="nav-item" role="presentation">
                	<button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="true">
                    	<i><img src="<?php echo base_url();?>assets/userpanel/images/personal.svg" alt=""></i>
                        <span>Profile</span>
                    </button>
                </li>       
            </ul>			
            <div class="tab-content" id="myTabContent1">
			 <div class="tab-pane active" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                	<div class="card-body form-content setting-content">
                    	<h3 class="title">Profile Details</h3>
                    	<ul class="setting_list">
                        	<li>
                            	<div class="setting_left">
                                    <span>Name</span>
                                </div>
                                <?php isset($profile['name']) ? $name = $profile['name'] : $name = ''; echo $name;?>
                            </li>
                            <li>
                            	<div class="setting_left">
                                	
                                    <span>SurName</span>
                                </div>
                                <?php isset($profile['surname']) ? $surname = $profile['surname'] : $surname = ''; echo $surname;?>
                            </li>
							<li>
                            	<div class="setting_left">
                                    <span>KYC Status</span>
                                </div>
                                <?php isset($profile['kyc_status']) ? $kyc_status = $profile['kyc_status'] : $kyc_status = ''; echo $kyc_status;?>
                            </li>
							<li>
                            	<div class="setting_left">
                                    <span>Account Status</span>
                                </div>
                                <?php isset($profile['account_status']) ? $account_status = $profile['account_status'] : $account_status = ''; echo $account_status;?>
                            </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
        </div>
<?php echo $this->endSection()?>
