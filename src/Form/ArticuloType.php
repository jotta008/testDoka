<?php

namespace App\Form;

use App\Entity\Articulo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticuloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('gtin')
            ->add('codigointerno', null, ['label' => 'Código interno'])
            ->add('fraccionable')
            ->add('unidaddefraccion', null, ['label' => 'Unidad de fracción'])
            ->add('precioventa', null, ['label' => 'Precio de venta artículo'])
            ->add('preciocompra', null, ['label' => 'Precio de compra artículo'])
            ->add('idalmacen', null, ['label' => 'Almacén'])
            ->add('idlaboratorio', null, ['label' => 'Laboratorio'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
