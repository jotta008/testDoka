<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articulo
 *
 * @ORM\Table(name="articulo", indexes={@ORM\Index(name="FK_articulo_laboratorio", columns={"idLaboratorio"}), @ORM\Index(name="FK_articulo_almacen", columns={"idAlmacen"})})
 * @ORM\Entity
 */
class Articulo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=500, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="gtin", type="string", length=200, nullable=false)
     */
    private $gtin;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoInterno", type="string", length=10, nullable=false)
     */
    private $codigointerno;

    /**
     * @var bool
     *
     * @ORM\Column(name="fraccionable", type="boolean", nullable=false, options={"default"="1","comment"="1: Si, 2: No"})
     */
    private $fraccionable = true;

    /**
     * @var int
     *
     * @ORM\Column(name="unidadDeFraccion", type="integer", nullable=false)
     */
    private $unidaddefraccion;

    /**
     * @var float
     *
     * @ORM\Column(name="precioVenta", type="float", precision=10, scale=0, nullable=false)
     */
    private $precioventa;

    /**
     * @var float
     *
     * @ORM\Column(name="precioCompra", type="float", precision=10, scale=0, nullable=false)
     */
    private $preciocompra;

    /**
     * @var \Almacen
     *
     * @ORM\ManyToOne(targetEntity="Almacen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAlmacen", referencedColumnName="id")
     * })
     */
    private $idalmacen;

    /**
     * @var \Laboratorio
     *
     * @ORM\ManyToOne(targetEntity="Laboratorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idLaboratorio", referencedColumnName="id")
     * })
     */
    private $idlaboratorio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getGtin(): ?string
    {
        return $this->gtin;
    }

    public function setGtin(string $gtin): self
    {
        $this->gtin = $gtin;

        return $this;
    }

    public function getCodigointerno(): ?string
    {
        return $this->codigointerno;
    }

    public function setCodigointerno(string $codigointerno): self
    {
        $this->codigointerno = $codigointerno;

        return $this;
    }

    public function isFraccionable(): ?bool
    {
        return $this->fraccionable;
    }

    public function setFraccionable(bool $fraccionable): self
    {
        $this->fraccionable = $fraccionable;

        return $this;
    }

    public function getUnidaddefraccion(): ?int
    {
        return $this->unidaddefraccion;
    }

    public function setUnidaddefraccion(int $unidaddefraccion): self
    {
        $this->unidaddefraccion = $unidaddefraccion;

        return $this;
    }

    public function getPrecioventa(): ?float
    {
        return $this->precioventa;
    }

    public function setPrecioventa(float $precioventa): self
    {
        $this->precioventa = $precioventa;

        return $this;
    }

    public function getPreciocompra(): ?float
    {
        return $this->preciocompra;
    }

    public function setPreciocompra(float $preciocompra): self
    {
        $this->preciocompra = $preciocompra;

        return $this;
    }

    public function getIdalmacen(): ?Almacen
    {
        return $this->idalmacen;
    }

    public function setIdalmacen(?Almacen $idalmacen): self
    {
        $this->idalmacen = $idalmacen;

        return $this;
    }

    public function getIdlaboratorio(): ?Laboratorio
    {
        return $this->idlaboratorio;
    }

    public function setIdlaboratorio(?Laboratorio $idlaboratorio): self
    {
        $this->idlaboratorio = $idlaboratorio;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNombre(); 
    }

}
