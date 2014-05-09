<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ClienteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellidos', null, array('attr' => array('placeholder' => 'Ingrese sus apellidos', 'class' => 'form-control', 'title' => "Ingrese sus apellidos" )))
            ->add('cedula', null, array('attr' => array('placeholder' => 'Ingrese su cedula', 'class' => 'form-control', 'title' => "Ingrese su cedula" )))
            ->add('direccion', null, array('attr' => array('placeholder' => 'Ingrese su direccion de residencia', 'class' => 'form-control', 'title' => "Ingrese su direccion de residencia" )))
            ->add('email', null, array('attr' => array('placeholder' => 'Ingrese su correo electronico', 'class' => 'form-control', 'title' => "Ingrese su correo electronico" )))
            ->add('nombres', null, array('attr' => array('placeholder' => 'Ingrese sus nombres', 'class' => 'form-control', 'title' => "Ingrese sus nombres" )))
            ->add('telefono', null, array('attr' => array('placeholder' => 'Ingrese su número telefonico', 'class' => 'form-control', 'title' => "Ingrese su número telefonico" )))
            ->add('ciudad', null, array('attr' => array('placeholder' => 'Ingrese su ciudad de origen', 'class' => 'form-control', 'title' => "Ingrese su ciudad de origen" )))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\Cliente',
    	));
	}

    public function getName()
    {
        return 'sm_admin_clienteType';
    }
}