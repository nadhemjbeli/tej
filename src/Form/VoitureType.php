<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque')
            ->add('carburant',ChoiceType::class, [
                'choices' => [
                    'diesel'=>'Diesel',
                    'essence'=>'Essences',
                ]
            ])
            ->add('transmission', ChoiceType::class, [
                'choices'  => [
                    'automatique' => 'automatique',
                    'manuelle' => 'manuelle'
                ]
            ])
            ->add('puissance')
            ->add('annee', null,[
                'label' => 'année'
            ])
            ->add('categorie', ChoiceType::class, [
                'choices'  => [
                    'class_comp' => 'Compacte',
                    'class_eco' => 'Economique',
                    'class_vip' => 'VIP',
                    'class_auto' => 'Automatique',
                    'class_van' => 'Van',
                ],
            ])
            ->add('agence', ChoiceType::class, [
                'choices'  => [
                    'hammamet' => 'hammamet',
                    'enfidha' => 'enfidha',
                    'tunis' => 'tunis',
                    'monastir' => 'monastir'
                ]
            ])->add('image', FileType::class, [
                'label' => 'Image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '3M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            ->add('prixJour')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
