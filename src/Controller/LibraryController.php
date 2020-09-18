<?php


namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;

use App\Repository\BookRepository;
use App\Repository\UserRepository;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController {

    /**
     * @Route("/", name="show_library")
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function showLibrary(BookRepository $bookRepository) {
        $books = $bookRepository->findAll();
        return $this->render('library/library.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/book/{slug}", name="show_book")
     * @param string $slug
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function showBook(string $slug, BookRepository $bookRepository) {
        $book = $bookRepository->findOneBy(
            ['name' => $slug],
        );
        return $this->render('library/book/book.html.twig', [
            'book' => $book,
        ]);
    }
}