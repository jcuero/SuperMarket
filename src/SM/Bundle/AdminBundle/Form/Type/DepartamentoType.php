<?php

namespace SM\Bundle\AdminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DepartamentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('save', 'submit');
    }

	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
	    $resolver->setDefaults(array(
    	    'data_class' => 'SM\Bundle\AdminBundle\Entity\Departamento',
    	));
	}

    public function getName()
    {
        return 'departamentoType';
    }
}