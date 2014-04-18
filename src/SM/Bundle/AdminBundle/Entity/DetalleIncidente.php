<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="detalles_incidentes")
*/
class DetalleIncidente
{
	/** 
	* @ORM\Id
	* @ORM\Column(type="integer") 
	* @ORM\GeneratedValue
	*/
	private $id;

	/** @ORM\Column(type="date") */
	private $fecha;

    /** @ORM\Column(type="string", length=255) */
    private $descripcion;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Cliente") 
    * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=false)
    */
    private $cliente;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\TipoIncidente") 
    * @ORM\JoinColumn(name="tipos_incidentes_id", referencedColumnName="id", nullable=false)
    */
    private $tipoIncidente;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Empleado") 
    * @ORM\JoinColumn(name="empleado_recibe_id", referencedColumnName="id", nullable=false)
    */
    private $empleadoRecibe;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Empleado") 
    * @ORM\JoinColumn(name="empleado_responde_id", referencedColumnName="id", nullable=false)
    */
    private $empleadoResponde;
        

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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return DetalleIncidente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return DetalleIncidente
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set cliente
     *
     * @param \SM\Bundle\AdminBundle\Entity\Cliente $cliente
     * @return DetalleIncidente
     */
    public function setCliente(\SM\Bundle\AdminBundle\Entity\Cliente $cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \SM\Bundle\AdminBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set tipoIncidente
     *
     * @param \SM\Bundle\AdminBundle\Entity\TipoIncidente $tipoIncidente
     * @return DetalleIncidente
     */
    public function setTipoIncidente(\SM\Bundle\AdminBundle\Entity\TipoIncidente $tipoIncidente)
    {
        $this->tipoIncidente = $tipoIncidente;

        return $this;
    }

    /**
     * Get tipoIncidente
     *
     * @return \SM\Bundle\AdminBundle\Entity\TipoIncidente 
     */
    public function getTipoIncidente()
    {
        return $this->tipoIncidente;
    }

    /**
     * Set empleadoRecibe
     *
     * @param \SM\Bundle\AdminBundle\Entity\Empleado $empleadoRecibe
     * @return DetalleIncidente
     */
    public function setEmpleadoRecibe(\SM\Bundle\AdminBundle\Entity\Empleado $empleadoRecibe)
    {
        $this->empleadoRecibe = $empleadoRecibe;

        return $this;
    }

    /**
     * Get empleadoRecibe
     *
     * @return \SM\Bundle\AdminBundle\Entity\Empleado 
     */
    public function getEmpleadoRecibe()
    {
        return $this->empleadoRecibe;
    }

    /**
     * Set empleadoResponde
     *
     * @param \SM\Bundle\AdminBundle\Entity\Empleado $empleadoResponde
     * @return DetalleIncidente
     */
    public function setEmpleadoResponde(\SM\Bundle\AdminBundle\Entity\Empleado $empleadoResponde)
    {
        $this->empleadoResponde = $empleadoResponde;

        return $this;
    }

    /**
     * Get empleadoResponde
     *
     * @return \SM\Bundle\AdminBundle\Entity\Empleado 
     */
    public function getEmpleadoResponde()
    {
        return $this->empleadoResponde;
    }
}
