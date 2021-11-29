<?php

namespace App\Form;

use App\Entity\SpecialOffer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecialOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
            		'label' => 'Titre'
            ])
            ->add('offer', NumberType::class, [
            		'label' => 'Taux en pourcentage %'
            ])
		        ->add('products', null, [
		        		'label' => 'Produits concernés'
		        ])
		        ->add('submit', SubmitType::class, [
				        'label' => 'Sauvegarder',
		        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SpecialOffer::class,
        ]);
    }
}
