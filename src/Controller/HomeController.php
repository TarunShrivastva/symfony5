<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home", methods={"GET","HEAD"})
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    public function list($page)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController  List Page ' . $page,
        ]);
    }

    public function listSlug(string $slug)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Here is ' . $slug,
        ]);
    }

    public function data(Request $request)
    {
        $routeName = $request->attributes->get('_route');
        $routeParameters = $request->attributes->get('_route_params');

        $allAttributes = $request->attributes->all();

        // dd($allAttributes);

        return $this->render('home/index.html.twig', [
            'controller_name' => $routeName,
        ]);
    }

    // composer require --dev symfony/var-dumper
    // Linting Twig Templates¶
    // The lint:twig command checks that your Twig templates don’t have any syntax errors.
    // It’s useful to run it before deploying your application to production 
    // (e.g. in your continuous integration server):
    // php bin/console lint:twig --show-deprecations templates/email/

}
