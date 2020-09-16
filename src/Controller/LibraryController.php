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
     * @Route("/", name="library_show")
     * @param EntityManagerInterface $entityManager
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function showLibrary(EntityManagerInterface $entityManager, BookRepository $bookRepository) {
        $books = $bookRepository->findAll();
//        $book = new Book();
//        $book->setDescription('Пособие по доте 2.');
//        $book->setYear(2020);
//        $book->setDescription('Пособие по доте 2.');
//        $book->setName('Как убить негра.');
//        $book->setImageUrl('https://cdn1.ozone.ru/multimedia/wc1200/1037906935.jpg');
//        $entityManager->persist($book);
//        $entityManager->flush();
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