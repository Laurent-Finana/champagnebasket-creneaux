<?php

namespace App\Controller\Admin;

use App\Entity\Slot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SlotCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Slot::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            DateTimeField::new('start')->renderAsChoice(),
            DateTimeField::new('end')->renderAsChoice(),
            TextareaField::new('description')->hideOnIndex(),
            BooleanField::new('all_day'),
            ColorField::new('background_color')->hideOnIndex(),
            ColorField::new('text_color')->hideOnIndex(),
            ChoiceField::new('room')->setChoices([
                'Grand salle' => '1',
                'Petite salle' => '2',
                'Musculation' => '3',
            ])
        ];
    }
}
