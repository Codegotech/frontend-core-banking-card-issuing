<?php echo $this->extend("Views\userlayout") ?>

<?php echo $this->section("title")?>

<?php echo $this->endSection()?>

<?php echo $this->section("body")?>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<style>
.act{
	border: 1px solid #cecece;
	padding: 8px;
	border-radius: 15px;
}
</style>
        <div class="transition_history middle_content" style="padding-left:17px;">
            <!-- Breadcrumb -->
            <div class="breadcrumb_info">
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>dashboard">Home</a></li>
					<li><a href="<?php echo BASE_URL; ?>debitcard">Debit Cards</a></li>
                    <li>Debit Card Portfolio</li>
                </ul>
            </div>            
            <!-- Title -->
            <h2 class="title">Debit Cards<a href="<?php echo BASE_URL; ?>debitcard" class="btn btn-primary btn-block" style="float: right;"><span class="btn-label-icon left fa fa-arrow-left"></span> Back</a></h2>
			<?php if (session()->getFlashdata('msg')) : ?>
				<div class="alert alert-warning">
					<?= session()->getFlashdata('msg') ?>
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
			
			
			<div class="row">
			<div class="portfolio_balance">
							<form name="sort_form" method="POST" action="">
							<input type="hidden" name="sorted" id="sorted" value="">
							
                        	<div class="pb_top">
                            	<div class="row align-items-end">
                                	<div class="col-lg-6 col-md-6 col-sm-6">
                                    	<label>&nbsp;</label>
                                        <strong>Sort Currency</strong>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 text-sm-end">
									<button type="submit" name="submit" value="submit" class="btn btn-bordered">Submit</button>
                                  
                                    </div>
                                </div>
                            </div>
							</form>
                            <div class="pb_bottom connectedSortable" id="sortable" >
							<?php 
							
							if(!empty($debitcard['coin']))
							{
								foreach($debitcard['coin'] as $coin)
								{
								
								isset($coin['balance']) ? $balance = $coin['balance'] : $balance = '€ 0.00';	
								isset($coin['title']) ? $title = $coin['title'] : $title = '';	
								isset($coin['crypto_balance']) ? $crypto_balance = $coin['crypto_balance'] : $crypto_balance = '';	
								isset($coin['currency_name']) ? $currency_name = $coin['currency_name'] : $currency_name = '';	
								isset($coin['image']) ? $image = $coin['image'] : $image = '';										
								isset($coin['currency_id']) ? $currency_id = $coin['currency_id'] : $currency_id = 0;										
								?>
                            	<div class="mov" id="<?php echo $currency_id?>" >
                            	
                                    <i class="icon" style="background:#d0e4ff;"><img src="<?php echo $image?>" alt=""></i>
                                    <div class="details">
                                        <p><?php echo $title?> <small><?php echo $currency_name?></small></p>
                                        <p class="text-end align-self-end"><?php echo $balance?>
										<br>
										<small class="text-end align-self-end"><?php echo $crypto_balance?></small>
										</p>
                                        
                                    </div>
                       
                                </div>
							<?php }} ?>
                            </div>
                        </div>
			</div>			
        </div>		


  <?php echo $this->endSection()?>
    <?php echo $this->section("scripts");?>
<script>
$(document).ready(function (){
	$( "#sortable").sortable({
    connectWith: ".connectedSortable",
    stop: function(event, ui) {
        $('.connectedSortable').each(function() {
            result = $(this).sortable("toArray");
            //alert($(this).sortable("toArray"));
			data='';
            $(this).find(".mov").each(function(){
                data += $(this).attr('id') + ",";
            });
            $("#sorted").val(data);
        });
    }
});
});
</script>
  <?php echo $this->endSection()?>
  


