<?php

use app\Domain\Collectors\ClientCollector;
use app\Domain\Entities\ClientEntity;

class ClientCollectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException               InvalidArgumentException
     * @expectedExceptionMessage  Invalid Argument to ClientCollector
     * @cover \app\Domain\Collectors\ClientCollector:attach
     */
    public function testAttachClientWhenParameterIsntClientEntity()
    {
        $collector = new ClientCollector();
        $collector->add([]);
    }

    /**
     * @cover \app\Domain\Collectors\ClientCollector:attach
     */
    public function testAttachClientWhenParameterIsClientEntity()
    {
        $collector = new ClientCollector();
        $client = new ClientEntity();

        $client->setId("1234");
        $client->setFirstName("Silex");
        $client->setLastName("Project");
        $client->setEmail("lcfumes@gmail.com");
        $client->setAge('1');

        $collector->add($client);
    }

    /**
     * @cover \app\Domain\Collectors\ClientCollector:attach
     * @cover \app\Domain\Collectors\ClientCollector:toArray
     */
    public function testGetCollectionMustReturnArray()
    {
        $collector = new ClientCollector();
        $client = new ClientEntity();

        $client->setId("1234");
        $client->setFirstName("Silex");
        $client->setLastName("Project");
        $client->setEmail("lcfumes@gmail.com");
        $client->setAge('1');

        $collector->add($client);

        $expected[] = [
            'id'              => '1234',
            'first_name' => 'Silex',
            'last_name'  => 'Project',
            'email'         => 'lcfumes@gmail.com',
            'age'           => '1'
        ];

        $this->assertEquals($expected, $collector->toArray());
    }
}