<?php

namespace StarterKit\SQL;
use PDO;

class SimplePDO
{
	private $pdo = NULL;
	private static $instance = NULL;

	private static $dbName = NULL;
	private static $host   = NULL;
	private static $port   = '3306';
	private static $dbUser = NULL;
	private static $dbPwd  = NULL;

	private function __construct($dbName_ = NULL, $host_ = NULL, $port_ = NULL, $dbUser_ = NULL, $dbPwd_ = NULL)
	{
		self::$dbName = $dbName_;
		self::$host   = $host_;
		self::$port   = $port_;
		self::$dbUser = $dbUser_;
		self::$dbPwd  = $dbPwd_;

		$this->pdo = new PDO('mysql:host='.self::$host.';port='.self::$port.';dbname='.self::$dbName.';charset=utf8', self::$dbUser, self::$dbPwd);
		$this->pdo->exec('SET NAMES utf8');
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function __call($method_, $args_)
	{
		return call_user_func_array(array(self::getInstance()->pdo, $method_), $args_);
	}

	public function __clone()
	{
		trigger_error('Cloning not allowed', E_USER_ERROR);
	}

	public static function getInstance($dbName_ = NULL, $host_ = NULL, $port_ = NULL, $dbUser_ = NULL, $dbPwd_ = NULL)
	{
		if (is_null(self::$instance) || (!is_null($dbName_) && $dbName_ != self::$dbName) || (!is_null($host_) && $host_ != self::$host) || (!is_null($port_) && $port_ != self::$port) || (!is_null($dbUser_) && $dbUser_ != self::$dbUser)) {
			self::$instance = new SimplePDO($dbName_, $host_, $port_, $dbUser_, $dbPwd_);
		}
		return self::$instance;
	}

	public function getReadableError($pdoStatement_, $infos_ = NULL)
	{
		$arrErrorInfo = $pdoStatement_->errorInfo();

		$log = $infos_."\n";
		$log .= 'SQLSTATE : '.$arrErrorInfo[0]."\n";
		$log .= 'Error code : '.$arrErrorInfo[1]."\n";
		$log .= 'Message : '.$arrErrorInfo[2]."\n";
		$log .= 'Query : '.$pdoStatement_->queryString."\n";

		return $log;
	}
}
