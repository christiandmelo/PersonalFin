<?php

namespace App\Entity;

use App\Repository\CreditCardRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CreditCardRepository::class)
 */
class CreditCard implements \JsonSerializable
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
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint")
     */
    private $closingDay;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dueDate;

    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    private $amountLimit;

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

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

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

    public function getClosingDay(): ?int
    {
        return $this->closingDay;
    }

    public function setClosingDay(int $closingDay): self
    {
        $this->closingDay = $closingDay;

        return $this;
    }

    public function getDueDate(): ?DateTime
    {
        return $this->dueDate;
    }

    public function setDueDate(DateTime $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getAmountLimit(): ?string
    {
        return $this->amountLimit;
    }

    public function setAmountLimit(string $amountLimit): self
    {
        $this->amountLimit = $amountLimit;

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
            'name' => $this->getName(),
            'closingDay' => $this->getClosingDay(),
            'dueDate' => $this->getDueDate(),
            'amountLimit' => $this->getAmountLimit(),
            'displayInSummary' => $this->getDisplayInSummary()
        ];
    }
}
