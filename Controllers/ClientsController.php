<?php

namespace Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Silex\ControllerProviderInterface;
use Domain\Entities\ClientEntity;

class ClientsController implements ControllerProviderInterface
{

    public function connect(Application $app)
    {
        $controller = $app['controllers_factory'];

        $controller->get("save", [$this, 'saveAction'])
            ->method('POST')
            ->bind('save.client');

        $controller->get("search", [$this, 'searchAction'])
            ->method('POST')
            ->bind('search.client');

        return $controller;
    }

    public function saveAction(Request $request, Application $app)
    {
            $formCreate = new \Provider\Form\CreateClientFormProvider($app);

            $form = $formCreate->create();

            $form->handleRequest($request);

            if ($request->getMethod() === "POST" && $form->isValid()) {

                $data = $request->request->get('form');

                $clientEntity = new ClientEntity();
                $clientEntity->setFirstName($data['first_name']);
                $clientEntity->setLastName($data['last_name']);
                $clientEntity->setEmail($data['email']);
                $clientEntity->setAge($data['age']);

                $mongoDbService = new \Domain\Services\MongoDbService(new \Domain\Repositories\MongoDbRepository($app['config']));
                $result = $mongoDbService->save($clientEntity);

                if ($result instanceof \MongoDB\InsertOneResult) {
                    return new Response(
                        json_encode(['id' => (string)$result->getInsertedId(), 'result' => true]),
                        200,
                        ['Content-Type' => 'application/json']

                    );
                }

            }

            return new Response(
                json_encode(['result' => false]),
                503,
                ['Content-Type' => 'application/json']
            );
    }

    public function searchAction(Request $request, Application $app)
    {
        $formCreate = new \Provider\Form\SearchClientFormProvider($app);

        $form = $formCreate->create();

        $form->handleRequest($request);
        if ($request->getMethod() === "POST" && $form->isValid()) {

            $mongoDbService = new \Domain\Services\MongoDbService(new \Domain\Repositories\MongoDbRepository($app['config']));

            $data = $request->request->get('form');

            $clientEntity = new ClientEntity();
            $clientEntity->setFirstName($data['first_name']);
            $clientEntity->setLastName($data['last_name']);
            $clientEntity->setEmail($data['email']);
            $clientEntity->setAge($data['age']);

            $search = $mongoDbService->search($clientEntity);

            return new Response(
                json_encode($search->toArray()),
                200,
                ['Content-Type' => 'application/json']
            );

        }

        return new Response(
            json_encode(['result' => false]),
            503,
            ['Content-Type' => 'application/json']
        );

    }
}