<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211217110050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders CHANGE delivery_adress delivery_adress LONGTEXT DEFAULT NULL, CHANGE zipcode zipcode VARCHAR(8) DEFAULT NULL, CHANGE invoicing_adress invoicing_adress LONGTEXT DEFAULT NULL, CHANGE invoicing_zipcode invoicing_zipcode VARCHAR(8) DEFAULT NULL, CHANGE delivery_city delivery_city VARCHAR(72) DEFAULT NULL, CHANGE invoicing_city invoicing_city VARCHAR(72) DEFAULT NULL, CHANGE country country VARCHAR(36) DEFAULT NULL, CHANGE invoicing_country invoicing_country VARCHAR(36) DEFAULT NULL, CHANGE delivery_phone_number delivery_phone_number VARCHAR(20) DEFAULT NULL, CHANGE invoicing_phone_number invoicing_phone_number VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders CHANGE delivery_adress delivery_adress LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE zipcode zipcode VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE invoicing_adress invoicing_adress LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE invoicing_zipcode invoicing_zipcode VARCHAR(8) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE delivery_city delivery_city VARCHAR(72) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE invoicing_city invoicing_city VARCHAR(72) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE country country VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE invoicing_country invoicing_country VARCHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE delivery_phone_number delivery_phone_number VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE invoicing_phone_number invoicing_phone_number VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
