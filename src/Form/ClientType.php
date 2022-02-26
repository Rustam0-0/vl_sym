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
                'constraints' => [
                new NotBlank(),
                new Regex('/(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,})$/')
            ],
                'attr' => ['class' => 'form-control', 'required' => 'required']
            ])

            ->add('password', RepeatedType::class, [
                'invalid_message' => 'Veuillez indiquez le même mot de passe et mettre 8 caractéres dont une majuscule et un symbole',
                'first_options'  => ['label' => 'Mot de passe','attr' => [ 'required' => 'required']],
                'second_options' => ['label' => 'Confirmation de mot de passe','attr' => [ 'required' =>true]],
            ])

            ->add('name', TextType::class, [
                'constraints' => [
                new NotBlank(),
                new Regex('/^[a-zA-Z]{2,}$/')
            ],
                'attr' => ['class' => 'form-control', 'required' => true]
            ])

            ->add('surname', TextType::class, ['constraints' => [
                new NotBlank(),
                new Regex('/[a-zA-Z]{2,}$/')
            ],
                'attr' => ['class' => 'form-control', 'required' => true]])

            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('address_complete', TextType::class, ['label' => 'Complément d\'adresse'])
            ->add('zipcode', TextType::class, ['label' => 'Code postal'])
            ->add('city', TextType::class, ['label' => 'Ville'])
            ->add('country', EntityType::class, [
                'class' => Country::class,
                'choice_label' => 'name',
//                'query_builder' => function (CountryRepository $er) {
//                    return $er->createQueryBuilder('u')
//                        ->orderBy('u.name', 'ASC');
//                },
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
