<?php

namespace App\Controller\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use App\Entity\Alerte;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AlerteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Alerte::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
            ->hideOnForm(),
            TextField::new('contenu'),
            // TextEditorField::new('description'),
            // ChoiceField::new('type')->setChoices([
                // 'Panne' => 'Panne',
                // 'Vol' => 'Vol',
               
            // ]),
            ChoiceField::new('status')->setChoices([
                'alerte traitée' => 'alerte  traitée',
                'alerte non traitée' => 'alerte non traitée',
               
            ]),
            AssociationField::new('boite')->
            setCrudController(BoiteFibreCrudController::class),
            DateTimeField::new('date')
            //->renderAsChoice()
            //->hideOnForm(),
        ];
    }
    
}
