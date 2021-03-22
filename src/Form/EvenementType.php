<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Evenement;
use App\Entity\Sport;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Category', EntityType::class, [
                'class' => Category::class,
                'placeholder' => 'Sélectionnez la catégorie',
            ])
            ->add('Type', EntityType::class, [
                'class' => Type::class,
                'placeholder' => 'Sélectionnez le type',
                'required' => true,

            ])
            ->add('Sport', EntityType::class, [
                    'class' => Sport::class,
                    'placeholder' => 'Sélectionnez le sport',
                    'required' => true,

                ])
            ->add("Nom", TextType::class)
            ->add('description')
            ->add('date_debut')
            ->add('nombre_places')
            ->add('brochure', FileType::class, [
                'label' => 'Image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => 'Ce format d\'image n\'est pas pris en charge',
                ],
            ])
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
