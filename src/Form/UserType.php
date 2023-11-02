<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            /* ->add('roles') */
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('phone_number', TelType::class, [
                'label' => 'Téléphone',
            ])

            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                // Get Form from Event
                $form = $event->getForm();
                // Get User from Form Event
                $user = $event->getData();

                // If User exist
                if ($user->getId() !== null) {
                    $form->add('password', PasswordType::class, [
                        'label' => 'Mot de passe',
                        'toggle' => true,
                        'hidden_label' => 'Masquer',
                        'visible_label' => 'Afficher',
                        'mapped' => false,
                        'attr' => [
                            'placeholder' => 'Laisser vide si inchangé'
                        ],
                        'constraints' => [
                            new Regex(
                                '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\-+_\.\/]).{8,}$/',
                                "Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial"
                            ),
                        ],
                    ]);
                } else {
                    // New
                    $form->add('password', PasswordType::class, [
                        'label' => 'Mot de passe',
                        'empty_data' => '',
                        // Constraints which was on Entity are declared below
                        'constraints' => [
                            new Regex(
                                '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\-+_\.\/]).{8,}$/',
                                "Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial"
                            ),
                        ],
                    ]);
                }
            });
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
