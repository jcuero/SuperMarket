<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TipoIncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', null, array('attr' => array('placeholder' => 'Ingrese el tipo de incidente', 'class' => 'form-control', 'title' => "Ingrese el tipo de incidente" )))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }
    

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\TipoIncidente',
    	));
	}

    public function getName()
    {
        return 'sm_admin_tipo_incidenteType';
    }
}