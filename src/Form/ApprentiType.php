<?php

namespace App\Form;

use App\Entity\Apprenti;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ApprentiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => "Nom",
            ])
            ->add('memo')
            ->add('prenom',TextType::class,[
                'label' => "Prénom",
            ])
            ->add('dateNaissance',DateType::class,[
                'label' => "Date de Naissance",
                'widget' => 'single_text', // le navigateur ajoutera un "datepicker" automatiquement
            ])
            ->add('email')
            ->add('telephone')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Apprenti::class,
        ]);
    }
}
