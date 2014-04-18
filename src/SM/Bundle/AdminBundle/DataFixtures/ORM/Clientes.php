<?php
 namespace Cupon\departamentoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\Cliente;

class Clientes extends AbstractFixture implements OrderedFixtureInterface
{
	
	public function getOrder()
	{
		return 3;
	}

 	public function load(ObjectManager $manager)
 	{
 		$min =  1; // clave primaria de la primer ciudad en la db
		$max = 60; // clave primaria de la ultimo ciudad en la db

 		for ($i=1; $i <= 15 ; $i++) 
 		{ 
 			$entity = new Cliente();
 			$entity->setNombres("nombres-".$i);
 			$entity->setApellidos("apellidos-".$i);
 			$entity->setCedula(1112000000+$i);
 			$entity->setDireccion("Calle ".$i);
 			$entity->setEmail("cliente".$i."@correo.com");
 			$entity->setPlazoFactura(new \DateTime());
 			$entity->setTelefono(3120000000+$i);

 			$entity->setCiudad($manager->find('SMAdminBundle:Ciudad' , rand($min,$max)));

 			$manager->persist($entity);
 		}
		
 		$manager->flush();
 	}
}
