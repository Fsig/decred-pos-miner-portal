<?php
/**
 * 
 * This API will interact with the Decred DCRCTL program.
 *  
 * */
class API {
	private static $dcrd_certificate;
	private static $wallet_certificate;
	private static $base_cmd;
	private static $end_cmd;

	/**
	 * Setup variables based on the config file.
	 * */
	public static function initialise() {
		if(file_exists(DCRDCERT)) $dcrdcert = DCRDCERT; else $dcrdcert = "." . DCRDCERT;
		if(file_exists(WALLETCERT)) $walletcert = WALLETCERT; else $walletcert = "." . WALLETCERT;
		
		self::$dcrd_certificate = " --rpccert='" . $dcrdcert . "' ";
		self::$wallet_certificate = " --rpccert='" . $walletcert . "' ";
		self::$base_cmd = DCRCTLLOCATION . " -u " . USERNAME . " -P '" . PASSWORD . "'";
		self::$end_cmd = " 2>&1";
    }
	
	/**
	 * Get block count
	 * */
	public static function getBlockCount() {
		return self::execute(self::$base_cmd . self::$dcrd_certificate . "getblockcount" . self::$end_cmd);
	}
	
	/**
	 * Get difficulty
	 * */
	public static function getDifficulty() {
		return self::execute(self::$base_cmd . self::$dcrd_certificate . "getdifficulty" . self::$end_cmd);
	}
	
	/**
	 * Get stake difficulty
	 * */
	public static function getStakeDifficulty() {
		return json_decode(self::execute(self::$base_cmd . self::$dcrd_certificate . "getstakedifficulty" . self::$end_cmd))->{'difficulty'};
	}
	 
	 /**
	  * Get relay fee
	  * */
	public static function getRelayFee() {
		return json_decode(self::execute(self::$base_cmd . self::$dcrd_certificate . "getinfo" . self::$end_cmd))->{'relayfee'};
	}
	
	/**
	 * Get balance
	 * */
	public static function getBalance() {
		return self::execute(self::$base_cmd . self::$wallet_certificate . "--wallet getbalance" . self::$end_cmd);
	}
	
	/**
	 * Get balance all
	 * */
	public static function getBalanceAll() {
		return self::execute(self::$base_cmd . self::$wallet_certificate . "--wallet getbalance default 0 all" . self::$end_cmd);
	}
	
	/**
	 * Get ticket count
	 * */
	public static function getTickets() {
		return json_decode(self::execute(self::$base_cmd . self::$wallet_certificate . "--wallet gettickets 1" . self::$end_cmd))->{'hashes'};
	}
	
	/**
	 * Get tickets
	 * */
	public static function getTicketCount() {
		return count(json_decode(self::execute(self::$base_cmd . self::$wallet_certificate . "--wallet gettickets 1" . self::$end_cmd))->{'hashes'});
	}
	
	/**
	 * Get transaction
	 * */
	public static function getTransaction($transhash) {
		return self::execute(self::$base_cmd . self::$wallet_certificate . "--wallet gettransaction " . $transhash . self::$end_cmd);
	}
	
	/**
	 * Execute the specified command.
	 * */
	private static function execute($command) {
		return shell_exec($command);
	}
}

?>
