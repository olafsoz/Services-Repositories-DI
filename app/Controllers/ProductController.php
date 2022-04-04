<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\ProductServices\add\AddRequest;
use App\Services\ProductServices\add\AddService;
use App\Services\ProductServices\show\ShowService;
use App\Services\ProductServices\showOne\ShowOneRequest;
use App\Services\ProductServices\showOne\ShowOneService;
use App\View;
use Psr\Container\ContainerInterface;

class ProductController
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function add(): Redirect
    {
        $service = $this->container->get(AddService::class);
        $service->execute(new AddRequest(
            $_POST['sku'],
            $_POST['name'],
            $_POST['quantity'],
            $_POST['price']
        ));
        return new Redirect('/home');
    }
    public function showAll(): View
    {
        $service = $this->container->get(ShowService::class);
        return new View('/Home', [
            'products' => $service->execute()
        ]);
    }
    public function form(): View
    {
        return new View('/Add');
    }
    public function showOne($vars): View
    {
        $id = (int) $vars['id'];
        $service = $this->container->get(ShowOneService::class);
        return new View('/One', [
            'product' => $service->execute(new ShowOneRequest($id))
        ]);
    }
}