<?php

namespace App\Service;

use App\Entity\Bank;
use App\Entity\BankAccount;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\BankAccountRepository;
use App\Repository\BankRepository;

class BankAccountService implements EntityFactoryInterface
{
    /**
     * @var BankRepository
     */
    private $bankRepository;

    /**
     * @var BankAccountRepository
     */
    private $bankAccountRepository;

    public function __construct(
        BankRepository $bankRepository,
        BankAccountRepository $bankAccountRepository)
    {
        $this->bankRepository = $bankRepository;
        $this->bankAccountRepository = $bankAccountRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): BankAccount
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $bank = $this->getBank($objetoJson->bankId);

        $this->validateIfInitialsAlreadyExist($insert, $bank->getId(), $objetoJson->name);

        $entity = new BankAccount();
        $entity->setBank($bank)
               ->setName($objetoJson->name)
               ->setInvestment($objetoJson->investiment)
               ->setDisplayInSummary($objetoJson->displayInSummary)
               ->setActive(true);

        return $entity;
    }

    private function getBank(int $bankId): Bank
    {
        $bank = $this->bankRepository->findBy(array('id' => $bankId));
        if (count($bank) <= 0) {
            throw new EntityFactoryException("User doesn't have this bank registered");
        }

        return $bank[0];
    }

    private function checkAllProperties(object $objetoJson): void
    {
        if (!property_exists($objetoJson, 'bankId')) {
            throw new EntityFactoryException('Bank Account needs a bank');
        }

        if (!property_exists($objetoJson, 'name')) {
            throw new EntityFactoryException('Bank Account needs a name');
        }

        if (!property_exists($objetoJson, 'investiment')) {
            throw new EntityFactoryException('Bank Account needs an investiment');
        }

        if (!property_exists($objetoJson, 'displayInSummary')) {
            throw new EntityFactoryException('Bank Account needs a display in summary');
        }
    }

    private function validateIfInitialsAlreadyExist(bool $insert, int $bankId, string $name): void
    {
        if(!$insert)
            return;

        $bankAccount = $this->bankAccountRepository->findBy(array('bank' => $bankId, 'name' => $name));
        if (count($bankAccount) > 0) {
            throw new EntityFactoryException("Bank Account alraedy exist with these name");
        }
    }
}
