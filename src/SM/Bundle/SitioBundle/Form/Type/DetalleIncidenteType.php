<?php

namespace SM\Bundle\SitioBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DetalleIncidenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipoIncidente', null, array('attr' => array('placeholder' => 'Ingrese el tipo de incidente', 'class' => 'form-control', 'title' => "Ingrese el tipo de incidente" )))
            ->add('descripcion', 'textarea', array('attr' => array('placeholder' => 'Describa aquí el incidente.', 'class' => 'form-control', 'title' => "Describa aquí el incidente.", 'rows' => 6 )))

            ->add('confirmarRegistro', 'submit', array('attr' => array('value' => 'Confirmar registro', 'class' => 'btn btn-danger')));
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\DetalleIncidente',
    	));
	}

    public function getName()
    {
        return 'sm_sitio_detalleIncidente';
    }
}