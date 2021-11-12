<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ServicesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
            		'label' => 'Titre'
            ])
            ->add('text', TextareaType::class, [
            		'label' => 'Texte'
            ])
            ->add('price', IntegerType::class, [
            		'label' => 'Prix'
            ])
            ->add('duration', null, [
            		'label' => 'Durée'
            ])
		        ->add('distance', null, [
		        		'label' => 'Distance max. de prise de rendez-vous'
		        ])
            ->add('payment_method', null, [
            		'label' => 'Méthode de paiement'
            ])
            ->add('tva')
		        ->add('image', FileType::class, [
				        'label'       => 'Ajouter votre image principale',
				        'required'    => false,
				        'mapped'      => false,
				        'constraints' => [
						        new File([
								                 'maxSize'   => '1024k',
								                 'mimeTypes' => [
										                 'image/jpg',
										                 'image/jpeg',
								                 ],
							                 // 'mimeTypesMessage' => "Merci d'ajouter une image au format JPEG valide",
						                 ]),
				        ],
		        ])
		        ->add('submit', SubmitType::class, [
		        		'label' => 'Ajouter'
		        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Services::class,
        ]);
    }
}
