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
//    private function getBooksArray(BookRepository $books, UserRepository $authors) {
//        foreach ($books as $book) {
//            $book->
//        }
//    }

    /**
     * @Route("/")
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function showLibrary(EntityManagerInterface $entityManager) {
        $booksRepository = $entityManager->getRepository(Book::class);
        $usersRepository = $entityManager->getRepository(User::class);

        $books = $booksRepository->findAll();
        foreach ($books as $book) {
            $authors = $usersRepository->findBy(
                ['bookId' => $book->getId()],
            );
        }
        dump($books);
        return $this->render('library/library.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/library/{slug}")
     */
    public function showBook($slug) {
        return $this->render('library/book/book.html.twig');
    }
}