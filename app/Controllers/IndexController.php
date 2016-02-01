<?php

namespace app\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Silex\ControllerProviderInterface;
use app\Provider\Form\SearchClientFormProvider;
use app\Provider\Form\CreateClientFormProvider;

class IndexController implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controller = $app['controllers_factory'];

        $controller->get('/', [$this, 'indexAction'])
            ->method('GET')
            ->bind('index');

        $controller->get('create', [$this, 'createAction'])
            ->method('GET')
            ->bind('index.create');

        $controller->get('search', [$this, 'searchAction'])
            ->method('GET')
            ->bind('index.search');

        return $controller;
    }

    public function indexAction(Application $app)
    {
        return new Response($app['twig']->render('index.html.twig', array()));
    }

    public function createAction(Application $app)
    {
        $formCreate = new CreateClientFormProvider($app);

        $form = $formCreate->create();

        return new Response($app['twig']->render('create.html.twit', ['form' => $form->createView()]));
    }

    public function searchAction(Application $app)
    {
        $formSearch = new SearchClientFormProvider($app);

        $form = $formSearch->create();

        return new Response($app['twig']->render('search.html.twit', ['form' => $form->createView()]));
    }
}
