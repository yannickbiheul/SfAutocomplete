<?php

namespace App\Form;

use App\Entity\Choix;
use App\Entity\Personne;
use App\Entity\Simple;
use Symfony\Component\Form\AbstractType;
use App\Form\SimpleChoixAutocompleteField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimpleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('choix', SimpleChoixAutocompleteField::class)
            ->add('personne', EntityType::class, [
                'class' => Personne::class,
                'placeholder' => 'Entrez un nom',
                'autocomplete' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Simple::class,
        ]);
    }
}
