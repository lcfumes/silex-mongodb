<?php

namespace app\Domain\Services;

use app\Domain\Collectors\ClientCollector;
use app\Domain\Entities\ClientEntity;
use app\Domain\Repositories\MongoDbRepository;

class MongoDbService
{
    private $repository;

    public function __construct($repository)
    {
        if (!$repository instanceof MongoDbRepository) {
            throw new \InvalidArgumentException('Expected MongoDbRepository in MongoDbService');
        }

        $this->repository = $repository;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function save($client)
    {
        if (!$client instanceof ClientEntity) {
            throw new \InvalidArgumentException('Expected ClientEntity in saveClient');
        }

        return $this->repository->save($client);
    }

    /**
     * @var \Domain\Entities\ClientEntity
     *
     * @return \Domain\Collectors\ClientCollector
     */
    public function search($client)
    {
        if (!$client instanceof ClientEntity) {
            throw new \InvalidArgumentException('Expected ClientEntity in saveClient');
        }

        $result = $this->repository->search($client);

        $clientCollector = new ClientCollector();

        foreach ($result as $users) {
            $clientEntity = new ClientEntity();

            $clientEntity->setId((string) $users['_id']);
            $clientEntity->setFirstName($users['first_name']);
            $clientEntity->setLastName($users['last_name']);
            $clientEntity->setEmail($users['email']);
            $clientEntity->setAge($users['age']);

            $clientCollector->add($clientEntity);
        }

        return $clientCollector;
    }
}
