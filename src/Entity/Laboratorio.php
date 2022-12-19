<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Laboratorio
 *
 * @ORM\Table(name="laboratorio")
 * @ORM\Entity
 */
class Laboratorio
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
     * @ORM\Column(name="nombre", type="string", length=200, nullable=false)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="cuit", type="integer", nullable=false)
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="razonSocial", type="string", length=200, nullable=false)
     */
    private $razonsocial;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=200, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=10, nullable=false, options={"comment"="Codigo alfanumerico de 10 caracteres"})
     */
    private $codigo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getCuit(): ?int
    {
        return $this->cuit;
    }

    public function setCuit(int $cuit): self
    {
        $this->cuit = $cuit;

        return $this;
    }

    public function getRazonsocial(): ?string
    {
        return $this->razonsocial;
    }

    public function setRazonsocial(string $razonsocial): self
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): self
    {
        $this->codigo = $codigo;

        return $this;
    }

    // public function __toString(): string
    // {
    //     return $this->getNombre(); 
    // }


}
