<?php
//Get values to save from multiple calls
$balance = API::getBalance();
$balance_all = API::getBalanceAll();
$ticket_count = API::getTicketCount();
$relayfee = API::getRelayFee();
?>		
		    
		<section class="light">
			<div class="container">
				<div class="raw-stat single-box">
					<h1>Balance</h1>
							
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
					<h1>Tickets</h1>
					<label for="show-tickets" class="show-tickets" title="Show tickets"></label>
					<input type="checkbox" id="show-tickets" name="show-tickets"/>
					
					<div class="stat-wrapper">
						<h5><?php echo $ticket_count; ?></h5>
						<span class="normal-font">Count</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo -($ticket_count * $relayfee); ?></h5>
						<span class="normal-font">Fees</span>
					</div>
							
					<div class="stat-wrapper">
						<h5><?php echo $ticket_count > 0  ? ($ticket_count * 3.87174959) : "0"; ?></h5>
						<span class="normal-font">Estimated worth</span>
					</div>

					<div class="cb"></div>
					
					<div id="transactions" class="ticket-wrapper">
						
					</div>
				</div>
			</div>
		</section>
		
