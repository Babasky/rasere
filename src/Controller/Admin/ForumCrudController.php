<?php

namespace App\Controller\Admin;

use App\Entity\Forum;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ForumCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Forum::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('photos', 'Images')
            ->setFormTypeOptions([
                "multiple"=> true,
                'attr' =>[
                    'accept'=> 'image/*'
                ]
            ])
            ->setBasePath('uploads/forum')
            ->setUploadDir('public/uploads/forum'),
           
        ];
    }
}
