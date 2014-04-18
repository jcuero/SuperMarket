<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="tipos_incidentes")
*/
class TipoIncidente
{
	/** 
	* @ORM\Id
	* @ORM\Column(type="integer") 
	* @ORM\GeneratedValue
	*/
	private $id;

	/** @ORM\Column(type="string", length=100, unique=true) */
	private $tipo;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return TipoIncidente
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    public function __toString()
    {
        return $this->tipo;
    }
}
