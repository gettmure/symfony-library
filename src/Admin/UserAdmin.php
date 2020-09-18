<?php


namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class UserAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper->add('username', TextType::class);
        $formMapper->add('firstname', TextType::class);
        $formMapper->add('lastname', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('username');
        $datagridMapper->add('firstname');
        $datagridMapper->add('lastname');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('username');
        $listMapper->addIdentifier('firstname');
        $listMapper->addIdentifier('lastname');

    }
}