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
    private $Client;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class)
     */
    private $BankAccount;

    /**
     * @ORM\ManyToOne(targetEntity=CreditCard::class)
     */
    private $CreditCard;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class)
     */
    private $Payment;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Description;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $Amount;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Recurrent;

    /**
     * @ORM\Column(type="boolean")
     */
    private $FixedDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $EndDate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $AutomaticWithdrawal;

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

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

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

    public function getCreditCard(): ?CreditCard
    {
        return $this->CreditCard;
    }

    public function setCreditCard(?CreditCard $CreditCard): self
    {
        $this->CreditCard = $CreditCard;

        return $this;
    }

    public function getPayment(): ?Payment
    {
        return $this->Payment;
    }

    public function setPayment(?Payment $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->Amount;
    }

    public function setAmount(string $Amount): self
    {
        $this->Amount = $Amount;

        return $this;
    }

    public function getRecurrent(): ?bool
    {
        return $this->Recurrent;
    }

    public function setRecurrent(bool $Recurrent): self
    {
        $this->Recurrent = $Recurrent;

        return $this;
    }

    public function getFixedDay(): ?bool
    {
        return $this->FixedDay;
    }

    public function setFixedDay(bool $FixedDay): self
    {
        $this->FixedDay = $FixedDay;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->StartDate;
    }

    public function setStartDate(\DateTimeInterface $StartDate): self
    {
        $this->StartDate = $StartDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->EndDate;
    }

    public function setEndDate(\DateTimeInterface $EndDate): self
    {
        $this->EndDate = $EndDate;

        return $this;
    }

    public function getAutomaticWithdrawal(): ?bool
    {
        return $this->AutomaticWithdrawal;
    }

    public function setAutomaticWithdrawal(bool $AutomaticWithdrawal): self
    {
        $this->AutomaticWithdrawal = $AutomaticWithdrawal;

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
