<?php

namespace App\Entity;

use App\Repository\EntryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntryRepository::class)
 */
class Entry
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
     * @ORM\ManyToOne(targetEntity=Status::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Status;

    /**
     * @ORM\ManyToOne(targetEntity=BankAccount::class)
     */
    private $BankAccount;

    /**
     * @ORM\ManyToOne(targetEntity=RecurringEntry::class)
     */
    private $RecurringEntry;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=Payment::class)
     */
    private $Payment;

    /**
     * @ORM\ManyToOne(targetEntity=CreditCardBill::class)
     */
    private $CreditCardBill;

    /**
     * @ORM\ManyToOne(targetEntity=SplitEntry::class)
     */
    private $SplitEntry;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class)
     */
    private $DebtorClient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $IssuanceDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DueDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DateWithdrew;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $Amount;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2, nullable=true)
     */
    private $DebitedAmount;

    /**
     * @ORM\Column(type="smallint")
     */
    private $TypeEntry;

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

    public function getStatus(): ?Status
    {
        return $this->Status;
    }

    public function setStatus(?Status $Status): self
    {
        $this->Status = $Status;

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

    public function getRecurringEntry(): ?RecurringEntry
    {
        return $this->RecurringEntry;
    }

    public function setRecurringEntry(?RecurringEntry $RecurringEntry): self
    {
        $this->RecurringEntry = $RecurringEntry;

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

    public function getPayment(): ?Payment
    {
        return $this->Payment;
    }

    public function setPayment(?Payment $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
    }

    public function getCreditCardBill(): ?CreditCardBill
    {
        return $this->CreditCardBill;
    }

    public function setCreditCardBill(?CreditCardBill $CreditCardBill): self
    {
        $this->CreditCardBill = $CreditCardBill;

        return $this;
    }

    public function getSplitEntry(): ?SplitEntry
    {
        return $this->SplitEntry;
    }

    public function setSplitEntry(?SplitEntry $SplitEntry): self
    {
        $this->SplitEntry = $SplitEntry;

        return $this;
    }

    public function getDebtorClient(): ?Client
    {
        return $this->DebtorClient;
    }

    public function setDebtorClient(?Client $DebtorClient): self
    {
        $this->DebtorClient = $DebtorClient;

        return $this;
    }

    public function getIssuanceDate(): ?\DateTimeInterface
    {
        return $this->IssuanceDate;
    }

    public function setIssuanceDate(\DateTimeInterface $IssuanceDate): self
    {
        $this->IssuanceDate = $IssuanceDate;

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

    public function getDateWithdrew(): ?\DateTimeInterface
    {
        return $this->DateWithdrew;
    }

    public function setDateWithdrew(?\DateTimeInterface $DateWithdrew): self
    {
        $this->DateWithdrew = $DateWithdrew;

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

    public function getDebitedAmount(): ?string
    {
        return $this->DebitedAmount;
    }

    public function setDebitedAmount(?string $DebitedAmount): self
    {
        $this->DebitedAmount = $DebitedAmount;

        return $this;
    }

    public function getTypeEntry(): ?int
    {
        return $this->TypeEntry;
    }

    public function setTypeEntry(int $TypeEntry): self
    {
        $this->TypeEntry = $TypeEntry;

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
