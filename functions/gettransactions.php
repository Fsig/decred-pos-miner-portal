<?php
date_default_timezone_set('Australia/Brisbane');
header('Content-type: text/html; charset=UTF-8');
include_once("../includes/config.inc.php");
include_once("../includes/core.inc.php");
include_once("./api.php");

//Initialise the API
API::initialise();
$tickets = API::getTickets();
$transactions = array();
$total_ticket_fees = 0.00;

//Fill array with transactions
foreach($tickets as $ticket){ 
	$trans = API::getTransaction($ticket);
	$total_ticket_fees += $trans->{'fee'};
	array_push($transactions,$trans);
}

usort($transactions,"sortByTime");
?>

						<table>
							<thead>
								<tr>
									<th>Hash</th>
									<th>Fee</th>
									<th>Time</th>
								</tr>
							</thead>
							
							<tbody id="transactions">
							<?php foreach($transactions as $transaction){ ?>
								
								<tr>
									<td>
										<a target="_blank" href="https://mainnet.decred.org/tx/<?php echo $transaction->{'txid'}; ?>"><?php echo $transaction->{'txid'}; ?></a>
									</td>
									
									<td><?php echo $transaction->{'fee'}; ?></td>
									<td><?php echo date("Y-m-d H:i:s A",$transaction->{'time'}); ?></td>
								</tr>
							<?php } ?>
							</tbody>

							<tfoot>
								<td>Totals:</td>
								<td><?php echo $total_ticket_fees; ?></td>
								<td></td>
							</tfoot>
							
						</table>
