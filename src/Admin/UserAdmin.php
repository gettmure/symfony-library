<?php


namespace App\Admin;

use App\Entity\Book;
use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin {
    public function toString($object) {
        return $object instanceof User
            ? $object->getUsername()
            : 'User';
    }

    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper
            ->with('Информация о пользователе')
            ->add('username', TextType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->end();
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper
            ->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('books', null, [], EntityType::class, [
                'class' => Book::class,
                'choice_label' => 'name',
            ]);
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper) {
        $listMapper
            ->addIdentifier('username')
            ->add('firstname')
            ->add('lastname')
            ->add('books', null, [
                'associated_property' => 'name'
            ]);
    }
}