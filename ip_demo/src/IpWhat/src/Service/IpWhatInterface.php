<?php
namespace IpWhat\Service;

use IpWhat\Entity\IpInfo;

interface IpWhatInterface
{
	/**
	 * Returns IP address of client making request
	 * 
	 * @return IpWhat\Entity\IpInfo $ipInfo instance
	 */
	public function getMyIp() : IpInfo;
	/**
	 * Returns country information from given IP address
	 * 
	 * @param string $ip == IP address
	 * @return IpWhat\Entity\IpInfo $ipInfo instance
	 */
	public function getCountryForIp(string $ip) : IpInfo;
}
