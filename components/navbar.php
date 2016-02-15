<?php

?>
		
		<nav class="mainnav">
			<div class="mainnav-wrapper">	
						
				<div class="nav-block" title="Block count">
					<?php echo API::getBlockCount(); ?>
				</div>
				
				<div class="nav-ticket" title="Ticket cost">
					<?php echo API::getStakeDifficulty();?> DCR
				</div>
				
			</div>
			
			<!-- Clear floats -->
			<div class="cb"></div>
		</nav>		
