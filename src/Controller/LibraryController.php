<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController {

    /**
     * @Route("/")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function showLibrary(EntityManagerInterface $entityManager) {
//        $repository = $entityManager->getRepository(Books::class);
//        $books = $repository->findAll();
//        dump($books);
        return $this->render('library/library.html.twig');
    }

    /**
     * @Route("/library/{slug}")
     */
    public function showBook($slug) {
        return $this->render('library/book/book.html.twig');
    }
}