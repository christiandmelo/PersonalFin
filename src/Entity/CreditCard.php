<?php

namespace App\Entity;

use App\Repository\CreditCardRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreditCardRepository::class)
 */
class CreditCard
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
     * @ORM\Column(type="string", length=100)
     */
    private $Name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $ClosingDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DueDate;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $AmountLimit;

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

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

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

    public function getClosingDay(): ?int
    {
        return $this->ClosingDay;
    }

    public function setClosingDay(int $ClosingDay): self
    {
        $this->ClosingDay = $ClosingDay;

        return $this;
    }

    public function getDueDate(): ?DateTime
    {
        return $this->DueDate;
    }

    public function setDueDate(DateTime $DueDate): self
    {
        $this->DueDate = $DueDate;

        return $this;
    }

    public function getAmountLimit(): ?string
    {
        return $this->AmountLimit;
    }

    public function setAmountLimit(string $AmountLimit): self
    {
        $this->AmountLimit = $AmountLimit;

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
