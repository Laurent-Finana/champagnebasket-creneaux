<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Message;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\NotBlank;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                "label" => "Titre",
                "required" => false
            ])
            ->add('content', TextareaType::class, [
                "label" => "Message",
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'ajouter votre message.',
                    ]),
                ]
            ])
            ->add('recipient', EntityType::class, [
                "label" => "Destinataire",
                "class" => User::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.roles', 'ASC')
                        ->andWhere('u.roles LIKE \'%ROLE_COACH%\'  or u.roles LIKE \'%ROLE_PLAYER%\' ');
                },
                "choice_label" => function ($allChoices) {
                    return $allChoices->getFirstName() . " " . $allChoices->getLastName();
                },
            ])
            ->add('envoyer', SubmitType::class, [
                "attr" => [
                    "class" => "block w-16 mx-auto button-green"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
