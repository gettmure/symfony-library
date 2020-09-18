<?php


namespace App\Admin;

use App\Entity\Book;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Sonata\AdminBundle\Form\Type\ModelType;

final class BookAdmin extends AbstractAdmin {

    public function toString($object) {
        return $object instanceof Book
            ? $object->getName()
            : 'Book';
    }

    /**
     * @param FormMapper $formMapper
     */

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('Описание книги')
            ->add('name', TextType::class)
            ->add('year', IntegerType::class)
            ->add('description', TextType::class)
            ->add('imageUrl', UrlType::class)
            ->end()
            ->with('Авторы')
            ->add('authors', ModelType::class, [
                'class' => User::class,
                'property' => 'username',
                'multiple' => true,
            ])
            ->end();
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('name')
            ->add('authors', null, [], EntityType::class, [
                'class' => User::class,
                'choice_label' => 'username',
            ])
            ->add('year')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('name')
            ->add('authors', null, [
                'associated_property' => 'username'
            ])
            ->add('year')
            ->add('description')
            ->add('imageUrl');
    }
}