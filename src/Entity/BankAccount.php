<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankAccountRepository::class)
 */
class BankAccount implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Bank::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $bank;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $investment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $displayInSummary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBank(): ?bank
    {
        return $this->bank;
    }

    public function setBank(?bank $bank): self
    {
        $this->bank = $bank;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getInvestment(): ?bool
    {
        return $this->investment;
    }

    public function setInvestment(bool $investment): self
    {
        $this->investment = $investment;

        return $this;
    }

    public function getDisplayInSummary(): ?bool
    {
        return $this->displayInSummary;
    }

    public function setDisplayInSummary(bool $displayInSummary): self
    {
        $this->displayInSummary = $displayInSummary;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'bankId' => $this->bank->getId(),
            'name' => $this->getName(),
            'displayInSummary' => $this->getDisplayInSummary()
        ];
    }
}
