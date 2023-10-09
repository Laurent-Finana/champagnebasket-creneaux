<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email')->hideWhenUpdating(),
            TextField::new('password')->onlyWhenCreating(),
            TextField::new('firstname', 'Prénom'),
            TextField::new('lastname', 'Nom'),
            TelephoneField::new('phoneNumber', 'Numéro de téléphone'),
            ChoiceField::new('roles')->setChoices([
                'User' => 'ROLE_USER',
                'Player' => 'ROLE_PLAYER',
                'Coach' => 'ROLE_COACH',
                'Admin' => 'ROLE_ADMIN'
            ])->allowMultipleChoices()
        ];
    }
}
