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
use App\Repository\EntryRepository;

class EntryService implements EntityFactoryInterface
{
    private $entryRepository;
    private $clientRepository;
    private $statusRepository;
    private $bankAccountRepository;
    private $categoryRepository;
    private $paymentReporitory;
    private $creditCardBillRepository;

    public function __construct(
        EntryRepository $entryRepository,
        ClientRepository $clientRepository,
        StatusRepository $statusRepository,
        BankAccountRepository $bankAccountRepository,
        CategoryRepository $categoryRepository,
        PaymentRepository $paymentRepository,
        CreditCardBillRepository $creditCardBillRepository)
    {
        $this->entryRepository = $entryRepository;
        $this->clientRepository = $clientRepository;
        $this->statusRepository = $statusRepository;
        $this->bankAccountRepository = $bankAccountRepository;
        $this->categoryRepository = $categoryRepository;
        $this->paymentReporitory = $paymentRepository;
        $this->creditCardBillRepository = $creditCardBillRepository;
    }

    public function getResume(string $dtBegin, string $dtEnd)
    {
        $arrRet["currentBalance"] = "0.00";
        $arrRet["percentCurrentBalance"] = "0.00";
        $arrRet["positiveCurrentBalance"] = true;
        $incomes = (float)0;
        $expenses = (float)0;
        //Currently month
        $arrCurrentResume = $this->entryRepository->getResume($dtBegin, $dtEnd);
        foreach ($arrCurrentResume as $value) {
            if(!isset($value["typeEntry"]))
                continue;
            
            if($value["typeEntry"] == 1){
                $incomes = (float)$value["total"];
                continue;
            }

            if($value["typeEntry"] == 2)
                $expenses = (float)$value["total"];
        }
        $monthBalance = $incomes - $expenses;

        //previous month
        $previousDtBegin = \DateTime::createFromFormat("Y-m-d", $dtBegin)->modify('-1 month')->format('Y-m-d');
        $previousDtEnd = \DateTime::createFromFormat("Y-m-d", $dtEnd)->modify('-1 month')->format('Y-m-d');
        $previousIncome = 0;
        $previousExpense = 0;
        $arrPreviousResume = $this->entryRepository->getResume($previousDtBegin, $previousDtEnd);
        foreach ($arrPreviousResume as $value) {
            if(!isset($value["typeEntry"]))
                continue;
            
            if($value["typeEntry"] == 1){
                $previousIncome = (float)$value["total"];
                continue;
            }

            if($value["typeEntry"] == 2)
            $previousExpense = (float)$value["total"];
        }
        $previousMonthBalance = $previousIncome-$previousExpense;
        $diffIncomes = $incomes-($previousIncome);
        $diffExpenses = $expenses-($previousExpense);
        $diffMonthBalance = $monthBalance-($previousMonthBalance);

        
        $arrRet["previousIncome"] = number_format($previousIncome, 2, '.');
        $arrRet["previousExpense"] = number_format($previousExpense, 2, '.');
        $arrRet["previousMonthBalance"] = number_format($previousMonthBalance, 2, '.');
        $arrRet["incomes"] = number_format($incomes, 2, '.');
        $arrRet["expenses"] = number_format($expenses, 2, '.');
        $arrRet["monthBalance"] = number_format($monthBalance, 2, '.');
        $arrRet["diffIncomes"] = number_format($diffIncomes, 2, '.');
        $arrRet["diffExpenses"] = number_format($diffExpenses, 2, '.');
        $arrRet["diffMonthBalance"] = number_format($diffMonthBalance, 2, '.');
        $arrRet["positiveIncomes"] = true; 
        $arrRet["positiveExpenses"] = true; 
        $arrRet["positiveMonthBalance"] = true; 

        if($diffIncomes < 0)
        {
            //$arrRet["diffIncomes"] = number_format($diffIncomes*-1, 2, '.');
            $arrRet["positiveIncomes"] = false; 
        }

        if($diffExpenses < 0)
        {
            //$arrRet["diffExpenses"] = number_format($diffExpenses*-1, 2, '.');
            $arrRet["positiveExpenses"] = false; 
        }

        if($diffMonthBalance < 0)
        {
            //$arrRet["diffMonthBalance"] = number_format($diffMonthBalance*-1, 2, '.');
            $arrRet["positiveMonthBalance"] = false; 
        }

        return $arrRet;
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

        $entity = new Entry();
        $entity->setClient($client)
               ->setStatus($status)
               ->setBankAccount($banckAccount)
               ->setCategory($category)
               ->setPayment($payment)
               ->setIssuanceDate(\DateTime::createFromFormat("Y-m-d", $objetoJson->issuanceDate))
               ->setDueDate(\DateTime::createFromFormat("Y-m-d",$objetoJson->dueDate))
               ->setAmount($objetoJson->amount)
               ->setDebitedAmount($objetoJson->debitedAmount)
               ->setTypeEntry($objetoJson->typeEntry)
               ->setActive(true);

        if($objetoJson->creditCardBillId > 0){
            $creditCardBill = $this->getCreditCardBill($objetoJson->creditCardBillId);
            $entity->setCreditCardBill($creditCardBill);
        }

        if($objetoJson->dateWithdrew != ""){
            $entity->setDateWithdrew($objetoJson->dateWithdrew);
        }

        return $entity;
    }

    private function getClient(int $userId): Client
    {
        $client = $this->clientRepository->findBy(array('user' => $userId));
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
