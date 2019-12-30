<?php
declare(strict_types=1);

use lorenzoaiello\Cidr\CIDR;
use PHPUnit\Framework\TestCase;

final class IPv6CIDRTest extends TestCase
{
    public function testIPv6MatchExact()
    {
        $this->assertTrue(
            CIDR::match(
            '2041:0000:140f:0000:0000:0000:875b:131b',
            '2041:0000:140f:0000:0000:0000:875b:131b'
            )
        );
    }
    
    public function testIPv6MatchExactWithShortened()
    {
        $this->assertTrue(
            CIDR::match(
            '2041:0000:140f::875b:131b',
            '2041:0000:140f:0000:0000:0000:875b:131b'
            )
        );
    }
    
    public function testIPv6MatchExactWithWildcard()
    {
        $this->assertTrue(CIDR::match('2041:0000:140f::875b:131b','*'));
    }
    
    public function testIPv6MatchInvalidIP()
    {
        $this->assertFalse(CIDR::match('invalid-ip','2041:0000:140f::875b:131b'));
    }
    
    public function testIPv6Expansion()
    {
        $this->assertEquals(
            '2041:0000:140f:0000:0000:0000:875b:131b',
            CIDR::IPv6_expand('2041:0000:140f::875b:131b')
        );
    }
    
    public function testIPv6ExpansionCaseFix()
    {
        $this->assertEquals(
            '2041:0000:140f:0000:0000:0000:875b:131b',
            CIDR::IPv6_expand('2041:0000:140F::875B:131B')
        );
    }
    
    public function testIPv6ExpansionFailure()
    {
        $this->assertFalse(
            CIDR::IPv6_expand('not-ipv6')
        );
        
    }
    
    public function testIPv6Compression()
    {
        $this->assertEquals(
            '2041:0:140f::875b:131b',
            CIDR::IPv6_compress('2041:0000:140F:0000:0000:0000:875B:131B')
        );
    }
    
    public function testIPv6CompressionCaseFix()
    {
        $this->assertEquals(
            '2041:0:140f::875b:131b',
            CIDR::IPv6_compress('2041:0000:140F::875B:131B')
        );
    }
    
    public function testIPv6CompressionFailure()
    {
        $this->assertEquals(
            '',
            CIDR::IPv6_compress('not-ipv6')
        );
        
    }
}