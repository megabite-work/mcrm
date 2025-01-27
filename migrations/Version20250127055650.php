<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250127055650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE web_footer_body');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE delivery_settings CHANGE min_sum min_sum NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE first_km first_km NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE delivery_sum delivery_sum NUMERIC(10, 2) DEFAULT \'0\' NOT NULL, CHANGE next_km_sum next_km_sum NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE web_banner CHANGE show_type show_type LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE web_footer_link CHANGE web_footer_body_id web_footer_id INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE web_footer_body (id INT AUTO_INCREMENT NOT NULL, web_footer_id INT NOT NULL, logo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, about VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_active TINYINT(1) DEFAULT 1 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cashbox_detail CHANGE surrender surrender NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE sale sale NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE nds nds NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE advance advance NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE credit credit NUMERIC(10, 2) DEFAULT \'0.00\', CHANGE remain remain NUMERIC(10, 2) DEFAULT \'0.00\'');
        $this->addSql('ALTER TABLE cashbox_global CHANGE qty qty NUMERIC(10, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds_sum nds_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount_sum discount_sum NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE cashbox_payment CHANGE amount amount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE counter_part CHANGE discount discount NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE delivery_settings CHANGE min_sum min_sum NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE first_km first_km NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE delivery_sum delivery_sum NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL, CHANGE next_km_sum next_km_sum NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE nomenclature CHANGE oldprice oldprice NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price price NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE oldprice_course oldprice_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE price_course price_course NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE nds nds NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL, CHANGE discount discount NUMERIC(15, 3) DEFAULT \'0.000\' NOT NULL');
        $this->addSql('ALTER TABLE store_nomenclature CHANGE qty qty NUMERIC(10, 2) DEFAULT \'0.00\' NOT NULL');
        $this->addSql('ALTER TABLE web_banner CHANGE show_type show_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE web_footer_link CHANGE web_footer_id web_footer_body_id INT NOT NULL');
    }
}
