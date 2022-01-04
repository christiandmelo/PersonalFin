<?php

namespace App\Entity;

use App\Repository\RecurringEntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecurringEntryRepository::class)
 */
class RecurringEntry
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
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class)
     */
    private $bankAccount;

    /**
     * @ORM\ManyToOne(targetEntity=CreditCard::class)
     */
    private $creditCard;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class)
     */
    private $payment;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $recurrent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fixedDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $automaticWithdrawal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): self
    {
        $this->category = $category;

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

    public function getCreditCard(): ?creditCard
    {
        return $this->creditCard;
    }

    public function setCreditCard(?creditCard $creditCard): self
    {
        $this->creditCard = $creditCard;

        return $this;
    }

    public function getPayment(): ?payment
    {
        return $this->payment;
    }

    public function setPayment(?payment $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getRecurrent(): ?bool
    {
        return $this->recurrent;
    }

    public function setRecurrent(bool $recurrent): self
    {
        $this->recurrent = $recurrent;

        return $this;
    }

    public function getFixedDay(): ?bool
    {
        return $this->fixedDay;
    }

    public function setFixedDay(bool $fixedDay): self
    {
        $this->fixedDay = $fixedDay;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getAutomaticWithdrawal(): ?bool
    {
        return $this->automaticWithdrawal;
    }

    public function setAutomaticWithdrawal(bool $automaticWithdrawal): self
    {
        $this->automaticWithdrawal = $automaticWithdrawal;

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
