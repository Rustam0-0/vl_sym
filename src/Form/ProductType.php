<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label')
            ->add('model')
            ->add('picture', FileType::class, ['mapped'=>false, 'required'=>false, 'data_class' => null])
            ->add('price')
            ->add('stock')
            ->add('details',TextareaType::class)
            ->add('description',TextareaType::class)
            ->add('date_add', HiddenType::class, ['mapped'=>false, 'data_class' => null])
            ->add('date_update', HiddenType::class, ['mapped'=>false, 'data_class' => null])
            ->add('subcat',null,['attr'=>['class'=>'custom-select']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
