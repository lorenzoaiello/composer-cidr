# CIDR Block Validator

Package for manipulating CIDRs and matching IP addresses.

## Installation

```
composer require lorenzoaiello/cidr
```

## Examples

```php
<?php

use lorenzoaiello\Cidr\CIDR;

class MyClass
{
    function MyFunction()
    {
        // *** Most Used Functions *** //

        // Compare an IPv4 address with one or more CIDR blocks
        $result = CIDR::matchMulti('10.1.2.3',['172.31.0.0/16', '10.0.0/8']);
        // returns: `true`

        // Compare an IPv4 address with a single CIDR block
        $result = CIDR::match('10.1.2.3','10.0.0/8');
        // returns: `true`

        // Compare an IPv4 address with an exact match
        $result = CIDR::match('10.1.2.3','10.1.2.3');
        // returns: `true`

        // Compare an IPv6 address with a single CIDR block
        $result = CIDR::match('2041:0000:140f::875b:131b','2041:0000:140f:0000:0000:0000:875b:131b/64');
        // returns: `true`

        // *** Wildcards *** //

        CIDR::matchMulti('10.1.2.3',['172.31.*','10.0.0.*']);

        CIDR::match('10.1.2.3','10.0.0.*');
 
        // *** IPv6 Specific ***//
        
        CIDR::IPv6_expand('2041:0000:140f::875b:131b');
        // returns: `2041:0000:140f:0000:0000:0000:875b:131b`
        
        CIDR::IPv6_compress('2041:0000:140F:0000:0000:0000:875B:131B');
        // returns: `2041:0:140f::875b:131b`

    }   
}
```

