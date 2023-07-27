<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>

        <div class="transition_history middle_content">
			 <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url()?>dashboard">Home</a></li>
                    <li><a href="<?php echo base_url()?>transactions">Transaction</a></li>
                    <li>Transaction Detail</li>
                </ul>
            </div>
			 <h2 class="title">Transactions Detail - <?php echo $user_account['iban']; ?><a href="#" class="btn btn-primary btn-block" style="float: right;" onclick="history.back()"><span class="btn-label-icon left fa fa-arrow-left"></span>Back</a></h2>
			  <div class="table_info card_tran">
						<div class="table-responsive">
							<table class="table caption-top">
								  <tbody>
									<?php if(!empty($transaction['transactions']['transaction'])){
										$transaction=$transaction['transactions']['transaction'];
										
										if($transaction['status']=='Pending')
										{
											$sts=$transaction['status'];
											$sts_lbl="warning";
										}else if($transaction['status']=='Completed')
										{
											$sts=$transaction['status'];
											$sts_lbl="success";
										}else if($transaction['status']=='Processing')
										{
											$sts=$transaction['status'];
											$sts_lbl="info";
										}else if($transaction['status']=='Under-Review')
										{
											$sts=$transaction['status'];
											$sts_lbl="warning";
										}else if($transaction['status']=='Refunded')
										{
											$sts=$transaction['status'];
											$sts_lbl="danger";
										}
										if($transaction['type'] == 'credit'){
											$tx_label  = 'Recevier IBAN Account';
										}else{
											$tx_label  = 'Sender IBAN Account';
										}
										$typ_lbl="success";
										if($transaction['type']=='debit')
										{
											$typ_lbl="danger";
										}
									?>
									
									<tr>
										<td>Transaction Mode</td>
										<td><span class="label label-lg label-<?php echo $typ_lbl;?> label-inline"><?php echo ucfirst($transaction['type'])?></span></td>
									</tr>
									<tr>
										<td>Transaction ID</td>
										<td><?php echo $transaction['transaction_id']; ?></td>
									</tr>
									<tr>
										<td>Date</td>
										<td><?php echo date('d F Y H:i:s',strtotime($transaction['created'])); ?></td>
									</tr>
									<tr>
										<td>Amount</td>
										<td><?php echo $transaction['symbol']; ?> <?php echo to_decimal($transaction['amount'],2); ?></td>
									</tr>
									<tr>
										<td>Fee</td>
										<td> <?php echo $transaction['symbol']; ?> <?php echo to_decimal($transaction['fees'],2); ?></td>
									</tr>
									<?php if($transaction['type']=='debit'){ ?>
										<tr>
											<td>Total Send Amount</td>
											<td><?php echo $transaction['symbol']; ?> <?php echo to_decimal($transaction['total'],2); ?></td>
										</tr>
									<?php }else{ ?>
										<tr>
											<td>Total Received Amount</td>
											<td><?php echo $transaction['symbol']; ?> <?php echo to_decimal($transaction['total'],2); ?></td>
										</tr>
									<?php } ?>
										<tr>
											<td>Description</td>
											<td><?php echo $transaction['description']; ?></td>
										</tr>
									
										<?php if($transaction['type'] == 'internal'){ ?>
										<tr>
											<td>Transaction Type</td>
											<td>Internal Transaction</td>
										</tr>
										<?php }else if($transaction['type'] == 'debit' && $transaction['beneficiary_id']>0){ ?>
										<tr>
											<td>Beneficiary Name</td>
											<td><?php isset($beneficiary['name']) ? $beneficiary_name = $beneficiary['name'] : $beneficiary_name= '';echo $beneficiary_name?></td>
										</tr>
										<?php } ?>
										<tr>
											<td>Reference</td>
											<td><?php echo $transaction['reference']; ?></td>
										</tr>
										<tr>
											<td>Transaction Status</td>
											<td><span class="btn btn-<?php echo $sts_lbl;?> label-inline"><?php echo $sts;?></span></td>
										</tr>
									<?php }else{?>	
										<tr>
											<td colspan="2">No details for the transaction</td>
											
										</tr>
									<?php }?>
								  </tbody>
								</table>							
							</div>




		</div>
	</div>

  <?php echo $this->endSection()?>