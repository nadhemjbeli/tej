<?php

namespace App\Form;

use App\Entity\Prix;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDebutS1', TextType::class, [
                'label' => "date saison 1 (mm-jj)",
                'attr' => [
                    'placeholder' => 'mm-jj'
                ]
            ])
//            ->add('DateFinS1')
            ->add('PrixS1')
            ->add('DateDebutS2', TextType::class, [
                'label' => "date saison 2 (mm-jj)",
                'attr' => [
                    'placeholder' => 'mm-jj'
                ]
            ])
//            ->add('DateFinS2')
            ->add('PrixS2')
            ->add('DateDebutS3', TextType::class, [
                'label' => "date saison 3 (mm-jj)",
                'attr' => [
                    'placeholder' => 'mm-jj'
                ]
            ])
//            ->add('DateFinS3')
            ->add('PrixS3')
            ->add('DateDebutS4', TextType::class, [
                'label' => "date saison 4 (dd-mm)",
                'attr' => [
                    'placeholder' => 'mm-jj'
                ]
            ])
//            ->add('DateFinS4')
            ->add('PrixS4')
//            ->add('voiture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prix::class,
        ]);
    }
}
