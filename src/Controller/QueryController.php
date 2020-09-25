<?php


namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QueryController extends AbstractController {

    /**
     * @Route("/query/native", name="query_native", methods={"GET"})
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function showNativeQueryResults(BookRepository $bookRepository): Response {
        $books = $bookRepository->findBooksByNativeSql();
        return $this->render('library/native_query.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/query/builder", name="query_builder", methods={"GET"})
     * @param BookRepository $bookRepository
     * @return Response
     */
    public function showQueryBuilderResults(BookRepository $bookRepository): Response {
        $books = $bookRepository->findBooksByQueryBuilder();
        return $this->render('library/builder_query.html.twig', [
            'books' => $books,
        ]);
    }
}