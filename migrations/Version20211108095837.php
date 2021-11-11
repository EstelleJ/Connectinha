<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108095837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, order_number VARCHAR(16) NOT NULL, date DATETIME NOT NULL, status VARCHAR(255) NOT NULL, send VARCHAR(255) NOT NULL, INDEX IDX_E52FFDEEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestations_payment_method (prestations_id INT NOT NULL, payment_method_id INT NOT NULL, INDEX IDX_17D6BC078BE96D0D (prestations_id), INDEX IDX_17D6BC075AA1164F (payment_method_id), PRIMARY KEY(prestations_id, payment_method_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_payment_method (product_id INT NOT NULL, payment_method_id INT NOT NULL, INDEX IDX_2808DFDA4584665A (product_id), INDEX IDX_2808DFDA5AA1164F (payment_method_id), PRIMARY KEY(product_id, payment_method_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE prestations_payment_method ADD CONSTRAINT FK_17D6BC078BE96D0D FOREIGN KEY (prestations_id) REFERENCES prestations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestations_payment_method ADD CONSTRAINT FK_17D6BC075AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_payment_method ADD CONSTRAINT FK_2808DFDA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_payment_method ADD CONSTRAINT FK_2808DFDA5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE prestations_payment_method');
        $this->addSql('DROP TABLE product_payment_method');
    }
}
