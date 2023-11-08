<?php

namespace App\Form;

use App\Entity\Slot;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class SlotType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
            ])
            ->add('start', DateTimeType::class, [
                'label' => 'Début',
                'date_widget' => 'single_text'
            ])
            ->add('end', DateTimeType::class, [
                'label' => 'Fin',
                'date_widget' => 'single_text'
            ])
            ->add('description')
            ->add('background_color', ChoiceType::class, [
                'label' => 'Equipe',
                'choices' => [
                    'ProB' => '#ffff00',
                    'Ligue2' => '#fc87f9',
                    'Espoirs' => '#00b0f0',
                    'U18' => '#92d050',
                    'Cdf féminines' => '#EE9209',
                    'Indisponible' => '#6b7280'
                ],
            ])
            ->add('text_color', ColorType::class, [
                'label' => 'Couleur du texte'
            ])
            ->add('room', ChoiceType::class, [
                'label' => 'Salle',
                'choices' => [
                    'Grande salle' => 1,
                    'Petite salle' => 2,
                    'Musculation' => 3,
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez sélectionner une salle',
                    ]),
                ],
                'multiple' => false,
                'expanded' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Slot::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
