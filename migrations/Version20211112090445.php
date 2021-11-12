<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112090445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE days_hours ADD CONSTRAINT FK_AFE1E9243575FA99 FOREIGN KEY (days_id) REFERENCES days (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE days_hours ADD CONSTRAINT FK_AFE1E92423A564E6 FOREIGN KEY (hours_id) REFERENCES hours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id)');
        $this->addSql('ALTER TABLE product_payment_method ADD CONSTRAINT FK_2808DFDA4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_payment_method ADD CONSTRAINT FK_2808DFDA5AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category_product_subcategory ADD CONSTRAINT FK_D984A413BE6903FD FOREIGN KEY (product_category_id) REFERENCES product_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_category_product_subcategory ADD CONSTRAINT FK_D984A413EAF807B FOREIGN KEY (product_subcategory_id) REFERENCES product_subcategory (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_image_product_color ADD CONSTRAINT FK_DA453A2CF6154FFA FOREIGN KEY (product_image_id) REFERENCES product_image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_image_product_color ADD CONSTRAINT FK_DA453A2CB16A7522 FOREIGN KEY (product_color_id) REFERENCES product_color (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE days_hours DROP FOREIGN KEY FK_AFE1E9243575FA99');
        $this->addSql('ALTER TABLE days_hours DROP FOREIGN KEY FK_AFE1E92423A564E6');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE5AA1164F');
        $this->addSql('ALTER TABLE product_category_product_subcategory DROP FOREIGN KEY FK_D984A413BE6903FD');
        $this->addSql('ALTER TABLE product_category_product_subcategory DROP FOREIGN KEY FK_D984A413EAF807B');
        $this->addSql('ALTER TABLE product_image_product_color DROP FOREIGN KEY FK_DA453A2CF6154FFA');
        $this->addSql('ALTER TABLE product_image_product_color DROP FOREIGN KEY FK_DA453A2CB16A7522');
        $this->addSql('ALTER TABLE product_payment_method DROP FOREIGN KEY FK_2808DFDA4584665A');
        $this->addSql('ALTER TABLE product_payment_method DROP FOREIGN KEY FK_2808DFDA5AA1164F');
    }
}
