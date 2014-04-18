<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="detalles_facturas")
*/
class DetalleFactura
{

    /** 
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Factura") 
    * @ORM\JoinColumn(name="factura_id", referencedColumnName="id", nullable=false)
    */
    private $factura;

    /** 
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\Producto") 
    * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=false)
    */
    private $producto;

    /** @ORM\Column(type="decimal") */
    private $cantidad;
    
    /**
     * Set cantidad
     *
     * @param string $cantidad
     * @return DetalleFactura
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set factura
     *
     * @param \SM\Bundle\AdminBundle\Entity\Factura $factura
     * @return DetalleFactura
     */
    public function setFactura(\SM\Bundle\AdminBundle\Entity\Factura $factura)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \SM\Bundle\AdminBundle\Entity\Factura 
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set producto
     *
     * @param \SM\Bundle\AdminBundle\Entity\Producto $producto
     * @return DetalleFactura
     */
    public function setProducto(\SM\Bundle\AdminBundle\Entity\Producto $producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return \SM\Bundle\AdminBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }
}
