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
    private $creditCard;

    /**
     * @ORM\Column(type="decimal", precision=18, scale=4)
     */
    private $totalCreditCardBill;

    /**
     * @ORM\Column(type="datetime")
     */
    private $closingDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dueDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $closed;

    /**
     * @ORM\Column(type="datetime")
     */
    private $payDay;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $bankAccount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreditCard(): ?creditCard
    {
        return $this->creditCard;
    }

    public function setCreditCard(?creditCard $creditCard): self
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    public function getTotalCreditCardBill(): ?string
    {
        return $this->totalCreditCardBill;
    }

    public function setTotalCreditCardBill(string $totalCreditCardBill): self
    {
        $this->totalCreditCardBill = $totalCreditCardBill;

        return $this;
    }

    public function getClosingDay(): ?\DateTimeInterface
    {
        return $this->closingDay;
    }

    public function setClosingDay(\DateTimeInterface $closingDay): self
    {
        $this->closingDay = $closingDay;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getClosed(): ?bool
    {
        return $this->closed;
    }

    public function setClosed(bool $closed): self
    {
        $this->closed = $closed;

        return $this;
    }

    public function getPayDay(): ?\DateTimeInterface
    {
        return $this->payDay;
    }

    public function setPayDay(\DateTimeInterface $payDay): self
    {
        $this->payDay = $payDay;

        return $this;
    }

    public function getBankAccount(): ?bankAccount
    {
        return $this->bankAccount;
    }

    public function setBankAccount(?bankAccount $bankAccount): self
    {
        $this->bankAccount = $bankAccount;

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
}
