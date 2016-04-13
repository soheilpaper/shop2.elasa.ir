<?php

class BlockUserOnline extends Module {
	private $_html = '';
	private $_postErrors = array();

	function __construct(){
		$this->name = 'blockuseronline';
		$this->tab = 'User Module';
		$this->version = 1.0;
		// Update by Bayu Prawira
		// bywebs.blogspot.com

		parent::__construct(); // The parent construct is required for translations

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Block User Online');
		$this->description = $this->l('Displays total user online in you home page');
	}

	public function installDb(){
		Db::getInstance()->ExecuteS('
		CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'total_hits` (
		  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `ip` VARCHAR(20) NOT NULL,
		  `time` VARCHAR(20) NOT NULL
		);');
		
		Db::getInstance()->ExecuteS('
		CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'today_hits` (
		  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `ip` VARCHAR(20) NOT NULL,
		  `time` VARCHAR(20) NOT NULL
		);');
		
		Db::getInstance()->ExecuteS('
		CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'today_online` (
		  `timestamp` INT(15) NOT NULL DEFAULT 0 PRIMARY KEY,
		  `ip` VARCHAR(40) NOT NULL,
		  `path` VARCHAR(100) NOT NULL,
		KEY ip(ip));');
		
    	return true;
	}

	function install(){
		if (!parent::install())
			return false;
		if (!$this->registerHook('leftColumn'))
			return false;
    	if (!$this->installDB())
        	return false;
		return true;
	}
	
    public function uninstall(){
		if(!parent::uninstall() ||
		   !$this->uninstallDB())
		  return false;
		return true;
  	}

  	private function uninstallDb(){
		Db::getInstance()->ExecuteS('DROP TABLE `'._DB_PREFIX_.'total_hits`');
		Db::getInstance()->ExecuteS('DROP TABLE `'._DB_PREFIX_.'today_hits`');
		Db::getInstance()->ExecuteS('DROP TABLE `'._DB_PREFIX_.'today_online`');
		return true;
  	}

    function hookLeftColumn($params){
        global $smarty;

		if (@getenv("HTTP_X_FORWARDED_FOR")){
			$ip = @getenv("HTTP_X_FORWARDED_FOR");
		} else{
			$ip = @getenv("REMOTE_ADDR");
		}
		
		if (strstr( $ip, "," ) ){
			$elvalaszto = ",";
			$client_ip = strtok ($ip, $elvalaszto);
		} else { 
			$client_ip = $ip; 
		}

		$to_secs = 600;
		$server_time = date("U");
		$timeout = $server_time - $to_secs;
		$datum = date("d.m.Y");
		$user = 0;
		$todayhits = 0;
		$totalhits = 0;

		$sql = "SELECT * FROM "._DB_PREFIX_."today_online WHERE ip = '".$client_ip."'";
		if ($results = Db::getInstance()->ExecuteS($sql)){
    		foreach ($results as $row){
				$onlip1 = $row['ip'];
			}
		}

		if($onlip1 !== $client_ip) {
			Db::getInstance()->insert('today_online', array(
				'timestamp' => pSQL($server_time),
				'ip' => pSQL($client_ip),
				'path' => pSQL($PHP_SELF)
			));
		}

		Db::getInstance()->delete("today_online", "timestamp < '".$timeout."' AND ip != '".$client_ip."'");

		$query31 = "SELECT DISTINCT ip FROM "._DB_PREFIX_."today_online WHERE path='$PHP_SELF'";
		if ($result1 = Db::getInstance()->ExecuteS($query31)){
			$user = count($result1);
		}

		Db::getInstance()->delete("today_hits", "time < '".$datum."'");

		$kapcsolodas2 = "SELECT * FROM "._DB_PREFIX_."today_hits";
		if ($results = Db::getInstance()->ExecuteS($kapcsolodas2)){
			foreach ($results as $row){
				$statip2 = $row['ip'];
				$statdate2 = $row['time'];
			}
		}

		if($statip2 !== $client_ip) {
			Db::getInstance()->insert('today_hits', array(
				'ip' => pSQL($client_ip),
				'time' => pSQL($datum)
			));
		}

		$todayk2 = "SELECT DISTINCT ip FROM "._DB_PREFIX_."today_hits";
		if ($todayk22 = Db::getInstance()->ExecuteS($todayk2)){
			$todayhits = count($todayk22);
		}

		$kapcsolodas3 = "SELECT * FROM "._DB_PREFIX_."total_hits WHERE ip = '$client_ip'";
		if ($results = Db::getInstance()->ExecuteS($kapcsolodas3)){
			foreach ($results as $row){
				$statip3 = $row['ip'];
				$statdate3 = $row['time'];
			}
		}

		if($statip3 !== $client_ip) {
			Db::getInstance()->insert('total_hits', array(
				'ip' => pSQL($client_ip),
				'time' => pSQL($datum)
			));
		}

		$todayko3 = "SELECT * FROM "._DB_PREFIX_."total_hits";
		if ($todayko23 = Db::getInstance()->ExecuteS($todayko3)){
			$totalhits = count($todayko23);
		}


        $smarty->assign('yourip',$ip);
        $smarty->assign('useronline',$user);
        $smarty->assign('total',$totalhits);
        $smarty->assign('today',$todayhits);


		return $this->display(__FILE__, 'blockuseronline.tpl');
	}

	function hookRightColumn($params)
	{
		return $this->hookLeftColumn($params);
	}

}