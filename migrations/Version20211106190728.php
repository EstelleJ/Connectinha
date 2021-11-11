<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211106190728 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_product_subcategory (product_id INT NOT NULL, product_subcategory_id INT NOT NULL, INDEX IDX_F8B2D1C54584665A (product_id), INDEX IDX_F8B2D1C5EAF807B (product_subcategory_id), PRIMARY KEY(product_id, product_subcategory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_product_subcategory ADD CONSTRAINT FK_F8B2D1C54584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_product_subcategory ADD CONSTRAINT FK_F8B2D1C5EAF807B FOREIGN KEY (product_subcategory_id) REFERENCES product_subcategory (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_subcategory_product');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_subcategory_product (product_subcategory_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2AB33882EAF807B (product_subcategory_id), INDEX IDX_2AB338824584665A (product_id), PRIMARY KEY(product_subcategory_id, product_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product_subcategory_product ADD CONSTRAINT FK_2AB338824584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_subcategory_product ADD CONSTRAINT FK_2AB33882EAF807B FOREIGN KEY (product_subcategory_id) REFERENCES product_subcategory (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE product_product_subcategory');
    }
}
