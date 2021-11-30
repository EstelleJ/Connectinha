<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211130130234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD price NUMERIC(6, 2) NOT NULL, ADD delivery_adress LONGTEXT NOT NULL, ADD zipcode VARCHAR(8) NOT NULL, ADD invoicing_adress LONGTEXT NOT NULL, ADD invoicing_zipcode VARCHAR(8) NOT NULL, ADD delivery_city VARCHAR(72) NOT NULL, ADD invoicing_city VARCHAR(72) NOT NULL, ADD country VARCHAR(36) NOT NULL, ADD invoicing_country VARCHAR(36) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP price, DROP delivery_adress, DROP zipcode, DROP invoicing_adress, DROP invoicing_zipcode, DROP delivery_city, DROP invoicing_city, DROP country, DROP invoicing_country');
    }
}
