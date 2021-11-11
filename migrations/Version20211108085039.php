<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108085039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE distance_rdv (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, duree VARCHAR(16) NOT NULL, unite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE duree (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(60) NOT NULL, duree INT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, duree_id INT DEFAULT NULL, horaire TIME NOT NULL, INDEX IDX_39B7118FD13C140 (duree_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE indisponible (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jours (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(16) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jours_horaires (jours_id INT NOT NULL, horaires_id INT NOT NULL, INDEX IDX_507540126180639B (jours_id), INDEX IDX_507540128AF49C8B (horaires_id), PRIMARY KEY(jours_id, horaires_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestations (id INT AUTO_INCREMENT NOT NULL, duree_id INT DEFAULT NULL, distance_rdv_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, texte LONGTEXT DEFAULT NULL, prix INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_B338D8D1D13C140 (duree_id), INDEX IDX_B338D8D196689031 (distance_rdv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rendezvous (id INT AUTO_INCREMENT NOT NULL, duree_id INT DEFAULT NULL, jour_id INT DEFAULT NULL, horaires_id INT DEFAULT NULL, prestation_id INT DEFAULT NULL, date DATE NOT NULL, name VARCHAR(64) NOT NULL, firstname VARCHAR(64) NOT NULL, email VARCHAR(128) NOT NULL, phone_number VARCHAR(16) NOT NULL, token VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C09A9BA85F37A13B (token), INDEX IDX_C09A9BA8D13C140 (duree_id), INDEX IDX_C09A9BA8220C6AD0 (jour_id), INDEX IDX_C09A9BA88AF49C8B (horaires_id), INDEX IDX_C09A9BA89E45C554 (prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE horaires ADD CONSTRAINT FK_39B7118FD13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE jours_horaires ADD CONSTRAINT FK_507540126180639B FOREIGN KEY (jours_id) REFERENCES jours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jours_horaires ADD CONSTRAINT FK_507540128AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestations ADD CONSTRAINT FK_B338D8D1D13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE prestations ADD CONSTRAINT FK_B338D8D196689031 FOREIGN KEY (distance_rdv_id) REFERENCES distance_rdv (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8D13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8220C6AD0 FOREIGN KEY (jour_id) REFERENCES jours (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA88AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA89E45C554 FOREIGN KEY (prestation_id) REFERENCES prestations (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestations DROP FOREIGN KEY FK_B338D8D196689031');
        $this->addSql('ALTER TABLE horaires DROP FOREIGN KEY FK_39B7118FD13C140');
        $this->addSql('ALTER TABLE prestations DROP FOREIGN KEY FK_B338D8D1D13C140');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8D13C140');
        $this->addSql('ALTER TABLE jours_horaires DROP FOREIGN KEY FK_507540128AF49C8B');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88AF49C8B');
        $this->addSql('ALTER TABLE jours_horaires DROP FOREIGN KEY FK_507540126180639B');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8220C6AD0');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA89E45C554');
        $this->addSql('DROP TABLE distance_rdv');
        $this->addSql('DROP TABLE duree');
        $this->addSql('DROP TABLE horaires');
        $this->addSql('DROP TABLE indisponible');
        $this->addSql('DROP TABLE jours');
        $this->addSql('DROP TABLE jours_horaires');
        $this->addSql('DROP TABLE prestations');
        $this->addSql('DROP TABLE rendezvous');
    }
}
