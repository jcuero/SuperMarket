<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="clases_productos")
*/
class ClaseProducto
{
	/** 
	* @ORM\Id
	* @ORM\Column(type="integer") 
	* @ORM\GeneratedValue
	*/
	private $id;

	/** @ORM\Column(type="string", length=100, unique=true) */
	private $nombre;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Departamento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    public function __toString()
	{
		return $this->nombre;
	}
}
