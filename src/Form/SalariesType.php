<?php

namespace App\Form;

use App\Entity\Salaries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalariesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('dateDeNaissance')
            ->add('Sexe')
            ->add('Adresse')
            ->add('codePostal')
            ->add('ville')
            ->add('courriel')
            ->add('fonction')
            ->add('dateEntree')
            ->add('salaire')
            ->add('nombrecongespris')
            ->add('nombreCongesRestants')
            ->add('cadre')
            ->add('datePassageCadre')
            ->add('societe')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Salaries::class,
        ]);
    }
}
