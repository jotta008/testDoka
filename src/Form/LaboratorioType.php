<?php

namespace App\Form;

use App\Entity\Laboratorio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LaboratorioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('cuit')
            ->add('razonsocial', null, ['label' => 'Razón social'])
            ->add('direccion', null, ['label' => 'Dirección'])
            ->add('codigo', null, ['label' => 'Código'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Laboratorio::class,
        ]);
    }
}
