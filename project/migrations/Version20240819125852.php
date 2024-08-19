<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240819125852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cashbox_shift (id INT AUTO_INCREMENT NOT NULL, cashbox_id INT NOT NULL, user_id INT NOT NULL, shift_number INT NOT NULL, closed_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_9062530061110C8F (cashbox_id), INDEX IDX_90625300A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multi_store_counter_part (multi_store_id INT NOT NULL, counter_part_id INT NOT NULL, INDEX IDX_FD0DBA2D7B4D9FBF (multi_store_id), INDEX IDX_FD0DBA2DC28817CD (counter_part_id), PRIMARY KEY(multi_store_id, counter_part_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cashbox_shift ADD CONSTRAINT FK_9062530061110C8F FOREIGN KEY (cashbox_id) REFERENCES cashbox (id)');
        $this->addSql('ALTER TABLE cashbox_shift ADD CONSTRAINT FK_90625300A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE multi_store_counter_part ADD CONSTRAINT FK_FD0DBA2D7B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE multi_store_counter_part ADD CONSTRAINT FK_FD0DBA2DC28817CD FOREIGN KEY (counter_part_id) REFERENCES counter_part (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE counter_part CHANGE inn inn VARCHAR(255) DEFAULT NULL, CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part ADD CONSTRAINT FK_682A9A17B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('CREATE INDEX IDX_682A9A17B4D9FBF ON counter_part (multi_store_id)');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cashbox_shift DROP FOREIGN KEY FK_9062530061110C8F');
        $this->addSql('ALTER TABLE cashbox_shift DROP FOREIGN KEY FK_90625300A76ED395');
        $this->addSql('ALTER TABLE multi_store_counter_part DROP FOREIGN KEY FK_FD0DBA2D7B4D9FBF');
        $this->addSql('ALTER TABLE multi_store_counter_part DROP FOREIGN KEY FK_FD0DBA2DC28817CD');
        $this->addSql('DROP TABLE cashbox_shift');
        $this->addSql('DROP TABLE multi_store_counter_part');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part DROP FOREIGN KEY FK_682A9A17B4D9FBF');
        $this->addSql('DROP INDEX IDX_682A9A17B4D9FBF ON counter_part');
        $this->addSql('ALTER TABLE counter_part CHANGE inn inn VARCHAR(255) NOT NULL, CHANGE discount discount NUMERIC(10, 2) NOT NULL');
    }
}
