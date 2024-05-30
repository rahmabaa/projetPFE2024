<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use App\Entity\BoiteFibre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class BoiteFibreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BoiteFibre::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id') 
            ->hideOnForm(),
            TextField::new('nom'),
            NumberField::new('latitude'),
            NumberField::new('longitude'),
            // TextField::new('status'),
            ChoiceField::new('status')->setChoices([
                'Panne' => 'Panne',
                'Active' => 'Active',
                'Vol' => 'Vol',
            ]),
            

        ];
    }
  
}
