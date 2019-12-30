<?php
declare(strict_types=1);

use Cidr\CIDR;
use PHPUnit\Framework\TestCase;

final class IPv4CIDRTest extends TestCase
{
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
    
    public function testIPv4MatchInvalidIP()
    {
        $this->assertFalse(CIDR::match('invalid-ip','10.0.0.0'));
    }
}