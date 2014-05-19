<?php
namespace SM\Bundle\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="productos")
*/
class Producto
{
	/** 
	* @ORM\Id
	* @ORM\Column(type="integer") 
	* @ORM\GeneratedValue
	*/
	private $id;

	/** @ORM\Column(type="string", length=50, unique=true) */
	private $codigo;

    /** @ORM\Column(type="string", length=100, unique=true) */
    private $descripcion;

    /** @ORM\Column(type="integer") */
    private $existencia;

    /** @ORM\Column(type="decimal") */
    private $precio;

	/** 
    * @ORM\ManyToOne(targetEntity="SM\Bundle\AdminBundle\Entity\ClaseProducto") 
    * @ORM\JoinColumn(name="clase_producto_id", referencedColumnName="id", nullable=false)
    */
	private $claseProducto;

    public function toJSON(){
        return json_encode(
            array(
                'id' => $this->id, 
                'codigo' => $this->codigo, 
                'descripcion' => $this->descripcion, 
                'existencia' => $this->existencia,
                'precio' => $this->precio
                )
            );
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
     * Set codigo
     *
     * @param string $codigo
     * @return Producto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Producto
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
     * Set existencia
     *
     * @param string $existencia
     * @return Producto
     */
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    /**
     * Get existencia
     *
     * @return integer 
     */
    public function getExistencia()
    {
        return $this->existencia;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set claseProducto
     *
     * @param \SM\Bundle\AdminBundle\Entity\ClaseProducto $claseProducto
     * @return Producto
     */
    public function setClaseProducto(\SM\Bundle\AdminBundle\Entity\ClaseProducto $claseProducto)
    {
        $this->claseProducto = $claseProducto;

        return $this;
    }

    /**
     * Get claseProducto
     *
     * @return \SM\Bundle\AdminBundle\Entity\ClaseProducto 
     */
    public function getClaseProducto()
    {
        return $this->claseProducto;
    }

    public function __toString()
    {
        return $this->descripcion;
    }
}
