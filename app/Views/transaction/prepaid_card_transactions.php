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
                    <li>PrepaidCard Transactions</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">PrepaidCard Transactions</h2>
            <div class="table_info card_tran">
            	<div class="table-responsive">
                	<table class="table caption-top">
                        <thead>
                        	<tr>
                            	<th class="types">Type</th>
                            	<th>TRXID</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
									<?php 
									if(!empty($transaction['transaction_history']))
									{
										$i=1;
										foreach($transaction['transaction_history'] as $trxs)
										{
											$description = str_replace('Auth:', '', $trxs['description']);
											
											
											if($trxs['amount'] <= 0)
											{
												$icn = 'card_spend_icon';
												$type = 'debit';
											}else{
												$type = 'credit';
												$icn = 'card_load_icon';
											}
											
											$tcol = '';
											$img = '';
											if($type == "debit")
											{
												$tcol = 'red';
												$imgname="icon_out";
												foreach($transaction['tc'] as $tcs)
												{
													if(stristr($description,$tcs['name']))
													{
														$img = $tcs['image'];
													}
												}
												if(empty($img))
												{
													$img = $transaction['icon'][$icn];
												}
											}else if($type == "credit")
											{
												$img = $transaction['icon'][$icn];
												$imgname="icon_in";
											}
											
									?>
                        	<tr>
                            	<td><span class="type_tag <?php echo $tcol; ?>"><img src="<?php echo base_url();?>assets/userpanel/images/<?php echo $imgname ?>.svg" alt=""> <?php echo $type ?></span></td>
                                <td><?php echo $trxs['unique_id']; ?></td>
                                <td><?php echo floatvalue($trxs['amount']).' '.$trxs['currency']; ?></td>
                                <td><?php echo $description; ?></td>
                                <td><?php echo date('d M Y H:i',strtotime($trxs['transaction_date'])); ?></td>
                            </tr>
							<?php $i++; } } ?>	
                        </tbody>
                    </table>
								<div class="controls-below-table">
								<div class="table-records-pages">
									<ul class="pager">
										<?php if($transaction['page_number'] == 1){?>
											<li><a href="<?php echo base_url().'prepaid-transactions-list'; ?>" disabled><i class="icon-left-thin"></i> First</a></li>
										<?php }else { 
											$prev = $transaction['page_number']- 1;
										?>
											<li><a href="<?php echo base_url().'prepaid-transactions-list?page='.$prev; ?>"><i class="icon-left-thin"></i> Previous</a></li>	
										<?php } ?>
										<?php 
											
											if($pages < $transaction['page_number']){
										?>
											<li><a href="<?php echo base_url().'prepaid-transactions-list?page='.$transaction['page_number']; ?>">Last Page <i class="icon-right-thin"></i></a></li>
										<?php }else{
											$next = $transaction['page_number'] + 1;
										?>
											<li><a href="<?php echo base_url().'prepaid-transactions-list?page='.$next; ?>">Next <i class="icon-right-thin"></i></a></li>
										<?php } ?>
									</ul>
								</div>
						  </div>
                </div>
            </div>
        </div>
  
  <?php echo $this->endSection()?>
	
	