<?php

namespace Domain\Repositories;

abstract class AbstractMongoDbRepository
{
    protected $config;

    protected $mongoCollection;

    public function __construct($config)
    {
        $this->config = $config;

        $this->connect();
    }

    public function connect()
    {
        $manager = new \MongoDB\Driver\Manager($this->config['doctrine_mongodb']['connections']['server']);
        $this->mongoCollection = new \MongoDB\Collection($manager, $this->config['doctrine_mongodb']['database'], 'user');
    }

    abstract public function save(\Domain\Entities\ClientEntity $client);

    abstract public function search(\Domain\Entities\ClientEntity $client);
}
