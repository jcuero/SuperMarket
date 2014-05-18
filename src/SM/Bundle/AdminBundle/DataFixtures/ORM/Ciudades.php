<?php
namespace SM\Bundle\AdminBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\Ciudad;

class Ciudades extends AbstractFixture implements OrderedFixtureInterface
{

	public function getOrder()
	{
		return 2;
	}

	public function load(ObjectManager $manager)
	{
		$min =  1; // clave primaria del primer departamento en la db
		$max = 15; // clave primaria del ultimo departamento en la db

		for ($i=1; $i <= 60 ; $i++) 
		{ 
			$entidad = new Ciudad();
			$entidad->setNombre("ciudad-".$i);

			$entidad->setDepartamento($manager->find('SMAdminBundle:Departamento' , rand($min,$max)));

			$manager->persist($entidad);
		}
		
		$manager->flush();
	}
}
