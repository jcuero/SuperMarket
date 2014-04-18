<?php
namespace Cupon\departamentoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\ClaseProducto;

class ClaseProductos extends AbstractFixture implements OrderedFixtureInterface
{
	
	public function getOrder()
	{
		return 5;
	}

	public function load(ObjectManager $manager)
	{
		for ($i=1; $i <= 20 ; $i++) 
		{ 
			$entidad = new ClaseProducto();
			$entidad->setNombre("clase Producto-".$i);

			$manager->persist($entidad);
		}
		
		$manager->flush();
	}
}
