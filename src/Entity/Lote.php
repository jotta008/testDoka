<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Lote
 *
 * @ORM\Table(name="lote", indexes={@ORM\Index(name="FK_lote_articulo", columns={"idArticulo"}), @ORM\Index(name="FK_lote_almacen", columns={"idAlmacen"})})
 * @ORM\Entity
 */
class Lote
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
     * @var int
     *
     * @ORM\Column(name="numeroLote", type="integer", nullable=false)
     */
    private $numerolote;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaElaboracion", type="datetime", nullable=false)
     */
    private $fechaelaboracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="datetime", nullable=false)
     */
    private $fechavencimiento;

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
     * @var \Articulo
     *
     * @ORM\ManyToOne(targetEntity="Articulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idArticulo", referencedColumnName="id")
     * })
     */
    private $idarticulo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumerolote(): ?int
    {
        return $this->numerolote;
    }

    public function setNumerolote(int $numerolote): self
    {
        $this->numerolote = $numerolote;

        return $this;
    }

    public function getFechaelaboracion(): ?\DateTimeInterface
    {
        return $this->fechaelaboracion;
    }

    public function setFechaelaboracion(\DateTimeInterface $fechaelaboracion): self
    {
        $this->fechaelaboracion = $fechaelaboracion;

        return $this;
    }

    public function getFechavencimiento(): ?\DateTimeInterface
    {
        return $this->fechavencimiento;
    }

    public function setFechavencimiento(\DateTimeInterface $fechavencimiento): self
    {
        $this->fechavencimiento = $fechavencimiento;

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

    public function getIdarticulo(): ?Articulo
    {
        return $this->idarticulo;
    }

    public function setIdarticulo(?Articulo $idarticulo): self
    {
        $this->idarticulo = $idarticulo;

        return $this;
    }


}
