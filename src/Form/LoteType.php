<?php

namespace App\Form;

use App\Entity\Lote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numerolote', null, ['label' => 'Número de lote'])
            ->add('fechaelaboracion', null, ['label' => 'Fecha de elaboración'])
            ->add('fechavencimiento', null, ['label' => 'Fecha de vencimiento'])
            ->add('idalmacen', null, ['label' => 'Almacén'])
            ->add('idarticulo', null, ['label' => 'Artículo'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lote::class,
        ]);
    }
}
