<?php

namespace App\Controller\Admin;

use App\Entity\Accueil;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AccueilCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Accueil::class;
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
            TextField::new('title')->setLabel("Le titre")->setFormTypeOptions([
                'attr' => [
                    'placeholder' => 'Entrez le titre ici',
                    'class' => 'text'
                ]
            ]),
            TextField::new('description')->setLabel("Description"),
            TextField::new('slogan')->setLabel("Le Slogan")
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Accueil) {
            $description = $entityInstance->getDescription();
            $description = preg_replace('/<div(?![^>]*class=)/i', '<div class="text"', $description);
            $entityInstance->setDescription($description);
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if ($entityInstance instanceof Accueil) {
            $description = $entityInstance->getDescription();
            $description = preg_replace('/<div(?![^>]*class=)/i', '<div class="text"', $description);
            $entityInstance->setDescription($description);
        }

        parent::updateEntity($entityManager, $entityInstance);
        
    }

}
