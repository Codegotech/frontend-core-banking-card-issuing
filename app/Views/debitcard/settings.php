<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>

<?php echo $this->section("body")?>
<style>
.act{
	border: 1px solid #cecece;
	padding: 8px;
	border-radius: 15px;
}
.ml{margin-left:10px;}
</style>
        <div class="transition_history middle_content" style="padding-left:17px;">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard">Home</a></li>
					<li><a href="<?php echo BASE_URL; ?>debitcard">Debit Cards</a></li>
                    <li>Debit Cards</li>
                </ul>
            </div>            
            <!-- Title -->
            <h2 class="title">Debit Card Settings<a href="<?php echo BASE_URL; ?>debitcard" class="btn btn-primary btn-block" style="float: right;"><span class="btn-label-icon left fa fa-arrow-left"></span> Back</a></h2>
			 <?php if (!empty($validation)) : ?>
                    <div class="alert alert-warning">
                        <?=  $validation; ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
				 <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
			<div class="wallet_bottom" style="padding:30px 0px 5px;">
			  <form class="form_info" action="<?php echo base_url(); ?>debitcard-settings" method="post" id="loginform">
            <div class="table_info card_tran">
            	<div class="table-responsive">
                	<table class="table caption-top">
                        <thead>
                        	<tr>
                            	<th style="width:5%"><div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input form-check-input" id="flexCheckIndeterminate" >
										</div></th>
                            	<th class="types">Coin</th>
                            	<th class="types">Symbol</th>
                            	
                            </tr>
                        </thead>
                        <tbody>
						<?php 
							if(!empty($coins))
							{
								
								
								foreach($coins as $coin)
								{
																
								?>
								<tr>
									<td>
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input form-check-input" name="coins[]" <?php if($coin['is_selected']==1){ echo 'checked';}?> value="<?php echo $coin['id']?>">
										</div>
									</td>
									 <td>
										<div class="d-flex align-items-center"><img class="rounded-circle" src="<?php echo $coin['image']?>" width="30"><span class="ml"><?php echo $coin['title']?></span></div>
									</td>
									 <td>
										<?php echo $coin['currency_symbol']?>
									</td>
								
								
								</tr>	                        	
								<?php  }}else{?>
								<tr><td colspan="4">No Coins</td></tr>
							<?php } ?>
                        </tbody>
                    </table>
                </div>
				 <div class="col-12">
                    <button type="submit" class="btn btn-gradient">Submit</button>
                 </div>
            </div>
            </form>
        </div>		
			
			
	 
  <?php echo $this->endSection()?>
    <?php echo $this->section("scripts");?>
<script>
document.getElementById('flexCheckIndeterminate').addEventListener('click', e => {
  document.querySelectorAll('.form-check-input').forEach(checkbox => {
    checkbox.checked = e.target.checked
  })
})
</script>
  <?php echo $this->endSection()?>
  


