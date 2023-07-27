<?php echo $this->extend("Views\userlayout") ?>
<?php echo $this->section("title")?>
<?php 
	echo $this->endSection();
   if(isset($validation))
	{

     print_r($validation->listErrors());
   }
 echo $this->section("body")?>
<style>
.bal_block .amt { font-size: 32px;}
.alert { padding: 7px;font-size: 10px; }
</style>
	<div class="dashboard">
	<div class="row">
		<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8">
			<div class="left_part">
				<!-- Breadcrumb -->
				<div class="breadcrumb_info">
					<ul>
						<li><a href="#">Home</a></li>
						<li>Dashboard</li>
					</ul>
				</div>                        
				<!-- Title -->
				<h2 class="title">Dashboard</h2>

				 <?php if (session()->getFlashdata('msg')) : ?>
					<div class="alert alert-warning">
						<?= session()->getFlashdata('msg') ?>
					</div>
				<?php endif; ?>
				<div class="wallet_bottom" style="padding:30px 0px 5px;">
					<div class="row">
						<div class="col-xxl-6 col-sm-6">
							<div class="cate_prz_block">
								<!--i><img src="images/dogecoin-blue.svg" alt=""></i-->
								<div class="dtl">
									<small>Portfolio Balance</small>
									<span><?php echo floatvalue($wallets['portfolio']); ?>  </span>
								</div>
							</div>
						</div>
						<?php if($cashback_enable > 0){ ?>
						<div class="col-xxl-6 col-sm-6">
							<div class="cate_prz_block">
								<!--i style="background:#e0f0e4;"><img src="images/Euro.svg" alt=""></i-->
								<div class="dtl">
									<small>Cashback Amount</small>
									 <?php echo $user_wallet_symbol;?><?php if($cashback_amount > 0){ echo floatvalue($cashback_amount); }else{ echo floatvalue(0); } ?>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="deposit_sec">
					<?php if($kyc_status['status']==0){?>
					<div class="alert alert-warning">	
						Please click the <a href="<?php echo base_url();?>uploadkyc" title="Upload KYC Document" ><span>Upload KYC</span></a> link to finish your kyc process. Once you kyc process done then you can order card.
					</div>	
					<?php 
					}else if(!empty($statuses))
					{
					foreach($statuses as $kyc)
					{
						if($kyc['status']=='Rejected')
						{
						?>
						<div class="alert alert-danger">
							<?php echo strtoupper($kyc['document_name']);?> - <b><?php echo $kyc['status'];?></b> <br/>
							Please click the <a href="<?php echo base_url();?>updatekyc/<?php echo $kyc['document_name'];?>" title="Update KYC" >Update <?php echo $kyc['document_name'];?> </a> link to finish your kyc process. Once you kyc process done then you can order card.
						</div>		
						<?php }else if($kyc['status']=='Pending'){ ?>
						<div class="alert alert-primary"><?php echo strtoupper($kyc['document_name']);?> - <b><?php echo $kyc['status'];?></b></div>
					<?php } }  } ?>
				</div>
				
				
				<!-- Balance -->
				<div id="balances">
				<div class="balance">
					<div class="row">
						<?php 
						if(!empty($wallets['wallets']))
						{
							$i = 0;
							foreach($wallets['wallets'] as $wallet)
							{
								$sts=1;
								if($wallet['type_wallet']=='prepaid' || $wallet['type_wallet']=='debitcard')
								{
									if($wallet['is_active_or_order']==1)
									{
										$sts=1;
									}else{
										$sts=0;
									}
								}
								
								$col = '';
								if($i % 3 == 0)
								{
									$col = 'purple';
								}
								$i++;
						?>
						<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-5" style="<?php if($sts==0){ echo 'display:none;';}?>cursor:pointer;">
							<div class="bal_block <?= $col; ?>" onclick="window.location='<?php echo base_url()?>wallet-detail/<?php echo $wallet['type_wallet']?>';">
								<h3><?php echo $wallet['title']?></h3>
								<div class="row">
									<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-7 col-7">
										<div class="amt"><?php if(isset($wallet['balance'])){echo $wallet['balance'];} ?></div>
									</div>
									<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-5">										
										<a  style="cursor:pointer;"><div class="qr"><span><img src="<?php echo $wallet['image']?>" alt="" style="width:25px;"></span></div></a>
									</div>
								</div>
							</div>
						</div>
						<?php } }?>

						
					</div>
				</div>						        
				<h3>Card Wallets</h3>
				<div class="balance">
					<div class="row">
						<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6" style="cursor:pointer;">
							<div class="bal_block prepaid" onclick="window.location='<?php echo base_url()?>wallet-detail/<?php echo $wallets['card']['prepaid_wallet']['type_wallet']?>';">
								<h3>Prepaid Wallet</h3>
								<div class="row">
									<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-7 col-7">
										<div class="amt"><?php if(isset($wallets['card']['prepaid_wallet']['balance'])){echo $wallets['card']['prepaid_wallet']['balance']; } ?></div>
									</div>
									<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-5">										
										<a style="cursor:pointer;"><div class="qr"><span style="background:transparent;"><img src="<?php echo $wallets['card']['prepaid_wallet']['image']?>" alt="Prepaid Card"></span></div></a>
									</div>
								</div>
							</div>
						</div>  
						<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6" style="cursor:pointer;">
							<div class="bal_block debicard" onclick="window.location='<?php echo base_url()?>wallet-detail/<?php echo $wallets['card']['debitcard_wallet']['type_wallet']?>';">
								<h3>Debitcard Wallet</h3>
								<div class="row">
									<div class="col-xxl-8 col-xl-8 col-lg-8 col-md-7 col-7">
										<div class="amt"><?php if(isset($wallets['card']['debitcard_wallet']['balance'])){echo $wallets['card']['debitcard_wallet']['balance']; } ?></div>
									</div>
									<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-5">										
										<a style="cursor:pointer;"><div class="qr"><span><img src="<?php echo $wallets['card']['debitcard_wallet']['image']?>" alt="Debitcard" style="width:100%; max-width: 57px;" ></span></div></a>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
				</div>
			   
				
				<!-- Benificiary -->
				<div class="benificiary">
					<h3>Benificiary List</h3>
					<?php if(!empty($wallets['beneficiary'])){  ?>
					<div class="owl-carousel benificiary_slider">
						
						<?php  foreach($wallets['beneficiary'] as $bn){ ?>
						<div class="item">
							<div class="ben_block">
								<a href="<?php echo base_url();?>beneficiaries" >
								<figure><img src="<?php echo $bn['image']; ?>" alt=""></figure>
								<p><?php echo $bn['name']; ?> <small><?php echo strtoupper($bn['bank_account']); ?></small></p>
								</a>
							</div>
						</div>								
						<?php } ?>		
					</div>
					 <?php }else{  echo '<p style="text-align:center;">No Beneficiary Added</p>'; } ?>
				</div>                        
				<!-- Movers -->
							
			</div>
		</div>                
		<!-- Right Part -->
		<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
			<div class="tranjection">
				<h3>Transactions History</h3>
				<div class="content content_1" id="transaction_list">
					<ul class="transhistry_list">
						<?php 
						if(!empty($wallets['transactions']))
						{
						$datewisetransaction = array();	
						foreach($wallets['transactions'] as $trans){ 
							$dd = date('F d, Y',strtotime($trans['created']));
							$datewisetransaction[$dd][] = $trans;
						}					
						foreach($datewisetransaction as $key=>$trxs)
						{ 					
							foreach($trxs as $trx){
							if($trx['type'] == 'debit')
							{
								$mode = 'red';
								$type = 'Debit';
								$icon = 'icon_out';
							}else{
								$mode = '';
								$type = 'Credit';
								$icon = 'icon_in';
							}
						?>
						<li class="<?php echo $mode ?>">
							<i><img src="<?php echo base_url();?>assets/usertheme/images/<?php echo $icon ?>.svg" alt=""></i>
							<div class="rtl_dtl">
								<strong><?php echo $trx['description']; ?></strong>
								<div class="row">
									<div class="col-xl-8 col-lg-7 col-md-7 col-sm-7">
										<?php echo date('d M h:i a',strtotime($trx['created'])); ?>
									</div>
									<div class="col-xl-4 col-lg-5 col-md-5 col-sm-5">
										<b><?php echo $trx['symbol'].floatvalue($trx['total']); ?></b>
									</div>
								</div>
							</div>
							
						</li>
					  <?php } }  ?>		
					<?php }else{ ?>
						 <li>No Transactions Found </li>
					<?php } ?>
					</ul>
					 <a class="centered-load-more-link smaller" href="<?php echo base_url().'transactions'; ?>"><span>View All Transactions</span></a>
					</div>
				</div>                    
			</div>
		</div>
	</div>			
   	
<?php echo $this->endSection()?>
<?php echo $this->section("scripts");?>
<script>
	var totben = <?php if(isset($wallets['beneficiary'])){ echo count($wallets['beneficiary']); }else{ echo 0; } ?>;
	if(totben < 6)
	{
		var items_1 = totben;
	}else{
		var items_1 = 6
	}
	function payqr()
	{
		 $("#payqr").modal('show');
	}
	 var owl = $('.benificiary_slider');
      owl.owlCarousel({
        margin:20,
        loop: true,
		dots:false,
		nav:true,
		autoplay:true,
		items:items_1,
        
      })
	 
	$('.bal_block').on('click', function(){
		$('.bal_block').removeClass('active');
		$(this).addClass('active');	
	});
</script>
<?php echo $this->endSection()?>
