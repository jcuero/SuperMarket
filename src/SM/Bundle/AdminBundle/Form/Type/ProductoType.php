<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo', null, array('attr' => array('placeholder' => 'Ingrese el código', 'class' => 'form-control', 'title' => "Ingrese el código" )))
            ->add('descripcion', null, array('attr' => array('placeholder' => 'Ingrese la descripcion del producto', 'class' => 'form-control', 'title' => "Ingrese la descripcion del producto" )))
            ->add('existencia', null, array('attr' => array('placeholder' => 'Ingrese la existencia del producto', 'class' => 'form-control', 'title' => "Ingrese la existencia del producto" )))
            ->add('precio', null, array('attr' => array('placeholder' => 'Ingrese el precio', 'class' => 'form-control', 'title' => "Ingrese el precio" )))
            ->add('claseProducto', null, array('attr' => array('placeholder' => 'Ingrese la clase o tipo del producto', 'class' => 'form-control', 'title' => "Ingrese la clase o tipo del producto" )))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\Producto',
    	));
	}

    public function getName()
    {
        return 'sm_admin_productoType';
    }
}