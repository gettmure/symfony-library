<?php


namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class BookAdmin extends AbstractAdmin {
    protected function configureFormFields(FormMapper $formMapper) {
        $formMapper->add('name', TextType::class);
        $formMapper->add('year', TextType::class);
        $formMapper->add('description', TextType::class);
        $formMapper->add('imageUrl', TextType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper) {
        $datagridMapper->add('name');
        $datagridMapper->add('year');
        $datagridMapper->add('description');
        $datagridMapper->add('imageUrl');
    }

    protected function configureListFields(ListMapper $listMapper) {
        $listMapper->addIdentifier('name');
        $listMapper->addIdentifier('year');
        $listMapper->addIdentifier('description');
        $listMapper->addIdentifier('imageUrl');
    }
}