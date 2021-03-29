<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Classe;
use App\Entity\Eleve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Category', EntityType::class, [
                'class' => Category::class,
                'placeholder' => 'Sélectionnez la categorie',
                'required' => true,
            ])
            ->add('date_naissance', DateType::class)
            ->add('nom')
            ->add('prenom')
            ->add('genre', ChoiceType::class, [
                'choices'  => [
                    'Masculin' => 0,
                    'Féminin' => 1,
                ],
            ])
            ->add('archivee', ChoiceType::class, [
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ],
            ])
            ->add('Classe', EntityType::class, [
                'class' => Classe::class,
                'placeholder' => 'Sélectionnez la classe',
                'required' => true,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
