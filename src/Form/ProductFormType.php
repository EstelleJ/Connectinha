<?php

namespace App\Form;

use App\Entity\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\File;

class ProductFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, [
						'label' => 'Nom du produit',
				])
				->add('price', NumberType::class, [
						'label' => 'Prix',
				])
				->add('text', TextareaType::class, [
						'label' => 'Description',
				])
				->add('name_img', TextType::class, [
						'label' => "Nom de l'image",
				])
				->add('alt_img', TextType::class, [
						'label' => "Attribut Alt de l'image",
				])
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
				->add('productCategory', null, [
						'label' => 'Catégorie de produit',
				])
				->add('subcategory', null, [
						'label'    => 'Sous-catégorie',
						'multiple' => true,
				])
				->add('mantraProducts', null, [
						'label'    => 'Mantras',
						'multiple' => true,
						'required' => false
				])
				->add('tva', null, [
						'label' => 'TVA',
				])
				->add('active', ChoiceType::class, [
						'choices' => [
								'Actif'   => true,
								'Inactif' => false,
						],
				])
				->add('favourite', ChoiceType::class, [
						'label' => 'Coup de coeur',
						'choices' => [
								'Oui' => true,
								'Non' => false
						]
				])
				->add('specialOffer', null, [
						'label' => 'Promotion'
				])
				->add('weight', IntegerType::class, [
						'label' => 'Poids en grammes'
				])
				->add('submit', SubmitType::class, [
						'label' => 'Sauvegarder',
				]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				                       'data_class' => Product::class,
		                       ]);
	}
}
