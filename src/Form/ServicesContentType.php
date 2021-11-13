<?php

namespace App\Form;

use App\Entity\ServicesContent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ServicesContentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('text')
		        ->add('pdf', FileType::class, [
				        'label'       => 'Ajouter votre pdf',
				        'required'    => false,
				        'mapped'      => false,
				        'constraints' => [
						        new File([
								                 'maxSize'   => '6024k',
								                 'mimeTypes' => [
										                 'application/pdf'
								                 ],
							                 // 'mimeTypesMessage' => "Merci d'ajouter une image au format JPEG valide",
						                 ]),
				        ],
		        ])
		        ->add('image', FileType::class, [
				        'label'       => 'Ajouter votre image',
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
            ->add('link')
		        ->add('submit', SubmitType::class, [
				        'label' => 'Sauvegarder',
		        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ServicesContent::class,
        ]);
    }
}
