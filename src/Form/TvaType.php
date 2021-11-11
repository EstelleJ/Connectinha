<?php

namespace App\Form;

use App\Entity\Tva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TvaType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('name', TextType::class, [
						'label' => 'Nom de la taxe',
				])
				->add('percentage', null, [
						'label' => 'Taux (%)',
				])
				->add('submit', SubmitType::class, [
						'label' => 'Sauvegarder',
				]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				                       'data_class' => Tva::class,
		                       ]);
	}
}
