<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="clientes")
*/
class Cliente
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
    private $direccion;

    /** @ORM\Column(type="string", length=100) */
    private $email;

    /** @ORM\Column(name="fecha_creacion", type="date") */
    private $fechaCreacion;

    /** @ORM\Column(type="string", length=100) */
    private $nombres;

    /** @ORM\Column(name="plazo_factura", type="date", nullable=true) */
    private $plazoFactura;

    /** @ORM\Column(type="integer") */
    private $telefono;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Ciudad") 
    * @ORM\JoinColumn(name="ciudad_id", referencedColumnName="id", nullable=false)
    */
    private $ciudad;

    public function __construct()
    {
        $this->fechaCreacion = new \DateTime();
    }

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
     * Set direccion
     *
     * @param string $direccion
     * @return Cliente
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Cliente
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
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

    /**
     * Set plazoFactura
     *
     * @param \DateTime $plazoFactura
     * @return Cliente
     */
    public function setPlazoFactura($plazoFactura)
    {
        $this->plazoFactura = $plazoFactura;

        return $this;
    }

    /**
     * Get plazoFactura
     *
     * @return \DateTime 
     */
    public function getPlazoFactura()
    {
        return $this->plazoFactura;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Cliente
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set ciudad
     *
     * @param \SM\Bundle\AdminBundle\Entity\Ciudad $ciudad
     * @return Cliente
     */
    public function setCiudad(\SM\Bundle\AdminBundle\Entity\Ciudad $ciudad = null)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return \SM\Bundle\AdminBundle\Entity\Ciudad 
     */
    public function getCiudad()
    {
        return $this->ciudad;
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
