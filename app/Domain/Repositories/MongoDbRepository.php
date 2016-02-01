<?php

namespace app\Domain\Repositories;

use app\Domain\Entities\ClientEntity;

class MongoDbRepository extends AbstractMongoDbRepository
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    /**
     * @param \Domain\Entities\ClientEntity $client [description]
     *
     * @return false | \MongoDB\InsertOneResult
     */
    public function save(ClientEntity $client)
    {
        try {
            return $this->mongoCollection->insertOne($client->toArray());
        } catch (\Exception $e) {
            return false;
        }
    }

    public function search(ClientEntity $client)
    {
        $search = [];
        if (strlen($client->getFirstName()) > 0) {
            $search['first_name'] = $client->getFirstName();
        }
        if (strlen($client->getLastName()) > 0) {
            $search['last_name'] = $client->getLastName();
        }
        if (strlen($client->getEmail()) > 0) {
            $search['email'] = $client->getEmail();
        }
        if (strlen($client->getAge()) > 0) {
            $search['age'] = $client->getAge();
        }

        return $this->mongoCollection->find($search);
    }
}
