<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TempRepository")
 */
class Temp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $boltest;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBoltest(): ?bool
    {
        return $this->boltest;
    }

    public function setBoltest(?bool $boltest): self
    {
        $this->boltest = $boltest;

        return $this;
    }
}
