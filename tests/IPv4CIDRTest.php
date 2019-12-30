<?php
declare(strict_types=1);

use lorenzoaiello\Cidr\CIDR;
use PHPUnit\Framework\TestCase;

final class IPv4CIDRTest extends TestCase
{
    public function testIPv4MatchMultiple()
    {
        $this->assertTrue(CIDR::matchMulti('10.1.2.3',['172.31.0.0/16', '10.0.0/8']));
    }
    
    public function testIPv4MatchSingle()
    {
        $this->assertTrue(CIDR::match('10.1.2.3','10.0.0.0/8'));
    }
    
    public function testIPv4MatchExact()
    {
        $this->assertTrue(CIDR::match('10.1.2.3','10.1.2.3/32'));
    }
    
    public function testIPv4MatchExactWithBlock()
    {
        $this->assertTrue(CIDR::match('10.1.2.3','10.1.2.3'));
    }
    
    public function testIPv4MatchExactWithWildcard()
    {
        $this->assertTrue(CIDR::match('10.1.2.3','*'));
    }
    
    public function testIPv4MatchExactWithPartialWildcard()
    {
        $this->assertFalse(CIDR::match('10.1.2.3','10.0.*'));
    }
    
    public function testIPv4MatchExactWithPartialWildcardFailure()
    {
        $this->assertFalse(CIDR::match('10.1.2.3','172.0.0.*'));
    }
    
    public function testIPv4MatchInvalidIP()
    {
        $this->assertFalse(CIDR::match('invalid-ip','10.0.0.0'));
    }
}