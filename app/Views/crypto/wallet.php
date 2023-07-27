	<?php echo $this->extend("Views\userlayout");  ?>
	<?php echo $this->section("title"); ?>
	<?php 
		echo $this->endSection();
	   if(isset($validation))
		{

		 print_r($validation->listErrors());
	   }
		echo $this->section("body");	 
		$flag = 0;
		if(!empty($coinlist['crypto_fee']))
		{
			$flag = 1;
		}
		$this->session = session();		
		$user_wallet = $this->session->get('user_wallet');
		$user_wallet_symbol = $this->session->get('user_wallet_symbol');
		if(empty($user_wallet)){ $user_wallet = 'EUR'; }
		if(empty($user_wallet_symbol)){ $user_wallet_symbol = '€'; }
		
	?>	
	<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper cc_con_wrapper">
        <div class="middle_content cryptoc_detail">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url().'dashboard'; ?>">Home</a></li>
                    <li><a href="<?php echo base_url().'crypto'; ?>">Crypto Currency</a></li>
                    <li><?php echo $coinlist['coin'][$coin]['title'];  ?> Wallet</li>
                </ul>
            </div>
            <div class="row">
            	<div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                	<div class="wallet_detail">
                        <div class="wallet_top">
                            <div class="d-flex align-items-center mb-30">
                                <i class="w_icon"><img src="<?php echo $coinlist['coin'][$coin]['image']; ?>" alt="<?php echo $coinlist['coin'][$coin]['title']; ?>"></i>
                                <div class="w_icon_title"><?php echo $coinlist['coin'][$coin]['title'];  ?> Wallet</div>
                            </div>
							<?php if($coin != 'eur'){  ?>
                            <div class="navbar justify-content-start p-0">
                                <a href="<?php echo  $coinlist['coin'][$coin]['official_link'];?>" class="btn btn-bordered me-3 mb-3"><i class="fa fa-link"></i> Official Link</a>
                                <a href="<?php echo  $coinlist['coin'][$coin]['expoloer_link'];?>" class="btn btn-bordered me-3 mb-3"><i class="fa fa-refresh"></i> Explorers</a>
                                <a href="<?php echo base_url().'crypto'?>" class="btn btn-bordered mb-3 me-md-3"><i class="bi-wallet d-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet" viewBox="0 0 16 16"><path d="M0 3a2 2 0 0 1 2-2h13.5a.5.5 0 0 1 0 1H15v2a1 1 0 0 1 1 1v8.5a1.5 1.5 0 0 1-1.5 1.5h-12A2.5 2.5 0 0 1 0 12.5V3zm1 1.732V12.5A1.5 1.5 0 0 0 2.5 14h12a.5.5 0 0 0 .5-.5V5H2a1.99 1.99 0 0 1-1-.268zM1 3a1 1 0 0 0 1 1h12V2H2a1 1 0 0 0-1 1z"/></svg></i> Back to wallet</a>
                                
                                <span class="lbl_white ms-xxl-auto mb-3">Blockchain : <strong>Active</strong></span>
                            </div>
							<?php } ?>
                        </div>
                        <div class="wallet_bottom">
                            <div class="row">
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="cate_prz_block">
                                        <i><img src="<?php echo $coinlist['coin'][$coin]['image']; ?>" alt="<?php echo $coinlist['coin'][$coin]['title']; ?>" ></i>
                                        <div class="dtl">
                                            <small>Total <?php echo $coinlist['coin'][$coin]['title'];  ?> Balance</small>
                                           <?php echo to_decimal($coinlist['coin'][$coin]['crypto_balance'],$coinlist['coin'][$coin]['decimal_digit']); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="cate_prz_block">
                                        <i style="background:#e0f0e4;"><img src="<?php echo base_url(); ?>assets/userpanel/images/Euro.svg" alt=""></i>
                                        <div class="dtl">
                                            <small><?php echo strtoupper($user_wallet);?> Balance</small>
												<?php echo $user_wallet_symbol;?><?php  if($user_wallet=='usd'){
													echo to_decimal($coinlist['coin'][$coin]['usd_balance'],2); 
												  }else{
													echo to_decimal($coinlist['coin'][$coin]['eur_balance'],2);
												  }
												 ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="cate_prz_block">
                                        <i style="background:#fff0ea;"><img src="<?php echo $coinlist['coin'][$coin]['image']; ?>" alt="<?php echo $coinlist['coin'][$coin]['title']; ?>"></i>
                                        <div class="dtl">
                                            <small>1 <?php echo $coinlist['coin'][$coin]['title'];  ?> Price</small>
                                            <?php echo $user_wallet_symbol; ?>
											<?php 
												if($user_wallet=='usd'){
													 echo to_decimal($coinlist['coin'][$coin]['usd_price'],2);
												  }else{
													 echo to_decimal($coinlist['coin'][$coin]['eur_price'],2);
												  }
											?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="cate_prz_block">
                                        <i style="background:#ffe9e9;"><img src="<?php echo base_url(); ?>assets/userpanel/images/Copy.svg" alt=""></i>
                                        <div class="dtl">
                                            <small>Coin Rank</small>
                                            #<?php echo $coinlist['coin'][$coin]['cmc_rank'];  ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-sm-6">
                                    <div class="cate_prz_block">
                                        <i style="background:#e5e5fc;"><img src="<?php echo base_url(); ?>assets/userpanel/images/Token.svg" alt=""></i>
                                        <div class="dtl">
                                            <small>Coin/Token</small>
                                            <?php 
												$ct = ucfirst($coinlist['coin'][$coin]['coin_type']); 
												echo $ct;
											?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
				<?php if($coin == 'eur'){ ?>
					<!-- THIS IS FOR EUR WALLET -->
					<div class="row spacing15">						
						<div class="col-lg-12" style="margin-top:5px;">
							<a href="javascript:void()"  data-bs-target="#eurwithdraw" data-bs-toggle="modal" class="coin_service">
								<i><img src="<?php echo base_url(); ?>assets/userpanel/images/sell.svg" alt=""></i>
							   <span>Withdraw Crypto EUR To Main Euro Wallet </span> 
							</a>
						</div>					
					</div>						
					<?php }else if($coinlist['coin'][$coin]['coin_type'] != 'fiat'){ ?>
					<style>
					.qr_block p {
						font-size: 12px;
					}
					</style>
						<div class="qr_block">
						<h6>
						<?php echo $coinlist['coin'][$coin]['title'];  ?> Qr Code</h6>
						<?php
							
							if(isset($coinlist['address'][$coin]['is_token']) && ($coinlist['address'][$coin]['is_token'] == 0))
							{
													
							$qr = '';
							$adr = '';
							$des = '';
							//deposit_uri
							if(!empty($coinlist['address'][$coin]['dest_tag']) && !empty($coinlist['address'][$coin]['address']))
							{
							
								$qr = $coinlist['address'][$coin]['deposit_uri'];
								
								$adr = $coinlist['address'][$coin]['address'];
								$des = $coinlist['address'][$coin]['dest_tag'];
							}else{
								$qr = $coinlist['address'][$coin]['address'];
								$adr = $coinlist['address'][$coin]['address'];
							}
							
							$network_type = $coinlist['address'][$coin]['network_type'];
							$is_token = $coinlist['address'][$coin]['is_token'];
							$is_binnace = $coinlist['address'][$coin]['is_binnace'];
							if(!empty($qr))
							{
								
						?>
							<figure><img src="<?php echo 'https://chart.googleapis.com/chart?cht=qr&chs=170x170&chl='.$qr.'&choe=UTF-8&chld=L'; ?>" alt=""></figure>
							<?php }	?>
							<?php if(!empty($adr)){ ?>
								<p>Wallet: <span id="crypto_address"><?php echo $adr; ?></span> <a href="javascript:void()" onclick="copy_functions('crypto_address')" class="ms-2"><img src="<?php echo base_url(); ?>assets/userpanel/images/copy_sm.svg" alt=""></a></p>
							<?php } ?>
							<?php if(!empty($des)){ ?>
								<p>Destination: <span id="memo"><?php echo $des; ?></span> <a href="javascript:void()" class="ms-2" onclick="copy_functions('memo')"><img src="<?php echo base_url(); ?>assets/userpanel/images/copy_sm.svg" alt=""></a></p>
							<?php } ?>
							<?php if($is_binnace == 1){ ?>
							
							<?php if(!empty($adr)){ ?>
								<p>Network Type: <span id="crypto_address"><?php echo $network_type; ?></span></p>
							<?php } ?>							
							
							<br/>
							<p style="color:red;">Pay attention the amount sending has to be from the same Sender address, otherwise the Beneficiary will lose the deposit</p>
							<?php } ?>
							<?php 
							
							}else{
								if(isset($coinlist['address'][$coin]['is_token']) && ($coinlist['address'][$coin]['is_token'] == 1))
								{
								$i=0;	
								foreach($coinlist['address'][$coin]['networks'] as $network)
								{
								$adr = 	$network['qr_address'];
								$network_type = strtoupper($network['network']);
								$display = '';
								if($i > 0)
								{
									$display = 'none';
								}
							?>
								<div class="address" id="<?php echo $network_type; ?>" style="display: <?= $display; ?>">	
									<figure><img src="<?php echo 'https://chart.googleapis.com/chart?cht=qr&chs=170x170&chl='.$adr.'&choe=UTF-8&chld=L'; ?>" alt=""></figure>							
									<?php if(!empty($adr)){ ?>
										<p>Wallet: <span id="crypto_address-<?php echo $network_type; ?>"><?php echo $adr; ?></span> <a href="javascript:void()" onclick="copy_functions('crypto_address-<?php echo $network_type; ?>')" class="ms-2"><img src="<?php echo base_url(); ?>assets/userpanel/images/copy_sm.svg" alt=""></a></p>
									<?php } ?>	
									<p>Network Type: <span id="crypto_address"><?php echo $network_type; ?></span></p>	
								</div>
								
								<?php $i++; } ?>
								<br><br>
							<?php 
							
							foreach($coinlist['address'][$coin]['networks'] as $network)
								{
									$network_type = strtoupper($network['network']);
							?>	
								
								<a href="#" onclick="hide_show('<?php echo $network_type; ?>')" class="btn btn-primary"><?php echo $network_type; ?></a>
							<?php  } }  } ?>
							</div>
							<script>
								function hide_show(id)
								{
									$(".address").hide();
									$("#"+id).show();
								}
							</script>
							<div class="row spacing15">								
								<div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-15 mb-15">
									<a href="javascript:void()" data-bs-target="#exchangecrypto" data-bs-toggle="modal" class="coin_service">
										<i><img src="<?php echo base_url(); ?>assets/userpanel/images/convert.svg" alt=""></i>
									   <span>Convert</span> 
									</a>
								</div>
								
								<div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-15 mb-15">
									<a href="javascript:void()" data-bs-target="#withdraw" data-bs-toggle="modal" class="coin_service">
										<i><img src="<?php echo base_url(); ?>assets/userpanel/images/sell.svg" alt=""></i>
									   <span>Withdraw</span> 
									</a>
								</div>
								<div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-15 mb-15">
									<a href="javascript:void()" data-bs-target="#model_move_crypto_debit" data-bs-toggle="modal" class="coin_service">
										<i><img src="<?php echo base_url(); ?>assets/userpanel/images/png-icon.png" alt=""></i>
									   <span>Move Crypto To Debit Wallet</span> 
									</a>
								</div>
								<div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 col-6 mb-15 mb-15">
									<a href="javascript:void()" data-bs-target="#model_move_debit_crypto" data-bs-toggle="modal" class="coin_service">
										<i><img src="<?php echo base_url(); ?>assets/userpanel/images/png-icon-1.png" alt=""></i>
									   <span>Move Debit To Crypto Wallet</span> 
									</a>
								</div>
							</div>
					<?php } ?>
                </div>
            </div>
			<div class="row">
				<div class="transition_history middle_content">
					<h3 class="title"><?php echo $coinlist['coin'][$coin]['title'];  ?> Recent Transactions</h3>
					<div class="table_info">
						<div class="table-responsive">
							<table class="table caption-top">
								<thead>
									<tr>
										<th>Total Amount</th>
										<th class="types text-center" align="center">Type</th>
										<th>Description</th>
										<th>TRXID</th>
										<th>Status</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody class="trx_body">
									<tr><td colspan="6" style="text-align:center;">Loading...</td></tr>					
								</tbody>                       
							</table>
						</div>
					</div>
				</div>	
			</div>
        </div> 			
    </div>
	<div class="modal fade modal_info" id="model_move_debit_crypto" tabindex="-1" aria-labelledby="WithdrawalModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">
					<div class="wire_detail sell_detail">
						<h3>Move Debit <?php echo strtoupper($coinlist['coin'][$coin]['currency_name']);   ?> To Main Card Wallet</h3>
						<p>Available Balance:<br><span class="wd_amt"><?php echo to_decimal($coinlist['debitcard_wallet'],$coinlist['coin'][$coin]['decimal_digit']).' '.strtoupper($coinlist['coin'][$coin]['currency_name']); ?></span></p>
						<form id="move_debit_crypto" name="move_debit_crypto" method="POST" >
							<input type="hidden" name="coin" value="<?php echo $coinlist['coin'][$coin]['currency_symbol'];  ?>">
							<div class="amt_detail">								
								<div class="form-block">
									<label>Enter Amount(<?php echo strtoupper($coinlist['coin'][$coin]['currency_name']); ?>)</label>
									<div class="conv_info">
										<div class="price">
											<i><img src="<?php echo $coinlist['coin'][$coin]['image']; ?>" alt=""></i>
											<div class="w-100">
												<input class="form-control" placeholder="Enter Amount..." type="text" value="" name="debit_main_crypto_amount" id="debit_main_crypto_amount" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
								</div>						
							</div>
							<button class="btn text-uppercase" type="submit" name="submitBtn" id="submitcmtd" onclick="disablebtn('submitcmtd')">Move To Crypto Wallet</button>
						</form>							
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade modal_info" id="model_move_crypto_debit" tabindex="-1" aria-labelledby="WithdrawalModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">
					<div class="wire_detail sell_detail">
						<h3>Move  <?php echo strtoupper($coinlist['coin'][$coin]['currency_name']);   ?> To Debit Card Wallet</h3>
						<p>Available Balance: <span class="wd_amt"><?php echo to_decimal($coinlist['coin'][$coin]['crypto_balance'],$coinlist['coin'][$coin]['decimal_digit']).' '.strtoupper($coinlist['coin'][$coin]['currency_name']); ?></span></p>
						<form id="move_crypto_debit" name="move_crypto_debit" method="POST" >
							<input type="hidden" name="coin" value="<?php echo $coinlist['coin'][$coin]['currency_symbol'];  ?>">
							<div class="amt_detail">
								
								<div class="form-block">
									<label>Enter Amount(<?php echo strtoupper($coinlist['coin'][$coin]['currency_name']); ?>)</label>
									<div class="conv_info">
										<div class="price">
											<i><img src="<?php echo $coinlist['coin'][$coin]['image']; ?>" alt=""></i>
											<div class="w-100">
												<input class="form-control" placeholder="Enter Amount..." type="text" value="" name="debit_crypto_amount" id="debit_crypto_amount" onkeypress="return isNumberKey(event)">
											</div>
										</div>
									</div>
								</div>						
							</div>
							<button class="btn text-uppercase" type="submit" name="submitBtn" id="submitmctd" onclick="disablebtn('submitmctd')">Move To Debit Card Wallet</button>
						</form>	
						<form id="confirm_move_crypto_debit" name="confirm_move_crypto_debit" method="POST" style="display:none;" >
							<p>Check your email for a confirmation code and enter it. If you enter the wrong code, your account will be suspended.</p>
							<div class="">
								<div class="form-block">										
									<input style="border-color:#4fac68;" class="form-control" placeholder="Enter confirmation code" type="text" value="" name="debit_confirm_code" id="debit_confirm_code" >
								</div>	
								<div class="form-block">										
									<select name="status" class="form-control" style="border-color:#4fac68;" >
										<option value="Completed">Approved</option>
										<option value="Canceled">Canceled</option>
									</select>
								</div>
							</div>                                
							<button class="btn text-uppercase" name="submitBtn" id="submitmctds" onclick="disablebtn('submitmctds')">Confirm</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade modal_info" id="exchangecrypto" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">					
					<iframe src="<?php echo base_url().'crypto/exchange/'.$coin; ?>"  scrolling="no" style="width:100%; border:0px;height: 540px;"></iframe>					
				</div>			
			</div>			
		</div>
	</div>
	<?php if($coin != 'eur'){ ?>
	<div class="modal fade modal_info" id="withdraw" tabindex="-1" aria-labelledby="WithdrawalModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">
					<div class="wire_detail sell_detail">
						<h3>Withdrawal <?php echo $coinlist['coin'][$coin]['currency_name'];  ?> </h3>
						<p>Available Balance: <span class="wd_amt"><?php echo to_decimal($coinlist['coin'][$coin]['crypto_balance'],$coinlist['coin'][$coin]['decimal_digit']).' '.strtoupper($coinlist['coin'][$coin]['currency_name']); ?></span></p>
						
						
						<form id="withdrawtrx" name="withdrawtrx" method="POST" >
						<input type="hidden" name="coin" value="<?php echo $coinlist['coin'][$coin]['currency_symbol'];  ?>">
						<div class="amt_detail">
							
							<div class="form-block">
								<label>Enter Amount(<?php echo strtoupper($coinlist['coin'][$coin]['currency_name']); ?>)</label>
								<div class="conv_info">
									<div class="price">
										<i><img src="<?php echo $coinlist['coin'][$coin]['image']; ?>" alt=""></i>
										<div class="w-100">
											<input class="form-control" placeholder="Enter Amount..." type="text" value="" name="crypto_amount" id="wamount" onkeypress="return isNumberKey(event)">
										</div>
									</div>
								</div>
							</div>
							
							<div class="form-block">
								<label>Enter Receiver  <?php echo $coinlist['coin'][$coin]['title'];  ?> Address</label>
								<div class="conv_info">
									<div class="price">
										<i class="yellow"><img src="<?php echo base_url(); ?>assets/userpanel/images/app_wallet.svg" alt=""></i>
										<div class="w-100">
											<input class="form-control" placeholder="Enter Receiver Address" type="text" value="" name="receiver_address" id="receiver_address">	
										</div>
									</div>
								</div>
							</div>	
							
							<?php if(!empty($coinlist['address'][$coin]['networks'])){ ?>
							<div class="form-block">
								<label>Network</label>
								<div class="conv_info">
									<div class="price">
										<i class="yellow"><img src="<?php echo base_url(); ?>assets/userpanel/images/app_wallet.svg" alt=""></i>
										<div class="w-100">
											<select name="network" class="form-control" >
												<?php 							
												foreach($coinlist['address'][$coin]['networks'] as $network)
												{
													$network_type = strtoupper($network['network']);
												?>	
													<option value="<?php echo $network['network']; ?>"><?php echo $network_type; ?></option>
												<?php  }    ?>
											</select>	
										</div>
									</div>
								</div>
							</div>	
							<?php } ?>	
						
						</div>
						<button class="btn text-uppercase" type="submit" name="submitBtn" id="submitmovewithBtn" onclick="disablebtn('submitmovewithBtn')">Withdrawal</button>
						</form>	
						<form id="confirm_withdrawtrx" name="confirm_withdrawtrx" method="POST" style="display:none;" >
							<p>Check your email for a confirmation code and enter it. If you enter the wrong code, your account will be suspended.</p>
							<div class="">
								<div class="form-block">										
									<input style="border-color:#4fac68;" class="form-control" placeholder="Enter confirmation code" type="text" value="" name="confirm_code" id="wconfirm_code" >
								</div>	
								<div class="form-block">										
									<select name="status" class="form-control" style="border-color:#4fac68;" >
										<option value="Completed">Approved</option>
										<option value="Canceled">Canceled</option>
									</select>
								</div>
							</div>                                
							<button class="btn text-uppercase" name="submitBtn" id="submitmovewithBtns" onclick="disablebtn('submitmovewithBtns')">Confirm</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<?php if($coin == 'eur'){ ?>
	<div class="modal fade modal_info" id="eurwithdraw" tabindex="-1" aria-labelledby="SellModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				<div class="modal-body">
					<div class="wire_detail sell_detail">
						<i class="icon"><img src="<?php echo base_url(); ?>assets/userpanel/images/sell.svg" alt=""></i>
						<form id="withdraw_euro" name="withdraw_euro" method="POST" >	
							<h3>Withdraw Crypto EUR To Main Euro Wallet</h3>
							<p>Main Eur Balance: &euro;<?php echo to_decimal($coinlist['coin'][$coin]['crypto_balance'],$coinlist['coin'][$coin]['decimal_digit']); ?></p>
							<div class="amt_detail">
								<div class="form-block">
									<label>Enter Amount</label>
									<input class="form-control" placeholder="Enter Amount..." type="text" value="" name="send_amount" id="send_amount" onkeypress="return isNumberKey(event)" >
								</div>
							</div>                                
							<button class="btn text-uppercase" name="submitBtn" id="submitmoveBtn" onclick="disablebtn('submitmoveBtn')">Withdraw EUR</button>
						</form>	
						<form id="confirm_withdraw_euro" name="confirm_withdraw_euro" method="POST" style="display:none;" >
							<h3>Withdraw Crypto EUR To Main Euro Wallet</h3>
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
						</form>		
					</div>
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>
	<script>
		
		function disablebtn(id)
		{							
			setTimeout(function(){ $('#'+id).prop('disabled', true); },300);
			setTimeout(function(){ $('#'+id).prop('disabled', false); },5000);
		}
		function closepop()
		{			
			$("#withdraw").modal("hide");
			$("#sellcrypto").modal("hide");
			$("#buycrypto").modal("hide");
			window.location.reload(true);	
		}			
		function isNumberKey(evt){
			var charCode = (evt.which) ? evt.which : evt.keyCode
			if ((charCode > 34 && charCode < 41) || (charCode > 47 && charCode < 58) || (charCode == 46) || (charCode == 8) || (charCode == 9))
				return true;
			return false;
		}
		function gettrx()
		{
				
			$.ajax({url: "<?php echo base_url().'crypto/getTrxcoin/'.$coin;?>", success: function(result){
				const obj = JSON.parse(result);				
				if(obj.status == 1)
				{
					var arr = obj.trx;
					var trx = "";
					var k = 1;
					for (var i = 0; i < arr.length; i++)
					{
						
						var trx_type = arr[i]['trx_type'];					
						if(arr[i]['has_link'] == ' ')
						{
							var trxlin = arr[i]['transaction_id'];
						}else{
							var trxlin = "<a target='_blank' href='"+arr[i]['has_link']+"'>"+arr[i]['transaction_id']+"</a>";
						}						
						var amt = arr[i]['total'] * 1;
						var showamt = (amt).toFixed(<?php echo $coinlist['coin'][$coin]['decimal_digit'];?>);
						var color = 'text-'+arr[i]['color'];
						//var status_color = 'text-'+arr[i]['status_color'];
						var status_color = 'status_tag';
						if(arr[i]['color'] == 'success')
						{
							var type_tag = 'type_tag ';
						}else{
							var type_tag = 'type_tag red';
						}
						trx+= "<tr class='nowrap'><td style='text-transform:uppercase;' class='"+color+"'>"+showamt+" "+arr[i]['coinsymbol']+"</td><td style='text-transform: capitalize;'><span class='"+type_tag+"'>"+trx_type+"</span></td><td style='text-transform: capitalize;'>"+arr[i]['description']+"</td>><td>"+trxlin+"</td><td><span class='"+status_color+"'><img src='<?php echo base_url(); ?>assets/userpanel/images/tickmark.svg'><br/>"+arr[i]['status']+"</span></td><td>"+arr[i]['created']+"</td></tr>";
						
						
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
			
			$('#move_debit_crypto').validate({
			rules: {
				debit_main_crypto_amount: {
					required: true,
				}
			},
			messages: {
				debit_main_crypto_amount: {
					required: "Please enter debit crypto amount",	
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
				const c  = confirm('Are you sure you want to move amount from debit crypto wallet to main crypto wallet?');
				if(c === true)
				{
				 $.ajax({
					url: "<?php echo base_url() ?>crypto/move_debit_crypto", 
					type: "POST",  
					data: $('#move_debit_crypto').serialize(),
					cache: false,             
					processData: false,      
					success: function(obj) 
					{	       
						var data = JSON.parse(obj);
						if(data.status == 1)
						{							
							$("#debit_main_crypto_amount").val('');	
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
				return false;
			}else{
				$("#debit_main_crypto_amount").val('');	
			}
			}
			});
			
			$('#move_crypto_debit').validate({
			rules: {
				debit_crypto_amount: {
					required: true,
				}
			},
			messages: {
				debit_crypto_amount: {
					required: "Please enter crypto amount",	
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
				 $.ajax({
					url: "<?php echo base_url() ?>crypto/move_crypto_debit", 
					type: "POST",  
					data: $('#move_crypto_debit').serialize(),
					cache: false,             
					processData: false,      
					success: function(obj) 
					{	       
						var data = JSON.parse(obj);
						if(data.status == 1)
						{							
							$("#debit_crypto_amount").val('');	
							$("#debit_confirm_code").val('');	
							$("#confirm_move_crypto_debit").show();
							$("#move_crypto_debit").hide();
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
			
				return false;
			}
			});
			
			$('#confirm_move_crypto_debit').validate({ 
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
						url: "<?php echo base_url() ?>crypto/confirm_move_crypto_debit", 
						type: "POST",  
						data: $('#confirm_move_crypto_debit').serialize(),
						cache: false,             
						processData: false,      
						success: function(obj) 
						{	 
							var data = JSON.parse(obj);
							if(data.status == 2)
							{
								$("#debit_crypto_amount").val('');	
								$("#debit_confirm_code").val('');	
								$("#confirm_move_crypto_debit").hide();
								$("#move_crypto_debit").show();
								swal({
									title: '',
									text: data.message,
									icon: "error",  
									dangerMode: false,
								});	
								setTimeout(function(){ location.reload();  },3000);
							}else if(data.status == 1)
							{			
								$("#debit_crypto_amount").val('');	
								$("#debit_confirm_code").val('');	
								$("#confirm_move_crypto_debit").hide();
								$("#move_crypto_debit").show();
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
			
			$('#confirm_withdrawtrx').validate({ 
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
						url: "<?php echo base_url() ?>crypto/confirm_withdrawtrx", 
						type: "POST",  
						data: $('#confirm_withdrawtrx').serialize(),
						cache: false,             
						processData: false,      
						success: function(obj) 
						{	 
							var data = JSON.parse(obj);
							if(data.status == 2)
							{
								swal({
									title: '',
									text: data.message,
									icon: "error",  
									dangerMode: false,
								});	
								setTimeout(function(){ location.reload();  },3000);
							}else if(data.status == 1)
							{			
								$("#receiver_address").val('');	
								$("#wamount").val('');	
								$("#wconfirm_code").val('');	
								$("#confirm_withdrawtrx").hide();
								$("#withdrawtrx").show();	
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
			
			$('#withdrawtrx').validate({
			rules: {
				crypto_amount: {
					required: true,
				},receiver_address: {
					required: true,
				}
			},
			messages: {
				crypto_amount: {
					required: "Please enter amount",					
					number: "Enter only number",					
				},receiver_address: {
					required: "Please enter receiver address",
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
				 $.ajax({
					url: "<?php echo base_url() ?>crypto/withdrawtrx", 
					type: "POST",  
					data: $('#withdrawtrx').serialize(),
					cache: false,             
					processData: false,      
					success: function(obj) 
					{	       
						var data = JSON.parse(obj);
						if(data.status == 2)
						{
							$("#receiver_address").val('');	
							$("#wamount").val('');	
							$("#wconfirm_code").val('');	
							$("#confirm_withdrawtrx").show();
							$("#withdrawtrx").hide();
							swal({
								title: '',
								text: data.message,
								icon: "error",  
								dangerMode: false,
							});		
							
						}else if(data.status == 1)
						{
							$("#receiver_address").val('');	
							$("#wamount").val('');	
							$("#wconfirm_code").val('');	
							$("#confirm_withdrawtrx").show();
							$("#withdrawtrx").hide();
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
			
				return false;
			}
			})
			
			<?php if($coin == 'eur'){ ?>	
			$('#withdraw_euro').validate({
				rules: {
					send_amount: {
						required: true,
					}
				},
				messages: {
					send_amount: {
						required: "Please enter amount",					
						number: "Enter only number",					
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
					<?php if($flag == 1) { ?>
						
						if($("#send_amount").val()   <= <?php echo $coinlist['coin'][$coin]['crypto_balance']; ?>)
						{
							$("#submitmoveBtn").hide();	
							$.ajax({
								url: "<?php echo base_url() ?>crypto/withdraw_euro", 
								type: "POST",  
								data: $('#withdraw_euro').serialize(),
								cache: false,             
								processData: false,      
								success: function(obj) 
								{	 
									$("#send_amount").val('');
									var data = JSON.parse(obj);
									if(data.status == 1){										
										swal({
											title: '',
											text: data.message,
											icon: "success",  
											dangerMode: false,
										});	

										$("#send_amount").val('');	
										$("#confirm_code").val('');	
										$("#withdraw_euro").hide();
										$("#confirm_withdraw_euro").show();			
										
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
						}else{
							$("#send_amount").val('');
							swal({
								title: '',
								text: "Indufficent balance in crypto EUR wallet. You can maximum move <?php echo to_decimal($coinlist['coin'][$coin]['crypto_balance'],2); ?>",
								icon: "error",  
								dangerMode: false,
							});	
						}
						<?php }else{ ?>
							swal({
								title: '',
								text: 'Sorry, you donot have permission to withdraw. Please contact to support team.',
								icon: "error",  
								dangerMode: false,
							});	
						<?php } ?>
						return false;
					
				}
			});	

			$('#confirm_withdraw_euro').validate({ 
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
						url: "<?php echo base_url() ?>crypto/confirm_withdraw_euro", 
						type: "POST",  
						data: $('#confirm_withdraw_euro').serialize(),
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
								setTimeout(function(){ location.reload();  },3000);
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
		});
		
		function copy_functions(containerid) 
		{			
			if (document.selection) { 
				var range = document.body.createTextRange();
				range.moveToElementText(document.getElementById(containerid));
				range.select().createTextRange();
				document.execCommand("copy"); 				

			} else if (window.getSelection) {
				var range = document.createRange();
				range.selectNode(document.getElementById(containerid));
				window.getSelection().addRange(range);
				document.execCommand("copy");				
			}			
		}
	</script>
<?php echo $this->endSection()?>