<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CiudadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array('attr' => array('placeholder' => 'Ingrese el nombre', 'class' => 'form-control', 'title' => "Ingrese el nombre" )))
            ->add('departamento', null, array('attr' => array('placeholder' => 'Ingrese el departamento', 'class' => 'form-control', 'title' => "Ingrese el departamento al cual pertenece la ciudad" )))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\Ciudad',
    	));
	}

    public function getName()
    {
        return 'sm_admin_clienteType';
    }
}