
		 
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="<?php echo BASE_URL; ?>dashboard"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon1.svg" alt=""> <span>Dashboard</span></a></li>
		<li class="treeview">
          <a href="#"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon3.svg" alt=""> <span>Transactions</span> <i class="fa fa-angle-down"></i></a>
          <ul class="treeview-menu" style="width:233px;">
            <li><a href="<?php echo BASE_URL; ?>transactions">Wallet Transactions</a></li>
            
          </ul>
        </li>
        <li class=""><a href="<?php echo BASE_URL; ?>giftcards"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon2.svg" alt=""> <span>Giftcards</span></a></li>
	
		<li class="treeview"><a href="#"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon6.svg" alt=""> <span>Prepaid Cards</span<i class="fa fa-angle-down"></i></a>
		<ul class="treeview-menu" style="width:233px;">
            <li><a href="<?php echo BASE_URL; ?>prepaidcard">Prepaid Cards List</a></li>
            <li><a href="<?php echo BASE_URL; ?>prepaid-transactions-list">Prepaid Transactions</a></li>
          </ul>
		</li>
		<li class="treeview"><a href="#"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon4.svg" alt=""> <span>Debit Cards</span<i class="fa fa-angle-down"></i></a>
		<ul class="treeview-menu" style="width:233px;">
            <li><a href="<?php echo BASE_URL; ?>debitcard">Debit Cards List</a></li>
            <li><a href="<?php echo BASE_URL; ?>debitcard-transactions-list">Outgoing Transactions</a></li>
            <li><a href="<?php echo BASE_URL; ?>debitcard-refunds-completed">Completed Refund Transactions</a></li>
            <li><a href="<?php echo BASE_URL; ?>debitcard-refunds-pending">Refund Pending Transactions</a></li>
          </ul>
		</li>
		<li class=""><a href="<?php echo BASE_URL; ?>beneficiaries"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon6.svg" alt=""> <span>Beneficiary </span></a></li>
		<li class=""><a href="<?php echo BASE_URL; ?>crypto"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon5.svg" alt=""> <span>Crypto Wallet</span></a></li>
		
        <li><a href="<?php echo BASE_URL; ?>logout"><img src="<?php echo BASE_URL; ?>assets/usertheme/images/dash_icon8.svg" alt=""> <span>Log Out</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>