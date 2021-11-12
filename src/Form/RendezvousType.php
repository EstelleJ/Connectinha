<?php

namespace App\Form;

use App\Entity\Rendezvous;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezvousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date')
            ->add('name', TextType::class, [
            		'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
            		'label' => 'Prénom'
            ])
            ->add('email')
            ->add('phoneNumber', NumberType::class, [
            		'label' => 'Numéro de téléphone'
            ])
            ->add('duration', null, [
            		'label' => 'Durée du rendez-vous'
            ])
            ->add('day', null, [
            		'label' => 'Jour du rendez-vous'
            ])
            ->add('hours', null, [
            		'label' => 'Horaire du rendez-vous'
            ])
            ->add('service')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rendezvous::class,
        ]);
    }
}
