<?php

namespace App\Form;

use App\Entity\PageProducts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PageProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('banner_first_img')
            ->add('banner_second_img')
            ->add('made_in_france_img')
            ->add('parfume_img')
            ->add('about_creations_img')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PageProducts::class,
        ]);
    }
}
