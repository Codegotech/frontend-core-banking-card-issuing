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
		$param=array();
		//pr($transaction);
		$pages = round($transaction['num_rows'] / $transaction['per_page']);	
	
		
	?>
 <!-- Content Wrapper. Contains page content -->

        <div class="transition_history middle_content">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo base_url()?>dashboard">Home</a></li>
                    <li>Transactions</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">Transactions History</h2>
            <div class="table_info">
            	<div class="table-responsive">
                	<table class="table caption-top">
                    	<caption>
                        	<div class="cap_inn">
                                <!--div class="table_search">
                                    <a href="#" class="search_link"><i class="fa fa-search"></i></a>
                                    <input type="text" class="form-control" placeholder="Search">
                                </div-->
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
                                    <a href="<?php echo base_url();?>clear-transactions" class="table_btns light_green">Clear</a>
                                    
                                </div>
								</form>
                            </div>
                        </caption>
                        <thead>
                        	<tr>
							
                            	<th>#</th>
                                <th>Wallet</th>
                                <th class="types">Type</th>
                                <th>Account</th>
                                <th>Fee</th>
                                <th>Total</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="views">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php 
									if(!empty($transaction['trx']))
									{
										$i=1;
										foreach($transaction['trx'] as $trxs)
										{
												$iconimg="icon_in";
												if($trxs['type'] == 'debit'){
													$iconimg="icon_out";
												}
									?>
                        	<tr>
                            	<td><b><?php echo $i; ?></b></td>
                                <td><b><?php echo ucfirst($trxs['label']); ?></b></td>
                                <td>
									<span class="type_tag">
										<img src="<?php echo base_url();?>assets/userpanel/images/<?php echo $iconimg;  ?>.svg" alt=""> <?php echo ucfirst($trxs['type'])?>
									</span>
								</td>
                                <td><?php if(!empty($trxs['acc_number'])){ echo $trxs['acc_number']; }else{ echo '--'; }?></td>
                                <td><?php echo $trxs['symbol'].floatvalue($trxs['fees']); ?></td>
                                <td><?php echo $trxs['symbol'].floatvalue($trxs['total']); ?></td>
                                <td><?php echo $trxs['description']; ?></td>
                                <td><span class="status_tag"><img src="<?php echo base_url();?>assets/userpanel/images/tickmark.svg" alt=""> <?php echo $trxs['status']; ?></span></td>
                                <td><?php echo date('d M Y H:i',strtotime($trxs['created'])); ?></td>
                                <td>
									<a href="<?php echo base_url();?>transaction-detail/<?php echo $trxs['unique_id']?>" class="view_btn"><img src="<?php echo base_url();?>assets/userpanel/images/view.svg" alt=""> View</a>
									<?php if($trxs['status'] == 'Under-Review'){ ?>
											<a href="<?php echo base_url();?>payment-review/<?php echo $trxs['unique_id']?>" class="view_btn" style="margin-top:5px;" ><img src="<?php echo base_url();?>assets/userpanel/images/tickmark.svg" alt="">Review&nbsp;&nbsp;</a>
										<?php } ?>
										
								</td>
                            </tr>
							<?php $i++; } } ?>	
                        </tbody>

                    </table>
												<div class="controls-below-table">
									<div class="table-records-pages">
										<ul class="pager">
											<?php if($transaction['page_number'] == 1){?>
												<li><a href="<?php echo base_url().'transactions'; ?>" disabled><i class="icon-left-thin"></i> First</a></li>
											<?php }else { 
												$prev = $transaction['page_number']- 1;
											?>
												<li><a href="<?php echo base_url().'transactions?page='.$prev; ?>"><i class="icon-left-thin"></i> Previous</a></li>	
											<?php } ?>
											<?php 
												
												if($pages < $transaction['page_number']){
											?>
												<li><a href="<?php echo base_url().'transactions?page='.$transaction['page_number']; ?>">Last Page <i class="icon-right-thin"></i></a></li>
											<?php }else{
												$next = $transaction['page_number'] + 1;
											?>
												<li><a href="<?php echo base_url().'transactions?page='.$next; ?>">Next <i class="icon-right-thin"></i></a></li>
											<?php } ?>
										</ul>
									</div>
							  </div>
                </div>
            </div>
        </div>
  <?php echo $this->endSection()?>