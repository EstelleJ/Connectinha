<?php

namespace App\Form;

use App\Entity\ProductImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductImageType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, [
						'label' => 'Nom du fichier',
				])
				->add('title', TextType::class, [
						'label' => 'Titre de votre image',
				])
				->add('alt', TextType::class, [
						'label' => 'Texte alternatif',
				])
				->add('text', TextType::class, [
						'label'    => 'Légende de votre image',
						'required' => false,
				])
				->add('image', FileType::class, [
						'label'       => 'Ajouter votre image',
						'required'    => false,
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
						'label' => 'Sauvegarder',
				]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				                       'data_class' => ProductImage::class,
		                       ]);
	}
}
