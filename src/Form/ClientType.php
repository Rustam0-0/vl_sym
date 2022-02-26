<?php

namespace App\Form;

use App\Entity\Country;
use App\Repository\CountryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Regex(['pattern' => '/[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/'])
                ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])
            ->add('password', PasswordType::class, [
                'invalid_message' => 'Veuillez mettre 8 caractéres dont une majuscule et un symbole',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,})$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => 'required']
            ])
            ->add('password', RepeatedType::class, [
                'invalid_message' => 'Veuillez indiquez le même mot de passe',
                'first_options' => ['label' => 'Mot de passe', 'attr' => ['required' => 'required']],
                'second_options' => ['label' => 'Confirmation de mot de passe', 'attr' => ['required' => true]],
            ])
            ->add('name', TextType::class, [
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/^[a-zA-Z]{2,}$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[a-zA-Z]{2,}$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[a-zA-Z]{2,}$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])
            ->add('address_complete', TextType::class, [
                'label' => 'Complément d\'adresse',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[a-zA-Z]{1,}$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => false]
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Code postal',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[a-zA-Z]{2,15}$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'constraints' => [
                    new NotBlank(),
                    new Regex('/[a-zA-Z]{2,}$/')
                ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])
            ->add('country', EntityType::class, [
                'label' => 'Pays',
                'class' => Country::class,
                'choice_label' => 'name'
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
