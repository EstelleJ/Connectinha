<?php

namespace App\Form;

use App\Entity\ShippingCost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShippingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('min', IntegerType::class, [
            		'label' => 'Minimum en grammes'
            ])
            ->add('max', IntegerType::class, [
            		'label' => 'Maximum en grammes'
            ])
            ->add('price', NumberType::class, [
            		'label' => 'Prix'
            ])
		        ->add('submit', SubmitType::class, [
				        'label' => 'Sauvegarder',
		        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ShippingCost::class,
        ]);
    }
}
