<?php echo $this->extend("Views\userlayout") ?>
<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>
<style>
.controls-below-table {
  display: -webkit-box;
  display: flex;
  -webkit-box-pack: justify;
  justify-content: space-between;
  font-size: 0.81rem;
}
.controls-below-table .table-records-pages ul {
  list-style: none;
}
.controls-below-table .table-records-pages ul li {
  display: inline-block;
  margin: 0px 10px;
}
</style>
	<?php
	
		$pages = round($transaction['num_rows'] / $transaction['per_page']);	
									

		
	?>

        <div class="transition_history middle_content">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url()?>dashboard">Home</a></li>
                    <li>Debitcard</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">Debitcard Outgoing Transactions</h2>
            <div class="table_info">
            	<div class="table-responsive">
                	<table class="table caption-top">
                    	<!--caption>
                        	<div class="cap_inn">
                                <div class="table_search">
                                    <a href="#" class="search_link"><i class="fa fa-search"></i></a>
                                    <input type="text" class="form-control" placeholder="Search">
                                </div>
                                <form method="post">
                                <div class="right_cap">
	
                                    <div class="cale_info">
                                        <i class="fa fa-calendar-minus-o"></i>
                                        <input type="date" name="startdate"  class="form-control" placeholder="dd/mm/yyyy" value="<?php if(!empty($startdate)) {echo date('Y-m-d',strtotime($startdate));} ?>">
                                    </div>
                                    <div class="cale_info">
                                        <i class="fa fa-calendar-minus-o"></i>
                                        <input type="date" name="enddate" class="form-control" placeholder="dd/mm/yyyy" value="<?php if(!empty($enddate)) {echo date('Y-m-d',strtotime($enddate));} ?>">
                                    </div>
                                    <input type="submit" class="table_btns" name="submit" value="Search">
                                    <a href="<?php echo base_url();?>personal/clear" class="table_btns light_green">Clear</a>
                                    <a href="<?php echo base_url();?>personal/download" class="table_btns yellow">Csv</a>
									
                                </div>
								</form>
                            </div>
                        </caption-->
                        <thead>
                        	<tr>
                            	<th>#</th>
								<th>Amount</th>
								<th>Fee</th>
								<th>Total Pay</th>
								<th>Type</th>
								<th>Status</th>
								<th>Created</th>
                                <th class="views">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php 									
								if(!empty($transaction['data']))
								{
									$i=1;
									foreach($transaction['data'] as $trxs)
									{
											
										if($trxs['status'] == 1){
											$sts= 'Completed';
											$sts_lbl="success";
										}else{
											$sts= 'Pending';
											$sts_lbl="info";
										}
										$bamt = str_replace('-','',$trxs['BillingAmount']);
										$amount = to_decimal($bamt + $trxs['FixedFee'] + $trxs['RateFee'] + $trxs['FxPaddingAmount'],2);
										$fee = to_decimal($trxs['fee'],2);
										$totalpay = to_decimal($amount + $trxs['fee'],2);
								?>
								<tr>
									<td><b><?php echo $i; ?></b></td>
									<td><?php echo  $amount;?> <?php echo  strtoupper($trxs['user_wallet']);?></td>       
									<td><?php echo  $fee;?> <?php echo  strtoupper($trxs['user_wallet']);?></td>       
									<td><?php echo  $totalpay;?> <?php echo  strtoupper($trxs['user_wallet']);?></td>       
									<td><?php echo $trxs['trx_type'];?></td>
									<td><span class="status_tag"><img src="<?php echo base_url();?>assets/userpanel/images/tickmark.svg" alt=""> <?php echo $sts; ?></span></td>
									<td><?php echo date('d M Y H:i',strtotime($trxs['created'])); ?></td>
									<td>
										<a href="<?php echo base_url();?>debitcard-transactions-detail/<?php echo $trxs['TxId']?>/debit" class="view_btn"><img src="<?php echo base_url();?>assets/userpanel/images/view.svg" alt=""> View</a>
			
											
									</td>
								</tr>
								<?php $i++; } }else{ ?>	
								<tr>
									<td colspan="8" style="text-align:center;">No Transactions Available</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<?php 									
						if(!empty($transaction['data']))
						{
							?>
						<div class="controls-below-table">
							<div class="table-records-pages">
								<ul class="pager">
									<?php if($transaction['page_number'] == 1){?>
										<li><a href="<?php echo base_url().'debitcard-transactions-list'; ?>" disabled><i class="icon-left-thin"></i> First</a></li>
									<?php }else { 
										$prev = $transaction['page_number']- 1;
									?>
										<li><a href="<?php echo base_url().'debitcard-transactions-list?page='.$prev; ?>"><i class="icon-left-thin"></i> Previous</a></li>	
									<?php } ?>
									<?php 
										
										if($pages < $transaction['page_number']){
									?>
										<li><a href="<?php echo base_url().'debitcard-transactions-list?page='.$transaction['page_number']; ?>">Last Page <i class="icon-right-thin"></i></a></li>
									<?php }else{
										$next = $transaction['page_number'] + 1;
									?>
										<li><a href="<?php echo base_url().'debitcard-transactions-list?page='.$next; ?>">Next <i class="icon-right-thin"></i></a></li>
									<?php } ?>
								</ul>
							</div>
					  </div>
					  <?php  } ?>	
                </div>
            </div>
        </div>

  <!-- /.content-wrapper -->
    <?php echo $this->endSection()?>