<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ServicesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('text')
            ->add('price')
            ->add('duration')
		        ->add('distance')
            ->add('payment_method')
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
