<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112160419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_mantra_products (product_id INT NOT NULL, mantra_products_id INT NOT NULL, INDEX IDX_7AFBBC474584665A (product_id), INDEX IDX_7AFBBC47835D1153 (mantra_products_id), PRIMARY KEY(product_id, mantra_products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_mantra_products ADD CONSTRAINT FK_7AFBBC474584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_mantra_products ADD CONSTRAINT FK_7AFBBC47835D1153 FOREIGN KEY (mantra_products_id) REFERENCES mantra_products (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE mantra_products_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE mantra_products_product (mantra_products_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_E6939B3E835D1153 (mantra_products_id), INDEX IDX_E6939B3E4584665A (product_id), PRIMARY KEY(mantra_products_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE mantra_products_product ADD CONSTRAINT FK_E6939B3E4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mantra_products_product ADD CONSTRAINT FK_E6939B3E835D1153 FOREIGN KEY (mantra_products_id) REFERENCES mantra_products (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_mantra_products');
    }
}
