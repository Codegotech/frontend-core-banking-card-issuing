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
.table_info {
	font-size:15px;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
	<?php
		$pages = round($transaction['total_page']);	
	?>
   
        <div class="transition_history middle_content">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                     <li><a href="<?php echo base_url()?>dashboard">Home</a></li>
                     <li><a href="<?php echo base_url()?>debitcard">Debit Cards</a></li>
                    <li>Debitcard Transactions</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">Debitcard Transactions</h2>
            <div class="table_info card_tran">
            	<div class="table-responsive">
                	<table class="table caption-top" id="trans_tbl">
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
									
									if(!empty($transactions))
									{
										$i=1;
										foreach($transactions as $trxs)
										{
											
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
												
											}else if($type == "credit")
											{
												$tcol = 'green';
												$imgname="icon_in";
											}
											
									?>
                        	<tr>
                            	<!--td><span class="type_tag <?php echo $tcol; ?>"><img src="<?php echo base_url();?>assets/userpanel/images/<?php echo $imgname ?>.svg" alt=""> <?php echo $type ?></span></td-->
                                <td><?php echo $trxs['trx_type']; ?></td>
                                <td><?php echo $trxs['TxId']; ?></td>
                                <td><?php echo floatvalue($trxs['total_amount']).' '.$trxs['TxnCountry']; ?></td>
                                <td><?php echo $trxs['De043']; ?></td>
                                <td><?php echo date('d M Y H:i',strtotime($trxs['created'])); ?></td>
                            </tr>
							<?php $i++; } } ?>	
                        </tbody>
                    </table>
								<div class="controls-below-table">

						  </div>
                </div>
            </div>
        </div>
  <?php echo $this->endSection()?>
  
<?php echo $this->section("scripts");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#trans_tbl').DataTable();
} );
</script>
<?php echo $this->endSection()?>
	
	