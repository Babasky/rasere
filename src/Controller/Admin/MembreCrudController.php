<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membre::class;
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
            TextField::new('firstname')->setLabel('Prénom'),
            TextField::new('lastname')->setLabel('Nom'),
            TextField::new('poste')->setLabel('Poste'),
            TextField::new('fonction')->setLabel('Fonction'),
            TextField::new('phone')->setLabel('Téléphone'),
            EmailField::new('email')->setLabel('Adresse email'),
            ImageField::new('photo')
                ->setLabel('Photo du membre')
                ->setBasePath('uploads/membre')
                ->setUploadDir('public/uploads/membre')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setFormTypeOptions([
                    'attr' => [
                        'accept' => 'image/*',
                    ],
                ])
                ->setRequired($pageName === Crud::PAGE_NEW),
            AssociationField::new('subgroup')
                ->setLabel('Sous-groupe')
                ->setFormTypeOption('multiple', false)
                ->setRequired(false),

            AssociationField::new('specialite')
                ->setLabel('Spécialité')
                ->setFormTypeOption('multiple', false)
                ->setRequired(false),
        ];
    }
    
}
