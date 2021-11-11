<?php

namespace App\Form;

use App\Entity\Distance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DistanceType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				->add('title')
				->add('duration', IntegerType::class, [
						'label' => 'Durée en chiffre',
				])
				->add('unity', ChoiceType::class, [
						'label'   => 'Jours/Mois/Années',
						'choices' => [
								'Jours'  => 'days',
								'Mois'   => 'months',
								'Années' => 'years',
						],
				]);
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefaults([
				                       'data_class' => Distance::class,
		                       ]);
	}
}
