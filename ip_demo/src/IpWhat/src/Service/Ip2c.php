<?php
namespace IpWhat\Service;

use IpWhat\Entity\IpInfo;

class Ip2c implements IpWhatInterface
{

	const API_URL         = 'http://ip2c.org/';
	const ERROR_NO_IP     = 'ERROR: unable to obtain your IP address';
	const ERROR_API       = 'ERROR: unable to connect to API source';
	const ERROR_NOT_FOUND = 'ERROR: IP address not found in database';

	/**
	 * Returns IP address of client making request
	 * 
	 * @return IpWhat\Entity\IpInfo $ipInfo instance
	 */
	public function getMyIp() : IpInfo
	{
		if (isset($_SERVER['REMOTE_ADDR']) && $myIp = $_SERVER['REMOTE_ADDR']) {
			$info = new IpInfo(strip_tags($myIp));
		} else {
			$info = new IpInfo($ip);
			$info->errFlag = TRUE;
			$info->errMsg  = self::ERROR_NO_IP;
		}
		return $info;
	}
	/**
	 * Returns country information from given IP address
	 * 
	 * @param string $ip == IP address
	 * @return IpWhat\Entity\IpInfo $ipInfo instance
	 */
	public function getCountryForIp(string $ip) : IpInfo
	{	
		$ip   = strip_tags($ip);
		$call = self::API_URL . $ip;
		$s    = file_get_contents($call);
		$info = new IpInfo($ip);
		switch($s[0])
		{
		  case '0':
			$info->errFlag = TRUE;
			$info->errMsg  = self::ERROR_API;
			error_log(__METHOD__ . ':' . self::ERROR_API . ' from API call: ' . $call);
			break;
		  case '1':
			$reply = explode(';',$s);
			$info->errFlag = FALSE;
			$info->iso2    = $reply[1];
			$info->iso3    = $reply[2];
			$info->country = $reply[3];
			break;
		  case '2':
			$info->errFlag = TRUE;
			$info->errMsg  = self::ERROR_NOT_FOUND;
			break;
		}
		return $info;
	}
}
