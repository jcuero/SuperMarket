<?php
namespace SM\Bundle\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\Departamento;

class Departamentos extends AbstractFixture implements OrderedFixtureInterface
{
	
	public function getOrder()
	{
		return 1;
	}

	public function load(ObjectManager $manager)
	{
		for ($i=1; $i <= 15 ; $i++) 
		{ 
			$entidad = new Departamento();
			$entidad->setNombre("departamento-".$i);

			$manager->persist($entidad);
		}
		
		$manager->flush();
	}
}
