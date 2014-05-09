<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClaseProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array('attr' => array('placeholder' => 'Ingrese la clase de producto', 'class' => 'form-control', 'title' => "Ingrese la clase de producto" )))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\ClaseProducto',
    	));
	}

    public function getName()
    {
        return 'sm_admin_claseProductoType';
    }
}