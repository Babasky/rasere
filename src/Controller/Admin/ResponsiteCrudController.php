<?php

namespace App\Controller\Admin;

use App\Entity\Responsite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResponsiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Responsite::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstnam')->setLabel('Prénom'),
            TextField::new('lastname')->setLabel('Nom'),
            TextField::new('poste')->setLabel('Poste'),
            TextField::new('fonction')->setLabel('Fonction'),
            TextField::new('phone')->setLabel('Téléphone'),
            ImageField::new('photo')->setLabel('Photo du responsable')
            ->setBasePath('uploads/responsite')->setUploadDir('public/uploads/responsite')->setRequired(false),
            AssociationField::new('site')->setLabel('Site')->setFormTypeOption('multiple', false)->setRequired(false),
        ];
    }
}
