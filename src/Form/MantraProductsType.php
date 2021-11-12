<?php

namespace App\Form;

use App\Entity\MantraProducts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MantraProductsType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('mantra', TextType::class, [
					'label' => 'Mantra'
				])
				->add('submit', SubmitType::class, [
						'label' => 'Sauvegarder',
				]);
        ;
    }

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
         'data_class' => MantraProducts::class,
     ]);
	}
}
