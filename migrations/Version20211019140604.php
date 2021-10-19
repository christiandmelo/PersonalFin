<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211019140604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_D860BF7A19EB6921 ON bank (client_id)');
        $this->addSql('CREATE TABLE bank_account (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, bank_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, investment BOOLEAN NOT NULL, display_in_summary BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_53A23E0A11C8FB41 ON bank_account (bank_id)');
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, suggested_category_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, short_name VARCHAR(50) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_64C19C119EB6921 ON category (client_id)');
        $this->addSql('CREATE INDEX IDX_64C19C1DD17DE90 ON category (suggested_category_id)');
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_C7440455A76ED395 ON client (user_id)');
        $this->addSql('CREATE TABLE credit_card (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, closing_day SMALLINT NOT NULL, due_date DATETIME NOT NULL, amount_limit NUMERIC(15, 2) NOT NULL, display_in_summary BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_11D627EE19EB6921 ON credit_card (client_id)');
        $this->addSql('CREATE TABLE credit_card_bill (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, credit_card_id INTEGER NOT NULL, bank_account_id INTEGER NOT NULL, total_credit_card_bill NUMERIC(18, 4) NOT NULL, closing_day DATETIME NOT NULL, due_date DATETIME NOT NULL, closed BOOLEAN NOT NULL, pay_day DATETIME NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_57D8ED537048FD0F ON credit_card_bill (credit_card_id)');
        $this->addSql('CREATE INDEX IDX_57D8ED5312CB990C ON credit_card_bill (bank_account_id)');
        $this->addSql('CREATE TABLE entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, status_id INTEGER NOT NULL, bank_account_id INTEGER DEFAULT NULL, recurring_entry_id INTEGER DEFAULT NULL, category_id INTEGER NOT NULL, payment_id INTEGER DEFAULT NULL, credit_card_bill_id INTEGER DEFAULT NULL, split_entry_id INTEGER DEFAULT NULL, debtor_client_id INTEGER DEFAULT NULL, issuance_date DATETIME NOT NULL, due_date DATETIME NOT NULL, date_withdrew DATETIME DEFAULT NULL, amount NUMERIC(15, 2) NOT NULL, debited_amount NUMERIC(15, 2) DEFAULT NULL, type_entry SMALLINT NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2B219D7019EB6921 ON entry (client_id)');
        $this->addSql('CREATE INDEX IDX_2B219D706BF700BD ON entry (status_id)');
        $this->addSql('CREATE INDEX IDX_2B219D7012CB990C ON entry (bank_account_id)');
        $this->addSql('CREATE INDEX IDX_2B219D702E8A8453 ON entry (recurring_entry_id)');
        $this->addSql('CREATE INDEX IDX_2B219D7012469DE2 ON entry (category_id)');
        $this->addSql('CREATE INDEX IDX_2B219D704C3A3BB ON entry (payment_id)');
        $this->addSql('CREATE INDEX IDX_2B219D706B6382C9 ON entry (credit_card_bill_id)');
        $this->addSql('CREATE INDEX IDX_2B219D7076DD2787 ON entry (split_entry_id)');
        $this->addSql('CREATE INDEX IDX_2B219D702CF994AA ON entry (debtor_client_id)');
        $this->addSql('CREATE TABLE payment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, suggested_payment_id INTEGER NOT NULL, name VARCHAR(100) NOT NULL, initials VARCHAR(4) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6D28840D19EB6921 ON payment (client_id)');
        $this->addSql('CREATE INDEX IDX_6D28840DEF15488D ON payment (suggested_payment_id)');
        $this->addSql('CREATE TABLE recurring_entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, category_id INTEGER NOT NULL, bank_account_id INTEGER DEFAULT NULL, credit_card_id INTEGER DEFAULT NULL, payment_id INTEGER DEFAULT NULL, description VARCHAR(100) NOT NULL, amount NUMERIC(15, 2) NOT NULL, recurrent BOOLEAN NOT NULL, fixed_day BOOLEAN NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, automatic_withdrawal BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_413E502F19EB6921 ON recurring_entry (client_id)');
        $this->addSql('CREATE INDEX IDX_413E502F12469DE2 ON recurring_entry (category_id)');
        $this->addSql('CREATE INDEX IDX_413E502F12CB990C ON recurring_entry (bank_account_id)');
        $this->addSql('CREATE INDEX IDX_413E502F7048FD0F ON recurring_entry (credit_card_id)');
        $this->addSql('CREATE INDEX IDX_413E502F4C3A3BB ON recurring_entry (payment_id)');
        $this->addSql('CREATE TABLE split (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(500) DEFAULT NULL, fixed_percentage BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE split_client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id INTEGER NOT NULL, split_id INTEGER NOT NULL, percentage NUMERIC(7, 4) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_6639B75B19EB6921 ON split_client (client_id)');
        $this->addSql('CREATE INDEX IDX_6639B75B3DDC68C5 ON split_client (split_id)');
        $this->addSql('CREATE TABLE split_entry (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, split_id INTEGER NOT NULL, category_id INTEGER NOT NULL, bank_account_id INTEGER DEFAULT NULL, credit_card_id INTEGER DEFAULT NULL, payment_id INTEGER DEFAULT NULL, who_paid_id INTEGER NOT NULL, amount NUMERIC(15, 2) NOT NULL, description VARCHAR(100) NOT NULL, recurrent BOOLEAN NOT NULL, fixed_day BOOLEAN NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, automatic_withdrawal BOOLEAN NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE INDEX IDX_8701EDD13DDC68C5 ON split_entry (split_id)');
        $this->addSql('CREATE INDEX IDX_8701EDD112469DE2 ON split_entry (category_id)');
        $this->addSql('CREATE INDEX IDX_8701EDD112CB990C ON split_entry (bank_account_id)');
        $this->addSql('CREATE INDEX IDX_8701EDD17048FD0F ON split_entry (credit_card_id)');
        $this->addSql('CREATE INDEX IDX_8701EDD14C3A3BB ON split_entry (payment_id)');
        $this->addSql('CREATE INDEX IDX_8701EDD1E7D47899 ON split_entry (who_paid_id)');
        $this->addSql('CREATE TABLE status (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE suggested_category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, short_name VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE suggested_payment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(100) NOT NULL, initials VARCHAR(4) NOT NULL, active BOOLEAN NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bank');
        $this->addSql('DROP TABLE bank_account');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE credit_card');
        $this->addSql('DROP TABLE credit_card_bill');
        $this->addSql('DROP TABLE entry');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE recurring_entry');
        $this->addSql('DROP TABLE split');
        $this->addSql('DROP TABLE split_client');
        $this->addSql('DROP TABLE split_entry');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE suggested_category');
        $this->addSql('DROP TABLE suggested_payment');
        $this->addSql('DROP TABLE user');
    }
}
