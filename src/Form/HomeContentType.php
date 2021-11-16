<?php

namespace App\Form;

use App\Entity\HomeContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presentation_title', TextType::class, [
            		'label' => 'Titre du bloc présentation'
            ])
            ->add('presentation_text_1', TextareaType::class, [
            		'label' => 'Texte du bloc présentation'
            ])
            ->add('presentation_subtitle', TextType::class, [
            		'label' => 'Titre présentation du magnétisme'
            ])
            ->add('presentation_text_2', TextareaType::class, [
            		'label' => 'Texte du bloc présentation du magnétisme'
            ])
            ->add('questions_title', TextType::class, [
            		'label' => 'Titre du bloc contact'
            ])
            ->add('questions_text', TextareaType::class, [
            		'label' => 'Texte du bloc contact'
            ])
		        ->add('facebook')
		        ->add('instagram')
		        ->add('youtube')
		        ->add('submit', SubmitType::class, [
				        'label' => 'Sauvegarder',
		        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HomeContent::class,
        ]);
    }
}
