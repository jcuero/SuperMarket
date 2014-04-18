<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="ciudades")
*/
class Ciudad
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
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Departamento") 
    * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id", nullable=false)
    */
	private $departamento;

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
     * @return Ciudad
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

    /**
     * Set departamento
     *
     * @param \SM\Bundle\AdminBundle\Entity\Departamento $departamento
     * @return Ciudad
     */
    public function setDepartamento(\SM\Bundle\AdminBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \SM\Bundle\AdminBundle\Entity\Departamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function __toString()
	{
		return $this->nombre;
	}
}
