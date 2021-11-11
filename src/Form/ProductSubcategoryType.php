<?php

namespace App\Form;

use App\Entity\ProductSubcategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSubcategoryType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, [
						'label' => 'Nom de la sous-catégorie',
				])
				->add('active', ChoiceType::class, [
						'choices' => [
								'Actif'   => true,
								'Inactif' => false,
						],
				])
				->add('submit', SubmitType::class, [
						'label' => 'Sauvegarder',
				]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				                       'data_class' => ProductSubcategory::class,
		                       ]);
	}
}
