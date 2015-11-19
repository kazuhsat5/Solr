<?php

namespace Sugar\Solr;

//use Sugar\Solr\Request;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Client::select()
     * @test
     */
    public function testSelect()
    {
        $stub = $this->getMockBuilder('Sugar\Solr\Request\Factory')
                     ->disableOriginalConstructor()
                     ->getMock();

        $stub->expects($this->once())
             ->method('request')
             ->will($this->returnValue('{}'));

        $obj = new Client('localhost', 'core', 8983);
        $obj->setFactory($stub);

        $this->assertEquals([], $obj->select([]));
    }

    /**
     * @covers Client::system()
     * @test
     */
    public function testSystem()
    {
        $stub = $this->getMockBuilder('Sugar\Solr\Request\Factory')
                     ->disableOriginalConstructor()
                     ->getMock();

        $stub->expects($this->once())
             ->method('request')
             ->will($this->returnValue('{}'));

        $obj = new Client('localhost', 'core', 8983);
        $obj->setFactory($stub);

        $this->assertEquals([], $obj->system());
    }

    /**
     * @covers Client::ping()
     * @test
     */
    public function testPing()
    {
        $stub = $this->getMockBuilder('Sugar\Solr\Request\Factory')
                     ->disableOriginalConstructor()
                     ->getMock();

        $stub->expects($this->once())
             ->method('request')
             ->will($this->returnValue('{}'));

        $obj = new Client('localhost', 'core', 8983);
        $obj->setFactory($stub);

        $this->assertEquals([], $obj->ping());
    }

    /**
     * @covers Client::getHost
     * @test
     */
    public function testGetHost()
    {
        $obj = new Client('localhost', 'core', 8983);
        $this->assertEquals('localhost', $obj->getHost());
    }

    /**
     * @covers Client::getCore
     * @test
     */
    public function testGetCore()
    {
        $obj = new Client('localhost', 'core', 8983);
        $this->assertEquals('core', $obj->getCore());
    }

    /**
     * @covers Client::getPort
     * @test
     * @dataProvider testGetPostDataProvider
     */
    public function testGetPort($port, $expected)
    {
        $obj = new Client('localhost', 'core', $port);
        $this->assertEquals($expected, $obj->getPort());
    }

    public function testGetPostDataProvider()
    {
        return [
            [8983, 8983],
            ['8983', 8983],
            [null, 0],
            ['', 0],
        ];
    }

    /**
     * @covers Client::getPort
     * @test
     */
    public function testGetPort_noArgument()
    {
        $obj = new Client('localhost', 'core');
        $this->assertEquals(8983, $obj->getPort());
    }
}
