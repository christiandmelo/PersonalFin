<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211127225116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, name VARCHAR(50) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_D860BF7A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bank_account (id INT AUTO_INCREMENT NOT NULL, bank_id INT NOT NULL, name VARCHAR(50) NOT NULL, investment TINYINT(1) NOT NULL, display_in_summary TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_53A23E0A11C8FB41 (bank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, suggested_category_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, short_name VARCHAR(50) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_64C19C119EB6921 (client_id), INDEX IDX_64C19C1DD17DE90 (suggested_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_card (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, name VARCHAR(100) NOT NULL, closing_day SMALLINT NOT NULL, due_date DATETIME NOT NULL, amount_limit NUMERIC(15, 2) NOT NULL, display_in_summary TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_11D627EE19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_card_bill (id INT AUTO_INCREMENT NOT NULL, credit_card_id INT NOT NULL, bank_account_id INT NOT NULL, total_credit_card_bill NUMERIC(18, 4) NOT NULL, closing_day DATETIME NOT NULL, due_date DATETIME NOT NULL, closed TINYINT(1) NOT NULL, pay_day DATETIME NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_57D8ED537048FD0F (credit_card_id), INDEX IDX_57D8ED5312CB990C (bank_account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entry (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, status_id INT NOT NULL, bank_account_id INT DEFAULT NULL, recurring_entry_id INT DEFAULT NULL, category_id INT NOT NULL, payment_id INT DEFAULT NULL, credit_card_bill_id INT DEFAULT NULL, split_entry_id INT DEFAULT NULL, debtor_client_id INT DEFAULT NULL, issuance_date DATETIME NOT NULL, due_date DATETIME NOT NULL, date_withdrew DATETIME DEFAULT NULL, amount NUMERIC(15, 2) NOT NULL, debited_amount NUMERIC(15, 2) DEFAULT NULL, type_entry SMALLINT NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_2B219D7019EB6921 (client_id), INDEX IDX_2B219D706BF700BD (status_id), INDEX IDX_2B219D7012CB990C (bank_account_id), INDEX IDX_2B219D702E8A8453 (recurring_entry_id), INDEX IDX_2B219D7012469DE2 (category_id), INDEX IDX_2B219D704C3A3BB (payment_id), INDEX IDX_2B219D706B6382C9 (credit_card_bill_id), INDEX IDX_2B219D7076DD2787 (split_entry_id), INDEX IDX_2B219D702CF994AA (debtor_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, suggested_payment_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, initials VARCHAR(4) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_6D28840D19EB6921 (client_id), INDEX IDX_6D28840DEF15488D (suggested_payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recurring_entry (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, category_id INT NOT NULL, bank_account_id INT DEFAULT NULL, credit_card_id INT DEFAULT NULL, payment_id INT DEFAULT NULL, description VARCHAR(100) NOT NULL, amount NUMERIC(15, 2) NOT NULL, recurrent TINYINT(1) NOT NULL, fixed_day TINYINT(1) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, automatic_withdrawal TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_413E502F19EB6921 (client_id), INDEX IDX_413E502F12469DE2 (category_id), INDEX IDX_413E502F12CB990C (bank_account_id), INDEX IDX_413E502F7048FD0F (credit_card_id), INDEX IDX_413E502F4C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE split (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, description VARCHAR(500) DEFAULT NULL, fixed_percentage TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE split_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, split_id INT NOT NULL, percentage NUMERIC(7, 4) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_6639B75B19EB6921 (client_id), INDEX IDX_6639B75B3DDC68C5 (split_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE split_entry (id INT AUTO_INCREMENT NOT NULL, split_id INT NOT NULL, category_id INT NOT NULL, bank_account_id INT DEFAULT NULL, credit_card_id INT DEFAULT NULL, payment_id INT DEFAULT NULL, who_paid_id INT NOT NULL, amount NUMERIC(15, 2) NOT NULL, description VARCHAR(100) NOT NULL, recurrent TINYINT(1) NOT NULL, fixed_day TINYINT(1) NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, automatic_withdrawal TINYINT(1) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_8701EDD13DDC68C5 (split_id), INDEX IDX_8701EDD112469DE2 (category_id), INDEX IDX_8701EDD112CB990C (bank_account_id), INDEX IDX_8701EDD17048FD0F (credit_card_id), INDEX IDX_8701EDD14C3A3BB (payment_id), INDEX IDX_8701EDD1E7D47899 (who_paid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suggested_category (id INT AUTO_INCREMENT NOT NULL, short_name VARCHAR(50) NOT NULL, name VARCHAR(100) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suggested_payment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, initials VARCHAR(4) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bank ADD CONSTRAINT FK_D860BF7A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE bank_account ADD CONSTRAINT FK_53A23E0A11C8FB41 FOREIGN KEY (bank_id) REFERENCES bank (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1DD17DE90 FOREIGN KEY (suggested_category_id) REFERENCES suggested_category (id)');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE credit_card ADD CONSTRAINT FK_11D627EE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE credit_card_bill ADD CONSTRAINT FK_57D8ED537048FD0F FOREIGN KEY (credit_card_id) REFERENCES credit_card (id)');
        $this->addSql('ALTER TABLE credit_card_bill ADD CONSTRAINT FK_57D8ED5312CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D7019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D706BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D7012CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D702E8A8453 FOREIGN KEY (recurring_entry_id) REFERENCES recurring_entry (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D7012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D704C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D706B6382C9 FOREIGN KEY (credit_card_bill_id) REFERENCES credit_card_bill (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D7076DD2787 FOREIGN KEY (split_entry_id) REFERENCES split_entry (id)');
        $this->addSql('ALTER TABLE entry ADD CONSTRAINT FK_2B219D702CF994AA FOREIGN KEY (debtor_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DEF15488D FOREIGN KEY (suggested_payment_id) REFERENCES suggested_payment (id)');
        $this->addSql('ALTER TABLE recurring_entry ADD CONSTRAINT FK_413E502F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE recurring_entry ADD CONSTRAINT FK_413E502F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE recurring_entry ADD CONSTRAINT FK_413E502F12CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE recurring_entry ADD CONSTRAINT FK_413E502F7048FD0F FOREIGN KEY (credit_card_id) REFERENCES credit_card (id)');
        $this->addSql('ALTER TABLE recurring_entry ADD CONSTRAINT FK_413E502F4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE split_client ADD CONSTRAINT FK_6639B75B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE split_client ADD CONSTRAINT FK_6639B75B3DDC68C5 FOREIGN KEY (split_id) REFERENCES split (id)');
        $this->addSql('ALTER TABLE split_entry ADD CONSTRAINT FK_8701EDD13DDC68C5 FOREIGN KEY (split_id) REFERENCES split (id)');
        $this->addSql('ALTER TABLE split_entry ADD CONSTRAINT FK_8701EDD112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE split_entry ADD CONSTRAINT FK_8701EDD112CB990C FOREIGN KEY (bank_account_id) REFERENCES bank_account (id)');
        $this->addSql('ALTER TABLE split_entry ADD CONSTRAINT FK_8701EDD17048FD0F FOREIGN KEY (credit_card_id) REFERENCES credit_card (id)');
        $this->addSql('ALTER TABLE split_entry ADD CONSTRAINT FK_8701EDD14C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE split_entry ADD CONSTRAINT FK_8701EDD1E7D47899 FOREIGN KEY (who_paid_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank_account DROP FOREIGN KEY FK_53A23E0A11C8FB41');
        $this->addSql('ALTER TABLE credit_card_bill DROP FOREIGN KEY FK_57D8ED5312CB990C');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D7012CB990C');
        $this->addSql('ALTER TABLE recurring_entry DROP FOREIGN KEY FK_413E502F12CB990C');
        $this->addSql('ALTER TABLE split_entry DROP FOREIGN KEY FK_8701EDD112CB990C');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D7012469DE2');
        $this->addSql('ALTER TABLE recurring_entry DROP FOREIGN KEY FK_413E502F12469DE2');
        $this->addSql('ALTER TABLE split_entry DROP FOREIGN KEY FK_8701EDD112469DE2');
        $this->addSql('ALTER TABLE bank DROP FOREIGN KEY FK_D860BF7A19EB6921');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C119EB6921');
        $this->addSql('ALTER TABLE credit_card DROP FOREIGN KEY FK_11D627EE19EB6921');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D7019EB6921');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D702CF994AA');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D19EB6921');
        $this->addSql('ALTER TABLE recurring_entry DROP FOREIGN KEY FK_413E502F19EB6921');
        $this->addSql('ALTER TABLE split_client DROP FOREIGN KEY FK_6639B75B19EB6921');
        $this->addSql('ALTER TABLE split_entry DROP FOREIGN KEY FK_8701EDD1E7D47899');
        $this->addSql('ALTER TABLE credit_card_bill DROP FOREIGN KEY FK_57D8ED537048FD0F');
        $this->addSql('ALTER TABLE recurring_entry DROP FOREIGN KEY FK_413E502F7048FD0F');
        $this->addSql('ALTER TABLE split_entry DROP FOREIGN KEY FK_8701EDD17048FD0F');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D706B6382C9');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D704C3A3BB');
        $this->addSql('ALTER TABLE recurring_entry DROP FOREIGN KEY FK_413E502F4C3A3BB');
        $this->addSql('ALTER TABLE split_entry DROP FOREIGN KEY FK_8701EDD14C3A3BB');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D702E8A8453');
        $this->addSql('ALTER TABLE split_client DROP FOREIGN KEY FK_6639B75B3DDC68C5');
        $this->addSql('ALTER TABLE split_entry DROP FOREIGN KEY FK_8701EDD13DDC68C5');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D7076DD2787');
        $this->addSql('ALTER TABLE entry DROP FOREIGN KEY FK_2B219D706BF700BD');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1DD17DE90');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DEF15488D');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A76ED395');
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
