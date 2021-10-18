<?php

namespace App\Entity;

use App\Repository\SplitClientRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SplitClientRepository::class)
 */
class SplitClient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity=Split::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Split;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=4)
     */
    private $Percentage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        return $this;
    }

    public function getSplit(): ?Split
    {
        return $this->Split;
    }

    public function setSplit(?Split $Split): self
    {
        $this->Split = $Split;

        return $this;
    }

    public function getPercentage(): ?string
    {
        return $this->Percentage;
    }

    public function setPercentage(string $Percentage): self
    {
        $this->Percentage = $Percentage;

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
