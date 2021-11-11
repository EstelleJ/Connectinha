<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111102253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES customer (id)');
        $this->addSql('DROP INDEX IDX_C09A9BA88AF49C8B ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA8D13C140 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA8220C6AD0 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA89E45C554 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous ADD duration_id INT DEFAULT NULL, ADD day_id INT DEFAULT NULL, ADD hours_id INT DEFAULT NULL, ADD service_id INT DEFAULT NULL, DROP duree_id, DROP jour_id, DROP horaires_id, DROP prestation_id');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA837B987D8 FOREIGN KEY (duration_id) REFERENCES duration (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA89C24126 FOREIGN KEY (day_id) REFERENCES days (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA823A564E6 FOREIGN KEY (hours_id) REFERENCES hours (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8ED5CA9E6 FOREIGN KEY (service_id) REFERENCES services (id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA837B987D8 ON rendezvous (duration_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA89C24126 ON rendezvous (day_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA823A564E6 ON rendezvous (hours_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8ED5CA9E6 ON rendezvous (service_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA837B987D8');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA89C24126');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA823A564E6');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8ED5CA9E6');
        $this->addSql('DROP INDEX IDX_C09A9BA837B987D8 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA89C24126 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA823A564E6 ON rendezvous');
        $this->addSql('DROP INDEX IDX_C09A9BA8ED5CA9E6 ON rendezvous');
        $this->addSql('ALTER TABLE rendezvous ADD duree_id INT DEFAULT NULL, ADD jour_id INT DEFAULT NULL, ADD horaires_id INT DEFAULT NULL, ADD prestation_id INT DEFAULT NULL, DROP duration_id, DROP day_id, DROP hours_id, DROP service_id');
        $this->addSql('CREATE INDEX IDX_C09A9BA88AF49C8B ON rendezvous (horaires_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8D13C140 ON rendezvous (duree_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA8220C6AD0 ON rendezvous (jour_id)');
        $this->addSql('CREATE INDEX IDX_C09A9BA89E45C554 ON rendezvous (prestation_id)');
    }
}
