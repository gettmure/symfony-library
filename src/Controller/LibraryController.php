<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController {
    private function createFilteringForm() {
        return $this->createFormBuilder()
            ->add('name', TextType::class, ['required' => false])
            ->add('year', IntegerType::class, ['required' => false])
            ->add('image_url', TextType::class, ['required' => false])
            ->add('description', TextType::class, ['required' => false])
            ->add('authors', EntityType::class, [
                'class' => User::class,
                'choice_label' => function (User $author) {
                    return sprintf('%s (%s %s)',
                        $author->getUsername(),
                        $author->getFirstname(),
                        $author->getLastname());
                },
                'query_builder' => function (EntityRepository $er) {
                    $queryBuilder = $er->createQueryBuilder('user');
                    return $queryBuilder
                        ->innerJoin('user.books', 'books')
                        ->where($queryBuilder->expr()->isNotNull('books'))
                        ->orderBy('user.username', 'ASC');
                },
                'multiple' => true,
                'required' => false,
            ])
            ->add('submit', SubmitType::class)
            ->getForm()
            ->createView();
    }

    /**
     * @Route("/", name="library", methods={"GET"})
     * @param BookRepository $bookRepository
     * @param UserRepository $userRepository
     * @param Request $request
     * @return Response
     */
    public function showLibrary(BookRepository $bookRepository, UserRepository $userRepository, Request $request): Response {
        $form = $this->createFilteringForm();
        $books = $bookRepository->findAll();
        if ($request->query->get('form')) {
            $queryParameters = array_filter($request->query->get('form'));
            unset($queryParameters['_token']);
            if (!empty($queryParameters)) {
                $books = $bookRepository->filterBooksByParameters($queryParameters);
            }
        }
        return $this->render('library/library.html.twig', [
            'books' => $books,
            'form' => $form,
        ]);
    }
}