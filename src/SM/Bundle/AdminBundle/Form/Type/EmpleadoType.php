<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpleadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('apellidos', null, array('attr' => array('placeholder' => 'Ingrese sus apellidos', 'class' => 'form-control')))
            ->add('cedula', null, array('attr' => array('placeholder' => 'Ingrese su cedula', 'class' => 'form-control')))
            ->add('nombres', null, array('attr' => array('placeholder' => 'Ingrese sus nombres', 'class' => 'form-control')))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\Empleado',
    	));
	}

    public function getName()
    {
        return 'sm_admin_empleadotype';
    }
}