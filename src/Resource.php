<?php

namespace Xillion\Core;

use Xillion\Core\Exception\InvalidXrnException;

class Resource
{
    private $partition;
    private $service;
    private $region;
    private $account;
    private $resourceType;
    private $resourceKey;
    
    public function __construct($xrn = null)
    {
        if ($xrn) {
            $this->parseXrn($xrn);
        }
    }
    
    public function parseXrn($xrn)
    {
        $part = explode(':', $xrn);
        
        if ((count($part)<6) || (count($part)>7)) {
            throw new InvalidXrnException('Should contain either 6 or 7 sections: ' . $xrn);
        }
        
        if ($part[0] != 'xrn') {
            throw new InvalidXrnException('Must start with `xrn`: ' . $xrn);
        }
        
        
        $this->partition = $part[1];
        $this->service = $part[2];
        $this->region = $part[3];
        $this->account = $part[4];
        
        $resourcePart = explode('/', $part[5]);
        if (count($resourcePart)==1) {
            if (isset($part[6])) {
                $this->resourceType = $part[5];
                $this->resourceKey = $part[6];
            } else {
                $this->resourceType = null;
                $this->resourceKey = $part[5];
            }
        } elseif (count($resourcePart)==2) {
            $this->resourceType = $resourcePart[0];
            $this->resourceKey = $resourcePart[1];
        } else {
            throw new InvalidXrnException($xrn);
        }
        
    }
    
    public function getPartition()
    {
        return $this->partition;
    }
    
    public function setPartition($partition)
    {
        $this->partition = $partition;
        return $this;
    }
    
    public function getService()
    {
        return $this->service;
    }
    
    public function setService($service)
    {
        $this->service = $service;
        return $this;
    }
    
    public function getRegion()
    {
        return $this->region;
    }
    
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }
    
    public function getAccount()
    {
        return $this->account;
    }
    
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }
    
    public function getResourceType()
    {
        return $this->resourceType;
    }
    
    public function setResourceType($resourceType)
    {
        $this->resourceType = $resourceType;
        return $this;
    }
    
    public function getResourceKey()
    {
        return $this->resourceKey;
    }
    
    public function setResourceKey($resourceKey)
    {
        $this->resourceKey = $resourceKey;
        return $this;
    }
    
    public function __toString()
    {
        $o = 'xrn:';
        $o .= $this->partition . ':';
        $o .= $this->service . ':';
        $o .= $this->region . ':';
        $o .= $this->account . ':';
        $o .= $this->resourceType . '/';
        $o .= $this->resourceKey;
        return $o;
    }
}
