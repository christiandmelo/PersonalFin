<?php

namespace App\Service;

use App\Entity\BankAccount;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\CreditCardBill;
use App\Entity\Entry;
use App\Entity\Payment;
use App\Entity\Status;
use App\Helper\EntityFactoryException;
use App\Helper\EntityFactoryInterface;
use App\Repository\ClientRepository;
use App\Repository\StatusRepository;
use App\Repository\BankAccountRepository;
use App\Repository\CategoryRepository;
use App\Repository\PaymentRepository;
use App\Repository\CreditCardBillRepository;

class EntryService implements EntityFactoryInterface
{
    private $clientRepository;
    private $statusRepository;
    private $bankAccountRepository;
    private $categoryRepository;
    private $paymentReporitory;
    private $creditCardBillRepository;

    public function __construct(
        ClientRepository $clientRepository,
        StatusRepository $statusRepository,
        BankAccountRepository $bankAccountRepository,
        CategoryRepository $categoryRepository,
        PaymentRepository $paymentRepository,
        CreditCardBillRepository $creditCardBillRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->statusRepository = $statusRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->categoryRepository = $categoryRepository;
        $this->paymentReporitory = $paymentRepository;
        $this->creditCardBillRepository = $creditCardBillRepository;
    }

    public function createEntity(string $json, int $userId, bool $insert): Entry
    {
        $objetoJson = json_decode($json);
        $this->checkAllProperties($objetoJson);

        $client = $this->getClient($userId);
        $status = $this->getStatus($objetoJson->statusId);
        $banckAccount = $this->getBankAccount($objetoJson->bankAccountId);
        $category = $this->getCategory($objetoJson->categoryId);
        $payment = $this->getPayment($objetoJson->paymentId);
        $creditCardBill = $this->getCreditCardBill($objetoJson->creditCardBillId);

        $entity = new Entry();
        $entity->setClient($client)
               ->setStatus($status)
               ->setBankAccount($banckAccount)
               ->setCategory($category)
               ->setPayment($payment)
               ->setCreditCardBill($creditCardBill)
               ->setIssuanceDate($objetoJson->issuanceDate)
               ->setDueDate($objetoJson->dueDate)
               ->setDateWithdrew($objetoJson->dateWithdrew)
               ->setAmount($objetoJson->amount)
               ->setDebitedAmount($objetoJson->debitedAmount)
               ->setTypeEntry($objetoJson->typeEntry)
               ->setActive(true);

        return $entity;
    }

    private function getClient(int $userId): Client
    {
        $client = $this->clientRepository->findBy(array('User' => $userId));
        if (count($client) <= 0) {
            throw new EntityFactoryException("User doesn't have a client registered");
        }

        return $client[0];
    }

    private function getStatus(int $id): Status
    {
        $client = $this->statusRepository->findBy(array('id' => $id));
        if (count($client) <= 0) {
            throw new EntityFactoryException("Status doesn't exist");
        }

        return $client[0];
    }

    private function getBankAccount(int $id): BankAccount
    {
        if($id == 0)
            return null;

        $client = $this->bankAccountRepository->findBy(array('id' => $id));
        if (count($client) <= 0) {
            throw new EntityFactoryException("Bank account doesn't exist");
        }

        return $client[0];
    }

    private function getCategory(int $id): Category
    {
        $client = $this->categoryRepository->findBy(array('id' => $id));
        if (count($client) <= 0) {
            throw new EntityFactoryException("Category doesn't exist");
        }

        return $client[0];
    }

    private function getPayment(int $id): Payment
    {
        $client = $this->paymentReporitory->findBy(array('id' => $id));
        if (count($client) <= 0) {
            throw new EntityFactoryException("Payment doesn't exist");
        }

        return $client[0];
    }

    private function getCreditCardBill(int $id): CreditCardBill
    {
        if($id == 0)
            return null;

        $client = $this->creditCardBillRepository->findBy(array('id' => $id));
        if (count($client) <= 0) {
            throw new EntityFactoryException("Credit card doesn't exist");
        }

        return $client[0];
    }

    private function checkAllProperties(object $objetoJson): void
    {
        if (!property_exists($objetoJson, 'statusId')) {
            throw new EntityFactoryException('Entry needs a status');
        }

        if (!property_exists($objetoJson, 'categoryId')) {
            throw new EntityFactoryException('Entry needs a category');
        }

        if (!property_exists($objetoJson, 'issuanceDate')) {
            throw new EntityFactoryException('Entry needs an issuance date');
        }

        if (!property_exists($objetoJson, 'dueDate')) {
            throw new EntityFactoryException('Entry needs a due date');
        }

        if (!property_exists($objetoJson, 'amount')) {
            throw new EntityFactoryException('Entry needs an amount');
        }

        if (!property_exists($objetoJson, 'typeEntry')) {
            throw new EntityFactoryException('Entry needs a type');
        }
    }
}
