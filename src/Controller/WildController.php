<?php
// src/Controller/WildController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class WildController extends AbstractController
{
    /**
     * @Route("/wild", name="wild_index")
     */
    public function index() : Response
    {
        return $this->render('Wild/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }

    /**
     * @Route("/wild/show/{slug}", requirements={"slug"="[a-z0-9-]+$"}, defaults={"slug"=null}, name="wild_show")
     */
    public function show($slug): Response

    {
        $replace = str_replace("-", " ", $slug);
        $result = ucwords($replace);
        return $this->render('Wild/show.html.twig', ['slug' => $result]);
    }
}