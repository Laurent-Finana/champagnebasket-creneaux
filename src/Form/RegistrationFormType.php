<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('firstname', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('phoneNumber', TelType::class, [
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un numéro de téléphone',
                    ]),
                ]
            ])
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => [
                        'label' => 'Mot de passe',
                        'hash_property_path' => 'password',
                        'toggle' => true,
                        'hidden_label' => 'Masquer',
                        'visible_label' => 'Afficher',
                        'attr' => [
                            'placeholder' => 'Entrez votre mot de passe',
                        ]
                    ],
                    'second_options' => [
                        'label' => 'Confirmation du mot de passe',
                        'toggle' => true,
                        'hidden_label' => 'Masquer',
                        'visible_label' => 'Afficher',
                        'attr' => [
                            'placeholder' => 'Confirmez votre mot de passe',
                        ]

                    ],
                    'mapped' => false,
                    'attr' => ['autocomplete' => 'new-password'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Merci d\'entrer un mot de passe',
                        ]),
                        new Regex(
                            '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*\-+_\.\/]).{8,}$/',
                            "Le mot de passe doit contenir au minimum 8 caractères, une majuscule, un chiffre et un caractère spécial"
                        ),
                        new Length([
                            'max' => 4096,
                        ]),

                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
