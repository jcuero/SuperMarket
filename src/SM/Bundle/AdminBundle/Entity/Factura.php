<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="facturas")
*/
class Factura
{
	/** 
	* @ORM\Id
	* @ORM\Column(type="integer") 
	* @ORM\GeneratedValue
	*/
	private $id;

	/** @ORM\Column(type="date") */
	private $fecha;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Cliente") 
    * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=false)
    */
    private $cliente;

    /** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Empleado") 
    * @ORM\JoinColumn(name="empleado_id", referencedColumnName="id", nullable=false)
    */
    private $empleado;
    
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
     * @return Factura
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
     * Set cliente
     *
     * @param \SM\Bundle\AdminBundle\Entity\Cliente $cliente
     * @return Factura
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
     * Set empleado
     *
     * @param \SM\Bundle\AdminBundle\Entity\Empleado $empleado
     * @return Factura
     */
    public function setEmpleado(\SM\Bundle\AdminBundle\Entity\Empleado $empleado)
    {
        $this->empleado = $empleado;

        return $this;
    }

    /**
     * Get empleado
     *
     * @return \SM\Bundle\AdminBundle\Entity\Empleado 
     */
    public function getEmpleado()
    {
        return $this->empleado;
    }
}
