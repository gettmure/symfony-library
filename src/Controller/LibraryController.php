<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController {

    /**
     * @Route("/")
     */
    public function homepage() {
        return new Response('aue');
    }

    /**
     * @Route("/library")
     */
    public function showLibrary() {
        return new Response('библиотека');
    }

    /**
     * @Route("/library/{slug}")
     */
    public function showBook($slug) {
        return new Response(sprintf('книга %s', $slug));
    }
}