<?php

namespace App\Entity;

use App\Repository\CreditCardBillRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreditCardBillRepository::class)
 */
class CreditCardBill
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=CreditCard::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $CreditCard;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=4)
     */
    private $TotalCreditCardBill;

    /**
     * @ORM\Column(type="datetime")
     */
    private $ClosingDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DueDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Closed;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PayDay;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $BankAccount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreditCard(): ?CreditCard
    {
        return $this->CreditCard;
    }

    public function setCreditCard(?CreditCard $CreditCard): self
    {
        $this->CreditCard = $CreditCard;

        return $this;
    }

    public function getTotalCreditCardBill(): ?string
    {
        return $this->TotalCreditCardBill;
    }

    public function setTotalCreditCardBill(string $TotalCreditCardBill): self
    {
        $this->TotalCreditCardBill = $TotalCreditCardBill;

        return $this;
    }

    public function getClosingDay(): ?\DateTimeInterface
    {
        return $this->ClosingDay;
    }

    public function setClosingDay(\DateTimeInterface $ClosingDay): self
    {
        $this->ClosingDay = $ClosingDay;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->DueDate;
    }

    public function setDueDate(\DateTimeInterface $DueDate): self
    {
        $this->DueDate = $DueDate;

        return $this;
    }

    public function getClosed(): ?bool
    {
        return $this->Closed;
    }

    public function setClosed(bool $Closed): self
    {
        $this->Closed = $Closed;

        return $this;
    }

    public function getPayDay(): ?\DateTimeInterface
    {
        return $this->PayDay;
    }

    public function setPayDay(\DateTimeInterface $PayDay): self
    {
        $this->PayDay = $PayDay;

        return $this;
    }

    public function getBankAccount(): ?BankAccount
    {
        return $this->BankAccount;
    }

    public function setBankAccount(?BankAccount $BankAccount): self
    {
        $this->BankAccount = $BankAccount;

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
