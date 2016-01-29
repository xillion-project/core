<?php

namespace Xillion\Core;

use Xillion\Core\Resource;
use Xillion\Core\Exception\InvalidXrnException;

use PHPUnit_Framework_TestCase;

class ResourceTest extends PHPUnit_Framework_TestCase
{
    public function testResource()
    {
        $resource = new Resource();
        $resource->setPartition('partition-1');
    }
    
    public function testXrnParsing()
    {
        $resource = new Resource('xrn:partition:service:region:account:resourceType/resourceKey');
        
        $this->assertEquals($resource->getPartition(), 'partition');
        $this->assertEquals($resource->getService(), 'service');
        $this->assertEquals($resource->getRegion(), 'region');
        $this->assertEquals($resource->getAccount(), 'account');
        $this->assertEquals($resource->getResourceType(), 'resourceType');
        $this->assertEquals($resource->getResourceKey(), 'resourceKey');


        $resource = new Resource('xrn:partition:service:region:account:t:k');
        $this->assertEquals($resource->getResourceType(), 't');
        $this->assertEquals($resource->getResourceKey(), 'k');


        $resource = new Resource('xrn:partition:service:region:account:x');
        $this->assertEquals($resource->getResourceType(), '');
        $this->assertEquals($resource->getResourceKey(), 'x');
    }
    
    /**
     * @expectedException Xillion\Core\Exception\InvalidXrnException
     */
    public function testInvalidXrnExceptionOnTooManySections()
    {
        $resource = new Resource('xrn:partition:service:region:account:t:k:');
    }

    /**
     * @expectedException Xillion\Core\Exception\InvalidXrnException
     */
    public function testInvalidXrnExceptionOnTooFewSections()
    {
        $resource = new Resource('xrn:partition:service:region:account');
    }
    
    /**
     * @expectedException Xillion\Core\Exception\InvalidXrnException
     */
    public function testInvalidXrnExceptionOnInvalidPrefix()
    {
        $resource = new Resource('zrn:partition:service:region:account:x');
    }

}
