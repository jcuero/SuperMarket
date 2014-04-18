<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="empleados")
*/
class Empleado
{
	/** 
    * @ORM\Id
    * @ORM\Column(type="integer") 
    * @ORM\GeneratedValue
    */
    private $id;

    /** @ORM\Column(type="string", length=100) */
    private $apellidos;

    /** @ORM\Column(type="integer", unique=true) */
    private $cedula;

    /** @ORM\Column(type="string", length=100) */
    private $nombres;

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
     * Set apellidos
     *
     * @param string $apellidos
     * @return Cliente
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set cedula
     *
     * @param integer $cedula
     * @return Cliente
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return integer 
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set nombres
     *
     * @param string $nombres
     * @return Cliente
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    public function nombreCompleto()
    {
       return $this->nombres.' '.$this->apellidos;
    }

    public function __toString()
    {
       return $this->nombres.' '.$this->apellidos;
    }

}
