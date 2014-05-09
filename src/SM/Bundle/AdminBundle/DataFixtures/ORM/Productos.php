<?php
namespace Cupon\departamentoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\Producto;

class Productos extends AbstractFixture implements OrderedFixtureInterface
{

	public function getOrder()
	{
		return 6;
	}

	public function load(ObjectManager $manager)
	{
		$min =  1; // clave primaria del primer departamento en la db
		$max = 20; // clave primaria del ultimo departamento en la db

		for ($i=1; $i <= 60 ; $i++) 
		{ 
			$entidad = new Producto();
			$entidad->setCodigo("XYZ-".$i);
			$entidad->setExistencia(rand(0, 50));
			$entidad->setDescripcion("producto-".$i);
			$entidad->setPrecio(rand(2500, 10000));

			$entidad->setClaseProducto($manager->find('SMAdminBundle:ClaseProducto' , rand($min,$max)));

			$manager->persist($entidad);
		}
		
		$manager->flush();
	}
}
