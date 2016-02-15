<?php
//Get values to save from multiple calls
$balance = API::getBalance();
$balance_all = API::getBalanceAll();
$ticket_count = API::getTicketCount();
$relayfee = API::getRelayFee();
$tickets = API::getTickets();
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
						<h5><?php echo ($balance - $balance_all); ?></h5>
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
					<label for="show-tickets" class="show-tickets" title="Show ticket hashes"></label>
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
						<h5><?php echo $ticket_count > 0  ? ($ticket_count * 1.85) : "0"; ?></h5>
						<span class="normal-font">Estimated worth</span>
					</div>

					<div class="cb"></div>
					
					<div class="ticket-wrapper">
						<table>
							<thead>
								<tr>
									<th>Ticket Hashes</th>
								</tr>
							</thead>
							
							<tbody>
							<?php foreach($tickets as $ticket){ ?>
								
								<tr>
									<td>
										<a target="_blank" href="https://mainnet.decred.org/tx/<?php echo $ticket; ?>"><?php echo $ticket; ?></a>
									</td>
								</tr>
							<?php } ?>
							
							</tbody>
							
							<tfoot></tfoot>
						</table>
					</div>
				</div>
			</div>
		</section>
		
