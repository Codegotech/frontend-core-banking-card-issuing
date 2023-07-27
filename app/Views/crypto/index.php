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
							<li><a href="/dashboard">Dashboard</a></li>
							<li>Crypto Wallet</li>
						</ul>
					</div>                        
					<!-- Title -->
					<h2 class="title">Crypto Wallet</h2>

					 <?php if (session()->getFlashdata('msg')) : ?>
						<div class="alert alert-warning">
							<?= session()->getFlashdata('msg') ?>
						</div>
					<?php endif; ?>
					
					<div class="bitcoin_collapse">
						<div class="clps_title">
							<div class="bitcoin_left">								
								<i><img alt="<?php echo strtoupper($coinlist['coin']['btc']['currency_symbol']); ?>" src="<?php echo $coinlist['coin']['btc']['image']; ?>"></i>
								<div class="dtl">
									<strong><?php echo $coinlist['coin']['btc']['title']; ?></strong> (<?php echo strtoupper($coinlist['coin']['btc']['currency_symbol']); ?>)
									<p class="d-block d-sm-none mb-0">Balance :  <?php echo $coinlist['coin']['btc']['crypto_balance']; ?> </p>
								</div>
							</div>
							<div class="bitcoin_right">
								<p class="d-none d-sm-inline-block">Balance :  <?php echo $coinlist['coin']['btc']['crypto_balance']; ?></p>
								<a class="" data-bs-toggle="collapse" href="#collapseBitcoin" role="button" aria-expanded="false" aria-controls="collapseBitcoin"><i class="fa fa-angle-down"></i></a>
							</div>
						</div>
						<div class="collapse" id="collapseBitcoin">
						  <div class="bitc_drop">
							<div class="row align-items-center">
								<div class="col-lg-6 col-md-5 col-sm-5">
									<h3>Coin List</h3>
								</div>
								<div class="col-lg-6 col-md-7 col-sm-7">
									<div class="search_box">
										<a href="#" class="search_link"><i class="fa fa-search"></i></a>
										<input type="text" class="form-control" placeholder="search coin" id="wallet-address" onkeyup="searchcoin()" >
									</div>
								</div>
							</div>
							<div class="bitc_inner" >
									<?php
									$i=0;
									foreach($coinlist['coin'] as $coinlists)
									{
										
										if($i == 0)
										{
											$class = 'active';
										}else{
											$class = '';
										}
									?>									
									<a href="<?php echo base_url().'crypto/wallet/'.$coinlists['currency_name']; ?>" class="curency_strip selected <?php echo $class; ?> divhideshow">	
									
										<div class="bitcoin_left" style="width: 100%;">
											<i><img alt="<?php echo strtoupper($coinlists['currency_symbol']); ?>" src="<?php echo $coinlists['image']; ?>"></i>
											<div class="dtl bold" style="width: 100%;"><strong><?php echo $coinlists['title']; ?></strong> (<?php echo strtoupper($coinlists['currency_symbol']); ?>)
											<div style="float:right;">Balance :  <?php echo $coinlists['crypto_balance'].' '.strtoupper($coinlists['currency_symbol']); ?></div>
											</div>
										</div>
									</a>
									
								<?php $i++; } ?>
							</div>
						  </div>
						</div>
					</div>
					
					<div class="benificiary pb-0 border-0" >
						<!--h3>Top Movers</h3-->
						<div class="row pe-100" style="display:none;">
						
							<?php
								if(!empty($coinlist['topmover']))
								{										
								foreach($coinlist['topmover'] as $topmovers)
								{
							?>
							<div class="col-xxl-4 col-lg-6 col-md-6 col-sm-6">
								<div class="mov">
									<i class="icon" style="background:#FFE571;"><img src="<?php echo $topmovers['image']; ?>" alt="<?php echo $topmovers['currency_name']; ?>"></i>
									<div class="details">
										<p><?php echo $topmovers['currency_name']; ?> <small><?php echo $topmovers['currency_symbol']; ?></small></p>
										<?php if($topmovers['change_24h'] > 0){ ?>
											<p class="text-end"><span class="green"><?php echo $topmovers['change_24h']; ?>%</span> <?php echo $topmovers['eur_price']; ?></p>
										<?php }else{ ?>
											<p class="text-end"><span class="red">-<?php echo $topmovers['change_24h']; ?></span> <?php echo $topmovers['eur_price']; ?></p>
										<?php } ?>
									</div>
								</div>
							</div>
								<?php  } } ?>
						</div>
					</div>
					
					<div class="portfolio_balance">
						<div class="pb_top">
							<div class="row align-items-end">
								<div class="col-lg-6 col-md-6 col-sm-6">
									<label>Your Portfolio Balance :</label>
									<strong><?php echo $user_wallet_symbol;?>
									<?php if($user_wallet=='usd'){
										echo to_decimal($coinlist['total_usd_balance'],2);
									}else{
										echo to_decimal($coinlist['total_eur_balance'],2);
									} ?></strong>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 text-sm-end">
									<a href="<?php echo base_url().'crypto/wallet/btc'; ?>" class="btn btn-bordered"><i class="fa fa-refresh me-2"></i> Bitcoin wallet page</a>
								</div>
							</div>
						</div>
						<div class="pb_bottom">
							<?php
							$i=0;
							foreach($coinlist['coin'] as $coinlists)
							{						
								if($i > 6){ continue; }
								
							?>	
								<div class="mov">
									<i class="icon" style="background:#d0e4ff;"><img src="<?php echo $coinlists['image']; ?>" alt=""></i>
									<div class="details">
										<p><?php echo $coinlists['title']; ?> <small><?php echo strtoupper($coinlists['currency_symbol']); ?></small></p>
										<p class="text-end align-self-end"><?php echo $user_wallet_symbol;?><?php 
										if($user_wallet=='usd'){
											echo to_decimal($coinlists['usd_balance'],2);
										}else{
											echo to_decimal($coinlists['eur_balance'],2);
										} ?></p>
									</div>
								</div>
							<?php $i++; } ?>
						</div>
					</div>
				</div>
			</div>                
			<!-- Right Part -->
			<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
				<div class="tranjection">
					<h3>Order History</h3>
					 <div class="content content_1">
                    	<div class="table_sidebar">
                        	<div class="table-responsive">
                            	<table class="table">
                                	<thead>
                                    	<tr>
                                        	<th>Amount/Coin</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="trx_body">
                                    	<tr><td colspan="6" style="text-align:center;">No Transaction Found</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
				</div>                    
			</div>
		</div>
	</div>			
   	
<?php echo $this->endSection()?>
<?php echo $this->section("scripts");?>
<script>
	function searchcoin(){			
		var query = $('#wallet-address').val().toLowerCase();		
		$('a.divhideshow .bold').each(function(){		
			 var $this = $(this);
			 if($this.text().toLowerCase().indexOf(query) === -1)
				 $this.closest('a.divhideshow').fadeOut();
			else $this.closest('a.divhideshow').fadeIn();
		});
	}
	function gettrx()
	{
		$.ajax({url: "<?php echo base_url() ?>crypto/getTrx", success: function(result){
			const obj = JSON.parse(result);
			if(obj.status == 1)
			{
				var arr = obj.trx;
				//console.log(r);
				var trx = "";
				var k = 1;
				for (var i = 0; i < arr.length; i++)
				{
					trx+= "<tr><td style='text-transform:uppercase;'>"+arr[i]['total']+" "+arr[i]['coinname']+"</td><td>"+arr[i]['type']+"</td><td>"+arr[i]['status']+"</td><td>"+arr[i]['created']+"</td></tr>";
					k++;							
				}
				$(".trx_body").html(trx);
				setTimeout(function(){ gettrx() },20000);
			}else{
				$(".trx_body").html('<tr><td colspan="6" style="text-align:center;">No Transaction Found</td></tr>');
			}					
		}});
	}
	$(document).ready(function(){
		gettrx();
	});
	</script> 
<?php echo $this->endSection()?>
