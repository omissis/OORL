<?php

namespace OORL\Tests;

use OORL\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testInitNoString()
    {
        new Parser();
    }

    public function testInitPath()
    {
        $parser = new Parser("foo");

        $this->assertNull($parser->getScheme());
        $this->assertNull($parser->getUser());
        $this->assertNull($parser->getPass());
        $this->assertNull($parser->getHost());
        $this->assertNull($parser->getPort());
        $this->assertEquals("foo", $parser->getPath());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Wrong connection string
     */
    public function testPortTooHigh()
    {
        new Parser('localhost:65536');
    }

    public function testInitFull()
    {
        $parser = new Parser("foo://bar:rab@baz.zab:123/quux?foo=bar#baz");

        $this->assertEquals('foo', $parser->getScheme());
        $this->assertEquals('bar', $parser->getUser());
        $this->assertEquals('rab', $parser->getPass());
        $this->assertEquals('baz.zab', $parser->getHost());
        $this->assertEquals(123, $parser->getPort());
        $this->assertEquals('/quux', $parser->getPath());
        $this->assertEquals('foo=bar', $parser->getQuery());
        $this->assertEquals('baz', $parser->getFragment());
    }
}
