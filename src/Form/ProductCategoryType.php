<?php

namespace App\Form;

use App\Entity\ProductCategory;
use App\Entity\ProductSubcategory;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCategoryType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, [
						'label' => 'Nom de la catégorie',
				])
				->add('subcategories', EntityType::class, [
						'class'         => ProductSubcategory::class,
						'label'         => 'Sous-catégories',
						'multiple'      => true,
						'required'      => false,
						'query_builder' => function (EntityRepository $er) {
							return $er->createQueryBuilder('sc')
									->orderBy('sc.name', 'ASC');
						},
				])
				->add('active', ChoiceType::class, [
						'choices' => [
								'Active'   => true,
								'Inactive' => false,
						],
				])
				->add('submit', SubmitType::class, [
						'label' => 'Sauvegarder',
				]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				                       'data_class' => ProductCategory::class,
		                       ]);
	}
}
