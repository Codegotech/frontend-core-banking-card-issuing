<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>


<?php echo $this->section("body")?>


        <div class="transition_history middle_content" style="padding-left:17px;">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>hs-giftcards">HS Giftcards</a></li>
                    <li>HS Giftcards Detail</li>
                </ul>
            </div>
            
            <!-- Title -->
            <h2 class="title">HS Giftcard Detail<a  onclick="history.back()" class="btn btn-danger pull-right" >Back</a></h2>
            <div class="table_info card_tran">
            	<div class="table-responsive">
                	<table class="table caption-top">
                       
                        <tbody>
							<tr>
								<td>Card Number</td>
								<td><?php isset($card_number) ? $cnumber = $card_number : $cnumber= ''; echo $cnumber;?></td>
							</tr>
                        	<tr>
								<td>Expiry Date</td>
								<td><?php isset($expiry_date) ? $exp_date = $expiry_date : $exp_date= ''; echo $exp_date;?></td>
							</tr>
							<tr>
								<td>CVV</td>
								<td><?php isset($cvv) ? $cvv_no = $cvv : $cvv_no= '';  echo $cvv_no;?></td>
							</tr>
							<tr>
								<td>Balance</td>
								<td><?php isset($balance) ? $bal = $balance : $bal= '0.00'; echo $bal;?></td>
							</tr>
                            <tr>
								<td>Email</td>
								<td><?php echo $giftcard['email'];?></td>
							</tr>  
							<tr>
								<td>Email</td>
								<td><?php echo $giftcard['phone'];?></td>
							</tr>
							<tr>
								<td>Status</td>
								<td><?php if($giftcard['status']==1){?>
									<span class="type_tag"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/icon_outin.svg" alt=""> Active</span>
								<?php }else{?>
								<span class="type_tag red"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/icon_in.svg" alt=""> Blocked</span>
									<?php }?>
								</td>
							</tr>
							<tr>
								<td>Created</td>
								<td><?php echo $giftcard['created'];?></td>
							</tr>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

  <?php echo $this->endSection()?>

  


