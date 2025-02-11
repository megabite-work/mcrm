<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20250203112405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add is_active column to multi_store table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE multi_store ADD is_active TINYINT(1) DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE multi_store DROP is_active');
    }
}
