<?php

namespace app\Domain\Repositories;

use app\Domain\Entities\ClientEntity;
use MongoDB\Driver\Manager;
use MongoDB\Collection;

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
        $manager = new Manager($this->config['doctrine_mongodb']['connections']['server']);
        $this->mongoCollection = new Collection($manager, $this->config['doctrine_mongodb']['database'], 'user');
    }

    abstract public function save(ClientEntity $client);

    abstract public function search(ClientEntity $client);
}
