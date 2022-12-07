<?php

namespace App\Form;

use App\Entity\Choix;
use App\Entity\Multiple;
use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use App\Form\MultipleChoixAutocompleteField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MultipleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('choix', MultipleChoixAutocompleteField::class)
            ->add('choix', EntityType::class, [
                'class' => Personne::class,
                'choice_label' => 'nom',
                'placeholder' => 'Choisissez une personne dans la liste',
                'autocomplete' => true,
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Multiple::class,
        ]);
    }
}
