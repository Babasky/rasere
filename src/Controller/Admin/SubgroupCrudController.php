<?php

namespace App\Controller\Admin;

use App\Entity\Subgroup;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SubgroupCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subgroup::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::EDIT)
            ->add(Crud::PAGE_NEW, Action::NEW);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name')->setLabel('Nom'),
            ImageField::new('logo')
                ->setLabel('Logo du sous-groupe')
                ->setBasePath('uploads/subgroup')
                ->setUploadDir('public/uploads/subgroup')
                ->setUploadedFileNamePattern('[randomhash].[extension]'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    
}
