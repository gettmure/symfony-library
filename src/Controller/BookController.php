<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/book")
 */
class BookController extends AbstractController {
    private function createInlineChangeForm(Book $book, $field) {
        $formFactory = $this->get('form.factory');
        $form = $formFactory
            ->createNamed("form_$field", BookType::class, $book)
            ->add("submit_$field", SubmitType::class);
        $fields = [
            'name',
            'description',
            'year',
            'imageUrl',
            'authors'
        ];
        if (($key = array_search($field, $fields)) !== false) {
            unset($fields[$key]);
            foreach ($fields as $field) {
                $form->remove($field);
            }
            return $form;
        } else {
            throw new Exception('Ошибка при создании формы!');
        }
    }

    private function submitForm($form, Request $request, $book) {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }
    }

    /**
     * @Route("/new", name="book_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($book);
            $entityManager->flush();
            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }
        return $this->render('book/new.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="book_show", methods={"GET", "POST"})
     * @param Book $book
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function show(Book $book, Request $request): Response {
        $nameForm = $this->createInlineChangeForm($book, 'name');
        $descriptionForm = $this->createInlineChangeForm($book, 'description');
        $imageForm = $this->createInlineChangeForm($book, 'imageUrl');
        $yearForm = $this->createInlineChangeForm($book, 'year');
        $authorsForm = $this->createInlineChangeForm($book, 'authors');
        if ($request->isMethod('POST')) {
            if ($request->request->has('form_name')) {
                $this->submitForm($nameForm, $request, $book);
            }
            if ($request->request->has('form_description')) {
                $this->submitForm($descriptionForm, $request, $book);
            }
            if ($request->request->has('form_imageUrl')) {
                $this->submitForm($imageForm, $request, $book);
            }
            if ($request->request->has('form_year')) {
                $this->submitForm($yearForm, $request, $book);
            }
            if ($request->request->has('form_authors')) {
                $this->submitForm($authorsForm, $request, $book);
            }
        }
        return $this->render('book/show.html.twig', [
            'book' => $book,
            'nameForm' => $nameForm->createView(),
            'descriptionForm' => $descriptionForm->createView(),
            'imageForm' => $imageForm->createView(),
            'yearForm' => $yearForm->createView(),
            'authorsForm' => $authorsForm->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function edit(Request $request, Book $book): Response {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_show', ['id' => $book->getId()]);
        }
        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="book_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @param Book $book
     * @return Response
     */
    public function delete(Request $request, Book $book): Response {
        if ($this->isCsrfTokenValid('delete' . $book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }
        return $this->redirectToRoute('library');
    }
}
