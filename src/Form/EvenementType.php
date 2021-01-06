<?php

namespace App\Form;

use App\Entity\Evenement;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Sport_id')
            ->add('Type_id')
            ->add('Categorie_id')
            ->add('nom')
            ->add('description')
            ->add('date_debut')
            ->add('nombre_places')
            ->add('image')
            ->add('vignette')
            ->add('duree')
            ->add('date_fin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
