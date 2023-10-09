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
use Symfony\Component\Form\ChoiceList\Factory\Cache\ChoiceValue;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\Choice;

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
            TextField::new('title', 'Titre'),
            DateTimeField::new('start', 'Début')->renderAsChoice(),
            DateTimeField::new('end', 'Fin')->renderAsChoice(),
            TextareaField::new('description', 'Description')->hideOnIndex(),
            ChoiceField::new('background_color', 'Equipe')->setChoices([
                'ProB' => '#ffff00',
                'Ligue2' => '#fc87f9',
                'Espoirs' => '#00b0f0',
                'U18' => '#92d050',
                'Espoirs féminines' => '#EE9209'
            ])->hideOnIndex(),
            ColorField::new('text_color', 'Couleur du texte')->hideOnIndex(),
            ChoiceField::new('room', 'Salle')->setChoices([
                'Grand salle' => '1',
                'Petite salle' => '2',
                'Musculation' => '3'
            ])
        ];
    }
}
