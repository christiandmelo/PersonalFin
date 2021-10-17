<?php

namespace App\Entity;

use App\Repository\BankAccountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BankAccountRepository::class)
 */
class BankAccount
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
    private $Bank;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Investment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $DisplayInSummary;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBank(): ?Bank
    {
        return $this->Bank;
    }

    public function setBank(?Bank $Bank): self
    {
        $this->Bank = $Bank;

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

    public function getInvestment(): ?bool
    {
        return $this->Investment;
    }

    public function setInvestment(bool $Investment): self
    {
        $this->Investment = $Investment;

        return $this;
    }

    public function getDisplayInSummary(): ?bool
    {
        return $this->DisplayInSummary;
    }

    public function setDisplayInSummary(bool $DisplayInSummary): self
    {
        $this->DisplayInSummary = $DisplayInSummary;

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
