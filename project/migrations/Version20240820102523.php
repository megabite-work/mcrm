<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240820102523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cashbox_detail (id INT AUTO_INCREMENT NOT NULL, detail_id INT DEFAULT NULL, user_id INT NOT NULL, cashbox_id INT NOT NULL, counter_part_id INT DEFAULT NULL, cheque_number INT NOT NULL, type VARCHAR(255) NOT NULL, credit_type VARCHAR(255) DEFAULT NULL, return_status TINYINT(1) DEFAULT 0 NOT NULL, credit_status TINYINT(1) DEFAULT NULL, surrender NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, sale NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, nds NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, advance NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, credit NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, remain NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_2885A3E4D8D003BB (detail_id), INDEX IDX_2885A3E4A76ED395 (user_id), INDEX IDX_2885A3E461110C8F (cashbox_id), INDEX IDX_2885A3E4C28817CD (counter_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E4D8D003BB FOREIGN KEY (detail_id) REFERENCES cashbox_detail (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E461110C8F FOREIGN KEY (cashbox_id) REFERENCES cashbox (id)');
        $this->addSql('ALTER TABLE cashbox_detail ADD CONSTRAINT FK_2885A3E4C28817CD FOREIGN KEY (counter_part_id) REFERENCES counter_part (id)');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E4D8D003BB');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E4A76ED395');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E461110C8F');
        $this->addSql('ALTER TABLE cashbox_detail DROP FOREIGN KEY FK_2885A3E4C28817CD');
        $this->addSql('DROP TABLE cashbox_detail');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
    }
}
