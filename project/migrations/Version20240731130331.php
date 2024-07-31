<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240731130331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, region VARCHAR(255) NOT NULL, district VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, house VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE counter_part (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, multi_store_id INT NOT NULL, stir VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, discount NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_682A9A1F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, currency_id INT NOT NULL, cape_amount NUMERIC(10, 2) NOT NULL, cape_type VARCHAR(255) NOT NULL, `convert` INT NOT NULL, currency_value NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE forgive_type (id INT AUTO_INCREMENT NOT NULL, name JSON NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move_detail (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, store_sender_id INT NOT NULL, store_receiver_id INT NOT NULL, user_sender_id INT NOT NULL, user_receiver_id INT NOT NULL, total_qty NUMERIC(10, 2) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, total_item INT NOT NULL, comment VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE move_global (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, move_detail_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE multi_store (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, owner_id INT NOT NULL, name VARCHAR(255) NOT NULL, profit LONGTEXT DEFAULT NULL, barcode_TTN BIGINT DEFAULT NULL, nds INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_A869D5ABF5B7AF75 (address_id), INDEX IDX_A869D5AB7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nomenclature (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, unit_id INT NOT NULL, mxik VARCHAR(255) NOT NULL, barcode VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, name JSON NOT NULL COMMENT \'(DC2Type:json)\', oldprice NUMERIC(15, 3) NOT NULL, price NUMERIC(15, 3) NOT NULL, oldprice_course NUMERIC(15, 3) NOT NULL, price_course NUMERIC(15, 3) NOT NULL, nds NUMERIC(15, 3) NOT NULL, discount NUMERIC(15, 3) NOT NULL, provider_id INT NOT NULL, qr_code TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nomenclature_history (id INT AUTO_INCREMENT NOT NULL, store_id INT NOT NULL, nomenclature_id INT NOT NULL, nomenclature_history_id INT NOT NULL, user_id INT NOT NULL, comment VARCHAR(255) NOT NULL, qty NUMERIC(10, 2) NOT NULL, oldprice NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, oldprice_course NUMERIC(10, 2) NOT NULL, price_course NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, store_id INT DEFAULT NULL, multi_store_id INT DEFAULT NULL, counter_part_id INT DEFAULT NULL, phone VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_444F97DD7E3C61F9 (owner_id), INDEX IDX_444F97DDB092A811 (store_id), INDEX IDX_444F97DD7B4D9FBF (multi_store_id), INDEX IDX_444F97DDC28817CD (counter_part_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provider_list (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_FF5758777B4D9FBF (multi_store_id), UNIQUE INDEX UNIQ_FF575877F5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store_user (store_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_6F2A7887B092A811 (store_id), INDEX IDX_6F2A7887A76ED395 (user_id), PRIMARY KEY(store_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE store_nomenclature (id INT AUTO_INCREMENT NOT NULL, store_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name JSON NOT NULL COMMENT \'(DC2Type:json)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, address_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(255) NOT NULL, qr_code VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F5B7AF75 (address_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), UNIQUE INDEX UNIQ_IDENTIFIER_NAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_credential (id INT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, type VARCHAR(255) NOT NULL, value LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_A218DBA77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_store (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, store_id INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_category (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, name JSON NOT NULL COMMENT \'(DC2Type:json)\', image VARCHAR(255) NOT NULL, is_active INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_credential (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, class_list LONGTEXT NOT NULL, article INT NOT NULL, insta_login VARCHAR(255) NOT NULL, insta_password VARCHAR(255) NOT NULL, ftp_login VARCHAR(255) NOT NULL, ftp_password VARCHAR(255) NOT NULL, ftp_ip VARCHAR(255) NOT NULL, ftp_image_path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE web_nomenclature (id INT AUTO_INCREMENT NOT NULL, multi_store_id INT NOT NULL, web_category_id INT NOT NULL, nomenclature_id INT NOT NULL, article VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, document VARCHAR(255) NOT NULL, is_active INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE counter_part ADD CONSTRAINT FK_682A9A1F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE multi_store ADD CONSTRAINT FK_A869D5ABF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE multi_store ADD CONSTRAINT FK_A869D5AB7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD7E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDB092A811 FOREIGN KEY (store_id) REFERENCES store (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD7B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDC28817CD FOREIGN KEY (counter_part_id) REFERENCES counter_part (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF5758777B4D9FBF FOREIGN KEY (multi_store_id) REFERENCES multi_store (id)');
        $this->addSql('ALTER TABLE store ADD CONSTRAINT FK_FF575877F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE store_user ADD CONSTRAINT FK_6F2A7887B092A811 FOREIGN KEY (store_id) REFERENCES store (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE store_user ADD CONSTRAINT FK_6F2A7887A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE user_credential ADD CONSTRAINT FK_A218DBA77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE counter_part DROP FOREIGN KEY FK_682A9A1F5B7AF75');
        $this->addSql('ALTER TABLE multi_store DROP FOREIGN KEY FK_A869D5ABF5B7AF75');
        $this->addSql('ALTER TABLE multi_store DROP FOREIGN KEY FK_A869D5AB7E3C61F9');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD7E3C61F9');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDB092A811');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD7B4D9FBF');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDC28817CD');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF5758777B4D9FBF');
        $this->addSql('ALTER TABLE store DROP FOREIGN KEY FK_FF575877F5B7AF75');
        $this->addSql('ALTER TABLE store_user DROP FOREIGN KEY FK_6F2A7887B092A811');
        $this->addSql('ALTER TABLE store_user DROP FOREIGN KEY FK_6F2A7887A76ED395');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE user_credential DROP FOREIGN KEY FK_A218DBA77E3C61F9');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE counter_part');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE forgive_type');
        $this->addSql('DROP TABLE move_detail');
        $this->addSql('DROP TABLE move_global');
        $this->addSql('DROP TABLE multi_store');
        $this->addSql('DROP TABLE nomenclature');
        $this->addSql('DROP TABLE nomenclature_history');
        $this->addSql('DROP TABLE phone');
        $this->addSql('DROP TABLE provider_list');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE store_user');
        $this->addSql('DROP TABLE store_nomenclature');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_credential');
        $this->addSql('DROP TABLE user_store');
        $this->addSql('DROP TABLE web_category');
        $this->addSql('DROP TABLE web_credential');
        $this->addSql('DROP TABLE web_nomenclature');
    }
}
