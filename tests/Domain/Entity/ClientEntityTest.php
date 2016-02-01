<?php

use app\Domain\Entities\ClientEntity;

class ClientEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \app\Domain\Entities\ClientEntity::setId
     * @covers \app\Domain\Entities\ClientEntity::setFirstName
     * @covers \app\Domain\Entities\ClientEntity::setLastName
     * @covers \app\Domain\Entities\ClientEntity::setEmail
     * @covers \app\Domain\Entities\ClientEntity::setAge
     * @covers \app\Domain\Entities\ClientEntity::toArray
     */
    public function testSetData()
    {
        $client = new ClientEntity();

        $expected = [
            'id'              => '1234',
            'first_name' => 'Silex',
            'last_name'  => 'Project',
            'email'         => 'lcfumes@gmail.com',
            'age'           => '1'
        ];

        $client->setId("1234");
        $client->setFirstName("Silex");
        $client->setLastName("Project");
        $client->setEmail("lcfumes@gmail.com");
        $client->setAge('1');

        $this->assertEquals($expected, $client->toArray());
    }

    /**
     * @covers \app\Domain\Entities\ClientEntity::getId
     * @covers \app\Domain\Entities\ClientEntity::getFirstName
     * @covers \app\Domain\Entities\ClientEntity::getLastName
     * @covers \app\Domain\Entities\ClientEntity::getEmail
     * @covers \app\Domain\Entities\ClientEntity::getAge
     * @covers \app\Domain\Entities\ClientEntity::toArray
     */
    public function testGetData()
    {
        $client = new ClientEntity();

        $client->setId("1234");
        $client->setFirstName("Silex");
        $client->setLastName("Project");
        $client->setEmail("lcfumes@gmail.com");
        $client->setAge('1');

        $expected = [
            'id'              => $client->getId(),
            'first_name' => $client->getFirstName(),
            'last_name'  => $client->getLastName(),
            'email'         => $client->getEmail(),
            'age'           => $client->getAge()
        ];

        $this->assertEquals($expected, $client->toArray());
    }
}