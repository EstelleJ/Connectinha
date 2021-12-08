<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211130153041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD delivery_hamlet VARCHAR(72) NOT NULL, ADD invoicing_hamlet VARCHAR(72) DEFAULT NULL, ADD delivery_phone_number VARCHAR(20) NOT NULL, ADD invoicing_phone_number VARCHAR(20) NOT NULL, ADD delivery_building VARCHAR(72) DEFAULT NULL, ADD invoicing_building VARCHAR(72) DEFAULT NULL, ADD delivery_apartment VARCHAR(72) DEFAULT NULL, ADD invoicing_apartment VARCHAR(72) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP delivery_hamlet, DROP invoicing_hamlet, DROP delivery_phone_number, DROP invoicing_phone_number, DROP delivery_building, DROP invoicing_building, DROP delivery_apartment, DROP invoicing_apartment');
    }
}
