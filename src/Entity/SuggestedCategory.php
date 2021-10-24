<?php

namespace App\Entity;

use App\Repository\SuggestedCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuggestedCategoryRepository::class)
 */
class SuggestedCategory implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $ShortName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortName(): ?string
    {
        return $this->ShortName;
    }

    public function setShortName(string $ShortName): self
    {
        $this->ShortName = $ShortName;

        return $this;
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

    public function getActive(): ?bool
    {
        return $this->Active;
    }

    public function setActive(bool $Active): self
    {
        $this->Active = $Active;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'shortName' => $this->getShortName(),
            'name' => $this->getName()
        ];
    }
}
