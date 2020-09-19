<?php


namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController {
    /**
     * @Route("/", name="library", methods={"GET"})
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function index(BookRepository $bookRepository): Response {
        return $this->render('library/library.html.twig', [
            'books' => $bookRepository->findAll(),
        ]);
    }
}