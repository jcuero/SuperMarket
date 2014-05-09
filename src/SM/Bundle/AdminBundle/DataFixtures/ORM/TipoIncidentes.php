<?php
namespace Cupon\departamentoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SM\Bundle\AdminBundle\Entity\TipoIncidente;

class TipoIncidentes extends AbstractFixture implements OrderedFixtureInterface
{
	
	public function getOrder()
	{
		return 7;
	}

	public function load(ObjectManager $manager)
	{

			$entidadQuejas = new TipoIncidente();
			$entidadQuejas->setTipo("Quejas");
			$manager->persist($entidadQuejas);

			$entidadPeticiones = new TipoIncidente();
			$entidadPeticiones->setTipo("Peticiones");
			$manager->persist($entidadPeticiones);

			$entidadReclamos = new TipoIncidente();
			$entidadReclamos->setTipo("Reclamos");
			$manager->persist($entidadReclamos);
		
		
			$manager->flush();
	}
}
