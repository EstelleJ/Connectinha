<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112094620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_products_slider ADD page_products_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE page_products_slider ADD CONSTRAINT FK_254394F37B36DFDB FOREIGN KEY (page_products_id) REFERENCES page_products (id)');
        $this->addSql('CREATE INDEX IDX_254394F37B36DFDB ON page_products_slider (page_products_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_products_slider DROP FOREIGN KEY FK_254394F37B36DFDB');
        $this->addSql('DROP INDEX IDX_254394F37B36DFDB ON page_products_slider');
        $this->addSql('ALTER TABLE page_products_slider DROP page_products_id');
    }
}
