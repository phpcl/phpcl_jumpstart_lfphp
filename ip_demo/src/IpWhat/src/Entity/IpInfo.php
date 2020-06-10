<?php
namespace IpWhat\Entity;

class IpInfo
{
    public $errFlag = FALSE;
    public $errMsg  = '';
    public $ip      = '';
    public $iso2    = '';
    public $iso3    = '';
    public $country = '';    
    public function __construct(string $ip = '')
    {
		$this->ip = $ip;
	}
}
