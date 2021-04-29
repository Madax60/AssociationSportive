<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Eleve;
// use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Prenom', TextType::class, [
            'label' => 'Prénom',
            'required' => true
        ])
        ->add('Nom', TextType::class, [
            'required' => true
        ])
        ->add('date_naissance', DateType::class)
        ->add('genre', ChoiceType::class, array(
            'choices'=> array(
                'Homme'=>'Homme',
                'Femme'=>'Femme'
            )
        ))
        ->add('Category', EntityType::class, [
            'class' => Category::class,
            'placeholder' => 'Sélectionnez la catégorie',
        ])
        ->add('roles', ChoiceType::class, [
            'choices' => [
                'Utilisateur' => 'ROLE_USER',
                'Administrateur' => 'ROLE_ADMIN'
            ],
            'expanded' => true,
            'multiple' => true,
            'label' => 'Rôles',
            'required' => true
        ])
        ->add('email', TextType::class, [
            // 'class' => User::class,
            'required' => true

        ])
        ->add('plainPassword', PasswordType::class, [
            'label' => 'Mot de passe',
            'required' => true,
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer un mot de passe',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('agreeTerms', CheckboxType::class, [
            'label' => 'Accepter les termes',
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter nos termes.',
                ]),
            ],
        ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
    