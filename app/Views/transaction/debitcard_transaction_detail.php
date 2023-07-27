<?php echo $this->extend("Views\userlayout") ?>
<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>
 
        <div class="transition_history middle_content">
			 <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url()?>dashboard">Home</a></li>
                    <li><a href="<?php echo base_url()?>debitcard-transactions-list">Debitcard Transaction</a></li>
                    <li>Debitcard Transaction Detail</li>
                </ul>
            </div>
			<h2 class="title">Debitcard Transactions Detail<a onclick="window.history.back();" class="btn btn-primary btn-block" style="float: right;"><span class="btn-label-icon left fa fa-arrow-left"></span>Back</a></h2>
			<div class="table_info card_tran">
			<div class="table-responsive">
				<?php   
				if(!empty($transactions['transactions']))
				{ 
				$transaction=$transactions['transactions'];
				?>
				<table class="table caption-top">
					  <tbody>
					<?php
							if($transaction['status']==1)
							{
								$sts="Completed";
								$sts_lbl="success";
							}else
							{
								$sts="Pending";
								$sts_lbl="warning";
							}
							$bamt = str_replace('-','',$transaction['BillingAmount']);
							$amt = to_decimal($bamt + $transaction['FixedFee'] + $transaction['RateFee'] + $transaction['FxPaddingAmount'],2);
							$fee = to_decimal($transaction['fee'],2);
							$totalpay = to_decimal($amt + $transaction['fee'],2);
						?>
						
						<tr>
							<td>Transaction Mode</td>
							<td><?php echo $transaction['trx_type']; ?></td>
						</tr>
						<tr>
							<td>Transaction ID</td>
							<td><?php echo $transaction['TxId']; ?></td>
						</tr>
						<tr>
							<td>Date</td>
							<td><?php echo date('d F Y H:i:s',strtotime($transaction['created'])); ?></td>
						</tr>
						<tr>
							<td>Amount</td>
							<td> <?php echo to_decimal($amt,2); ?> <?php echo  strtoupper($transaction['user_wallet']);?></td>
						</tr>
						<tr>
							<td>Fee</td>
							<td> <?php echo to_decimal($fee,2); ?> <?php echo  strtoupper($transaction['user_wallet']);?></td>
						</tr>
						<tr>
							<td>Total Pay</td>
							<td> <?php echo to_decimal($totalpay,2); ?> <?php echo  strtoupper($transaction['user_wallet']);?></td>
						</tr>
						<tr>
							<td>Description</td>
							<td><?php echo $transaction['De042']; ?><br><?php echo $transaction['De043']; ?></td>
						</tr>
						<tr>
							<td>Stat Code</td>
							<td><?php echo $transaction['TxnStatCode']; ?></td>
						</tr>
						<tr>
							<td>Auth Code</td>
							<td><?php echo $transaction['AuthCodeDe38']; ?></td>
						</tr>
						<tr>
							<td>Note</td>
							<td><?php echo $transaction['Note']; ?></td>
						</tr>
						<?php if($transaction['trx_type']=='refund' && $transaction['status']==1){?>
						<tr>
						<td>Refunded Date:</td>
						<td><?php echo date('Y-m-d H:i:s',strtotime($transaction['refund_date']));?></td>
						</tr>
						<?php } ?>
						<tr>
							<td>Transaction Status</td>
							<td><span class="btn btn-<?php echo $sts_lbl;?> label-inline"><?php echo $sts;?></span></td>
						</tr>
						<tr>
							<td>Transaction Amount:</td>
							<td><?php echo $transaction['TxAmount'].' '.strtoupper($transaction['user_wallet']);  ?> (<?php echo $transaction['TxnCountry']; ?>)</td>
						</tr>									
					 </tbody>
					</table>
					<?php  if(!empty($transactions['trx_logs']) && ($transaction['trx_type'] == 'debit')){ ?>
						<div class="element-box">
							<table class="table table-lightborder">
							<h5>Debitcard Partial Payment Logs</h5>
								<thead>
									<tr>
										<th>Currency</th>
										<th>EUR Price</th>										
										<th>Crypto Amount</th>
										<th>Fiat Amount</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach($transactions['trx_logs'] as $logs){
										$logs=(object)$logs;
									?>
									<tr class="odd gradeX">
										<td><?php echo strtoupper($logs->currency_symbol); ?></td>
										<td><?php echo $logs->eur_price; ?></td>
										<td><?php echo $logs->crypto_amount.' '.strtoupper($logs->currency_symbol); ?></td>
										<td><?php echo $logs->total_pay; ?> <?php echo strtoupper($logs->user_wallet); ?></td>
									</tr>
								<?php } ?>
								<tbody>	
							</table>
						</div>
				  <?php } ?>
				<?php }else{?>	
					No details for the transaction
						<?php }?>								
				</div>
		</div>
	</div>
    <?php echo $this->endSection()?>