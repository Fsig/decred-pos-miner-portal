<?php
//Get values to save from multiple calls
$balance = API::getBalance();
$balance_all = API::getBalanceAll();
$ticket_count = API::getTicketCount();
$walletfee = API::getWalletFee();

$live = API::getStakeInfo()->{'live'};
$voted = API::getStakeInfo()->{'voted'};
$missed = API::getStakeInfo()->{'missed'};

$revoked = API::getStakeInfo()->{'revoked'};
$proportionmissed = API::getStakeInfo()->{'proportionmissed'};
$totalsubsidy = API::getStakeInfo()->{'totalsubsidy'};

?>		
		    
		<section class="light">
			<div class="container">
				<div class="raw-stat single-box">
					<h2>Balance</h2>
							
					<div class="stat-wrapper">
						<h5><?php echo $balance; ?></h5>
						<span class="normal-font">Available</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo ($balance_all - $balance); ?></h5>
						<span class="normal-font">Locked</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $balance_all; ?></h5>
						<span class="normal-font">Total</span>
					</div>

					<div class="cb"></div>
				</div>
				
				<div class="raw-stat single-box">
					<h2>Info</h2>					
					<div class="stat-wrapper">
						<h5><?php echo $live; ?></h5>
						<span class="normal-font">Live</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $voted ?></h5>
						<span class="normal-font">Voted</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $missed; ?></h5>
						<span class="normal-font">Missed</span>
					</div>
					
					<div class="cb"></div>
					<br/>
					<br/>
					
					<div class="stat-wrapper">
						<h5><?php echo $revoked; ?></h5>
						<span class="normal-font">Revoked</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $proportionmissed; ?></h5>
						<span class="normal-font">Missed Subsidy</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $totalsubsidy; ?></h5>
						<span class="normal-font">Total Subsidy</span>
					</div>

					<div class="cb"></div>
				</div>
				
				<div class="raw-stat single-box">
					<h2>Tickets</h2>
					<label for="show-tickets" class="show-tickets" title="Show tickets"></label>
					<input type="checkbox" id="show-tickets" name="show-tickets"/>
					
					<div class="stat-wrapper">
						<h5><?php echo $ticket_count; ?></h5>
						<span class="normal-font">Count</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo ($ticket_count * $walletfee); ?></h5>
						<span class="normal-font">Fees</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $ticket_count > 0  ? ($ticket_count * 1.844216445) : "0"; ?></h5>
						<span class="normal-font">Estimated worth</span>
					</div>

					<div class="cb"></div>
					
					<div id="transactions" class="ticket-wrapper">
						
					</div>
				</div>
			</div>
		</section>
		
