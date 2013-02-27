<?php

namespace OORL\Tests\Parser;

use OORL\Parser\MongoDB as MongoDBParser;

class MongoDBTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Wrong connection string
     */
    public function testInitUsername()
    {
        new MongoDBParser("foo@");
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Database can't be empty
     */
    public function testInitHost()
    {
        new MongoDBParser("bar.baz");
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Wrong connection string
     */
    public function testInitDatabase()
    {
        new MongoDBParser("/quux");
    }

    public function testInitHostDatabase()
    {
        $parser = new MongoDBParser("1.2.3.4/quux");

        $this->assertEquals('mongodb', $parser->getScheme());
        $this->assertNull($parser->getUser());
        $this->assertNull($parser->getPass());
        $this->assertEquals("1.2.3.4", $parser->getHost());
        $this->assertNull($parser->getPort());
        $this->assertEquals("quux", $parser->getDatabase());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Database can't be empty
     */
    public function testInitUsernameHost()
    {
        new MongoDBParser("foo@bar.baz");
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Wrong connection string
     */
    public function testInitUsernameDatabase()
    {
        new MongoDBParser("foo@/bar");
    }

    public function testInitUsernameHostDatabase()
    {
        $parser = new MongoDBParser("foo@bar.baz/quux");

        $this->assertEquals('mongodb', $parser->getScheme());
        $this->assertEquals("foo", $parser->getUser());
        $this->assertNull($parser->getPass());
        $this->assertEquals("bar.baz", $parser->getHost());
        $this->assertNull($parser->getPort());
        $this->assertEquals("quux", $parser->getDatabase());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }

    /**
     * Triangulation test
     */
    public function testInitUsernameHostDatabase2()
    {
        $parser = new MongoDBParser("foo@1.2.3.4/quux");

        $this->assertEquals('mongodb', $parser->getScheme());
        $this->assertEquals("foo", $parser->getUser());
        $this->assertNull($parser->getPass());
        $this->assertEquals("1.2.3.4", $parser->getHost());
        $this->assertNull($parser->getPort());
        $this->assertEquals("quux", $parser->getDatabase());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Wrong connection string
     */
    public function testInitUsernamePassword()
    {
        new MongoDBParser("foo:oof");
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Database can't be empty
     */
    public function testInitUsernamePasswordHost()
    {
        new MongoDBParser("foo:oof@bar.baz");
    }

    public function testInitUsernamePasswordHostDatabase()
    {
        $parser = new MongoDBParser("foo:oof@bar.baz/quux");

        $this->assertEquals('mongodb', $parser->getScheme());
        $this->assertEquals("foo", $parser->getUser());
        $this->assertEquals("oof", $parser->getPass());
        $this->assertEquals("bar.baz", $parser->getHost());
        $this->assertNull($parser->getPort());
        $this->assertEquals("quux", $parser->getDatabase());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Wrong connection string
     */
    public function testInitUsernamePasswordDatabase()
    {
        new MongoDBParser("foo:oof@/quux");
    }

    public function testInitUsernamePasswordHostPortDatabase()
    {
        $parser = new MongoDBParser("foo:oof@bar.baz:12345/quux");

        $this->assertEquals('mongodb', $parser->getScheme());
        $this->assertEquals("foo", $parser->getUser());
        $this->assertEquals("oof", $parser->getPass());
        $this->assertEquals("bar.baz", $parser->getHost());
        $this->assertEquals(12345, $parser->getPort());
        $this->assertEquals("quux", $parser->getDatabase());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Database can't be empty
     */
    public function testInitHostPort()
    {
        $parser = new MongoDBParser("bar.baz:12345");
    }

    public function testInitHostPortDatabase()
    {
        $parser = new MongoDBParser("bar.baz:12345/quux");

        $this->assertEquals('mongodb', $parser->getScheme());
        $this->assertNull($parser->getUser());
        $this->assertNull($parser->getPass());
        $this->assertEquals("bar.baz", $parser->getHost());
        $this->assertEquals(12345, $parser->getPort());
        $this->assertEquals("quux", $parser->getDatabase());
        $this->assertNull($parser->getQuery());
        $this->assertNull($parser->getFragment());
    }
}
