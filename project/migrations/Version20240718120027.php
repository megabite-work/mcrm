<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240718120027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tables';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE counter_part_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE course_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE currency_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE forgive_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE move_detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE move_global_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE multi_store_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomenclature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE nomenclature_history_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE provider_list_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE refresh_tokens_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE store_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE store_nomenclature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_credential_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_multi_store_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_phone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_security_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_store_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE web_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE web_credential_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE web_nomenclature_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE counter_part (id INT NOT NULL, multi_store_id INT NOT NULL, stir VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, discount NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course (id INT NOT NULL, multi_store_id INT NOT NULL, currency_id INT NOT NULL, cape_amount NUMERIC(10, 2) NOT NULL, cape_type VARCHAR(255) NOT NULL, convert INT NOT NULL, currency_value NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE currency (id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE forgive_type (id INT NOT NULL, name JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE move_detail (id INT NOT NULL, status VARCHAR(255) NOT NULL, store_sender_id INT NOT NULL, store_receiver_id INT NOT NULL, user_sender_id INT NOT NULL, user_receiver_id INT NOT NULL, total_qty NUMERIC(10, 2) NOT NULL, total_price NUMERIC(10, 2) NOT NULL, total_item INT NOT NULL, comment VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE move_global (id INT NOT NULL, status VARCHAR(255) NOT NULL, move_detail_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE multi_store (id INT NOT NULL, name VARCHAR(255) NOT NULL, profit TEXT NOT NULL, barcode_TTN INT NOT NULL, nds INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nomenclature (id INT NOT NULL, category_id INT NOT NULL, unit_id INT NOT NULL, mxik VARCHAR(255) NOT NULL, barcode VARCHAR(255) NOT NULL, brand VARCHAR(255) NOT NULL, name JSON NOT NULL, oldprice NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, oldprice_course NUMERIC(10, 2) NOT NULL, price_course NUMERIC(10, 2) NOT NULL, nds NUMERIC(10, 2) NOT NULL, discount NUMERIC(10, 2) NOT NULL, provider_id INT NOT NULL, qr_code INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE nomenclature_history (id INT NOT NULL, store_id INT NOT NULL, nomenclature_id INT NOT NULL, nomenclature_history_id INT NOT NULL, user_id INT NOT NULL, comment VARCHAR(255) NOT NULL, qty NUMERIC(10, 2) NOT NULL, oldprice NUMERIC(10, 2) NOT NULL, price NUMERIC(10, 2) NOT NULL, oldprice_course NUMERIC(10, 2) NOT NULL, price_course NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE provider_list (id INT NOT NULL, type VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE refresh_tokens (id INT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9BACE7E1C74F2195 ON refresh_tokens (refresh_token)');
        $this->addSql('CREATE TABLE store (id INT NOT NULL, multi_store_id INT NOT NULL, name VARCHAR(255) NOT NULL, is_active INT NOT NULL, official_address VARCHAR(255) NOT NULL, coordinate VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE store_nomenclature (id INT NOT NULL, store_id INT NOT NULL, nomenclature_id INT NOT NULL, qty NUMERIC(10, 2) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE unit (id INT NOT NULL, name JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, qr_code VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_NAME ON "user" (username)');
        $this->addSql('CREATE TABLE user_credential (id INT NOT NULL, user_id INT NOT NULL, type VARCHAR(255) NOT NULL, value TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_multi_store (id INT NOT NULL, user_id INT NOT NULL, multi_store_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_phone (id INT NOT NULL, phoneble_id INT NOT NULL, phone VARCHAR(255) NOT NULL, phoneble_type VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_security (id INT NOT NULL, user_id INT NOT NULL, ip VARCHAR(255) NOT NULL, security INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_store (id INT NOT NULL, user_id INT NOT NULL, store_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE web_category (id INT NOT NULL, parent_id INT NOT NULL, name JSON NOT NULL, image VARCHAR(255) NOT NULL, is_active INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE web_credential (id INT NOT NULL, multi_store_id INT NOT NULL, class_list TEXT NOT NULL, article INT NOT NULL, insta_login VARCHAR(255) NOT NULL, insta_password VARCHAR(255) NOT NULL, ftp_login VARCHAR(255) NOT NULL, ftp_password VARCHAR(255) NOT NULL, ftp_ip VARCHAR(255) NOT NULL, ftp_image_path VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE web_nomenclature (id INT NOT NULL, multi_store_id INT NOT NULL, web_category_id INT NOT NULL, nomenclature_id INT NOT NULL, article VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, description TEXT NOT NULL, document VARCHAR(255) NOT NULL, is_active INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE counter_part_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE course_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE currency_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE forgive_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE move_detail_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE move_global_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE multi_store_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomenclature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE nomenclature_history_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE provider_list_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE refresh_tokens_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE store_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE store_nomenclature_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE unit_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE user_credential_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_multi_store_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_phone_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_security_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_store_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE web_category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE web_credential_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE web_nomenclature_id_seq CASCADE');
        $this->addSql('DROP TABLE counter_part');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE forgive_type');
        $this->addSql('DROP TABLE move_detail');
        $this->addSql('DROP TABLE move_global');
        $this->addSql('DROP TABLE multi_store');
        $this->addSql('DROP TABLE nomenclature');
        $this->addSql('DROP TABLE nomenclature_history');
        $this->addSql('DROP TABLE provider_list');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE store');
        $this->addSql('DROP TABLE store_nomenclature');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_credential');
        $this->addSql('DROP TABLE user_multi_store');
        $this->addSql('DROP TABLE user_phone');
        $this->addSql('DROP TABLE user_security');
        $this->addSql('DROP TABLE user_store');
        $this->addSql('DROP TABLE web_category');
        $this->addSql('DROP TABLE web_credential');
        $this->addSql('DROP TABLE web_nomenclature');
    }
}