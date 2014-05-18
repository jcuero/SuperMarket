<?php
namespace SM\Bundle\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\Empleado;

class Empleados extends AbstractFixture implements OrderedFixtureInterface
{
	
	public function getOrder()
	{
		return 4;
	}

 	public function load(ObjectManager $manager)
 	{

 		for ($i=1; $i <= 30 ; $i++) 
 		{ 
 			$entity = new Empleado();
 			$entity->setNombres("nombres-".$i);
 			$entity->setApellidos("apellidos-".$i);
 			$entity->setCedula(1112000000+$i);

 			$manager->persist($entity);
 		}
		
 		$manager->flush();
 	}
}
