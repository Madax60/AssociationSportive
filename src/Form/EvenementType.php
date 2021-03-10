<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Categorie', EntityType::class, [
                'class' => Categorie::class,
                'placeholder' => 'Sélectionnez la catégorie',
                'required' => false
            ])
            ->add("Nom", TextType::class)
            ->add('description')
            ->add('date_debut')
            ->add('nombre_places')
            ->add('image')
            ->add('vignette')
            ->add('duree')
            ->add('date_fin')
            ->add('Sport', EntityType::class, [
                'class' => Sport::class,
                'placeholder' => 'Sélectionnez le sport',
                'required' => true
            ])
            ->add('Type', EntityType::class, [
                'class' => Type::class,
                'placeholder' => 'Sélectionnez le type',
                'required' => true
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
