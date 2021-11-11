<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210902095312 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, product_category_id INT DEFAULT NULL, tva_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price VARCHAR(9) NOT NULL, text LONGTEXT NOT NULL, slug VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_D34A04AD5E237E06 (name), INDEX IDX_D34A04ADBE6903FD (product_category_id), INDEX IDX_D34A04AD4D79775F (tva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_category_product_subcategory (product_category_id INT NOT NULL, product_subcategory_id INT NOT NULL, INDEX IDX_D984A413BE6903FD (product_category_id), INDEX IDX_D984A413EAF807B (product_subcategory_id), PRIMARY KEY(product_category_id, product_subcategory_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_color (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, name VARCHAR(64) NOT NULL, hexa VARCHAR(16) NOT NULL, INDEX IDX_C70A33B53DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_image (id INT AUTO_INCREMENT NOT NULL, products_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, image LONGTEXT NOT NULL, title VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, text VARCHAR(255) DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_64617F036C8A81A9 (products_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_image_product_color (product_image_id INT NOT NULL, product_color_id INT NOT NULL, INDEX IDX_DA453A2CF6154FFA (product_image_id), INDEX IDX_DA453A2CB16A7522 (product_color_id), PRIMARY KEY(product_image_id, product_color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_subcategory (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_variation (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, text LONGTEXT DEFAULT NULL, INDEX IDX_C3B85674584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tva (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, taux VARCHAR(9) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADBE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD4D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
        $this->addSql('ALTER TABLE product_category_product_subcategory ADD CONSTRAINT FK_D984A413BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category_product_subcategory ADD CONSTRAINT FK_D984A413EAF807B FOREIGN KEY (product_subcategory_id) REFERENCES product_subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_color ADD CONSTRAINT FK_C70A33B53DA5256D FOREIGN KEY (image_id) REFERENCES product_image (id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F036C8A81A9 FOREIGN KEY (products_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product_image_product_color ADD CONSTRAINT FK_DA453A2CF6154FFA FOREIGN KEY (product_image_id) REFERENCES product_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_image_product_color ADD CONSTRAINT FK_DA453A2CB16A7522 FOREIGN KEY (product_color_id) REFERENCES product_color (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_variation ADD CONSTRAINT FK_C3B85674584665A FOREIGN KEY (product_id) REFERENCES product (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_image DROP FOREIGN KEY FK_64617F036C8A81A9');
        $this->addSql('ALTER TABLE product_variation DROP FOREIGN KEY FK_C3B85674584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADBE6903FD');
        $this->addSql('ALTER TABLE product_category_product_subcategory DROP FOREIGN KEY FK_D984A413BE6903FD');
        $this->addSql('ALTER TABLE product_image_product_color DROP FOREIGN KEY FK_DA453A2CB16A7522');
        $this->addSql('ALTER TABLE product_color DROP FOREIGN KEY FK_C70A33B53DA5256D');
        $this->addSql('ALTER TABLE product_image_product_color DROP FOREIGN KEY FK_DA453A2CF6154FFA');
        $this->addSql('ALTER TABLE product_category_product_subcategory DROP FOREIGN KEY FK_D984A413EAF807B');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD4D79775F');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_category');
        $this->addSql('DROP TABLE product_category_product_subcategory');
        $this->addSql('DROP TABLE product_color');
        $this->addSql('DROP TABLE product_image');
        $this->addSql('DROP TABLE product_image_product_color');
        $this->addSql('DROP TABLE product_subcategory');
        $this->addSql('DROP TABLE product_variation');
        $this->addSql('DROP TABLE tva');
    }
}
