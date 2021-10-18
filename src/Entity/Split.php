<?php

namespace App\Entity;

use App\Repository\SplitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SplitRepository::class)
 */
class Split
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $FixedPercentage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getFixedPercentage(): ?bool
    {
        return $this->FixedPercentage;
    }

    public function setFixedPercentage(bool $FixedPercentage): self
    {
        $this->FixedPercentage = $FixedPercentage;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }
}
