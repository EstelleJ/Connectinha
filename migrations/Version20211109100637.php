<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211109100637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        // $this->addSql('ALTER TABLE prestations DROP FOREIGN KEY FK_B338D8D196689031');
        // $this->addSql('ALTER TABLE horaires DROP FOREIGN KEY FK_39B7118FD13C140');
        // $this->addSql('ALTER TABLE prestations DROP FOREIGN KEY FK_B338D8D1D13C140');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8D13C140');
        // $this->addSql('ALTER TABLE jours_horaires DROP FOREIGN KEY FK_507540128AF49C8B');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88AF49C8B');
        // $this->addSql('ALTER TABLE jours_horaires DROP FOREIGN KEY FK_507540126180639B');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8220C6AD0');
        // $this->addSql('ALTER TABLE prestations_payment_method DROP FOREIGN KEY FK_17D6BC078BE96D0D');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA89E45C554');
        // $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, street_nb VARCHAR(255) DEFAULT NULL, street_name VARCHAR(255) DEFAULT NULL, street_name_2 VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(10) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_81398E09A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE days (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE days_hours (days_id INT NOT NULL, hours_id INT NOT NULL, INDEX IDX_AFE1E9243575FA99 (days_id), INDEX IDX_AFE1E92423A564E6 (hours_id), PRIMARY KEY(days_id, hours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE distance (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, duration VARCHAR(16) NOT NULL, unity VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE duration (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(60) NOT NULL, duration INT NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE hours (id INT AUTO_INCREMENT NOT NULL, duration_id INT DEFAULT NULL, hour TIME NOT NULL, INDEX IDX_8A1ABD8D37B987D8 (duration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, duration_id INT DEFAULT NULL, distance_id INT DEFAULT NULL, tva_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT DEFAULT NULL, price INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_7332E16937B987D8 (duration_id), INDEX IDX_7332E16913192463 (distance_id), INDEX IDX_7332E1694D79775F (tva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE services_payment_method (services_id INT NOT NULL, payment_method_id INT NOT NULL, INDEX IDX_35042428AEF5A6C1 (services_id), INDEX IDX_350424285AA1164F (payment_method_id), PRIMARY KEY(services_id, payment_method_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('CREATE TABLE unavailable (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        // $this->addSql('ALTER TABLE days_hours ADD CONSTRAINT FK_AFE1E9243575FA99 FOREIGN KEY (days_id) REFERENCES days (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE days_hours ADD CONSTRAINT FK_AFE1E92423A564E6 FOREIGN KEY (hours_id) REFERENCES hours (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE hours ADD CONSTRAINT FK_8A1ABD8D37B987D8 FOREIGN KEY (duration_id) REFERENCES duration (id)');
        // $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16937B987D8 FOREIGN KEY (duration_id) REFERENCES duration (id)');
        // $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E16913192463 FOREIGN KEY (distance_id) REFERENCES distance (id)');
        // $this->addSql('ALTER TABLE services ADD CONSTRAINT FK_7332E1694D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
        // $this->addSql('ALTER TABLE services_payment_method ADD CONSTRAINT FK_35042428AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id) ON DELETE CASCADE');
        // $this->addSql('ALTER TABLE services_payment_method ADD CONSTRAINT FK_350424285AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) ON DELETE CASCADE');
        // $this->addSql('DROP TABLE client');
        // $this->addSql('DROP TABLE distance_rdv');
        // $this->addSql('DROP TABLE duree');
        // $this->addSql('DROP TABLE horaires');
        // $this->addSql('DROP TABLE indisponible');
        // $this->addSql('DROP TABLE jours');
        // $this->addSql('DROP TABLE jours_horaires');
        // $this->addSql('DROP TABLE prestations');
        // $this->addSql('DROP TABLE prestations_payment_method');
        // $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        // $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES customer (id)');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8220C6AD0');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88AF49C8B');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA89E45C554');
        // $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8D13C140');
        // $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8220C6AD0 FOREIGN KEY (jour_id) REFERENCES days (id)');
        // $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA88AF49C8B FOREIGN KEY (horaires_id) REFERENCES hours (id)');
        // $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA89E45C554 FOREIGN KEY (prestation_id) REFERENCES services (id)');
        // $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8D13C140 FOREIGN KEY (duree_id) REFERENCES duration (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE days_hours DROP FOREIGN KEY FK_AFE1E9243575FA99');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8220C6AD0');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E16913192463');
        $this->addSql('ALTER TABLE hours DROP FOREIGN KEY FK_8A1ABD8D37B987D8');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8D13C140');
        $this->addSql('ALTER TABLE services DROP FOREIGN KEY FK_7332E16937B987D8');
        $this->addSql('ALTER TABLE days_hours DROP FOREIGN KEY FK_AFE1E92423A564E6');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88AF49C8B');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA89E45C554');
        $this->addSql('ALTER TABLE services_payment_method DROP FOREIGN KEY FK_35042428AEF5A6C1');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, street_nb VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, street_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, street_name_2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, zipcode VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, city VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_C7440455A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE distance_rdv (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, duree VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, unite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE duree (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(60) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, duree INT NOT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE horaires (id INT AUTO_INCREMENT NOT NULL, duree_id INT DEFAULT NULL, horaire TIME NOT NULL, INDEX IDX_39B7118FD13C140 (duree_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE indisponible (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jours (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(16) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE jours_horaires (jours_id INT NOT NULL, horaires_id INT NOT NULL, INDEX IDX_507540126180639B (jours_id), INDEX IDX_507540128AF49C8B (horaires_id), PRIMARY KEY(jours_id, horaires_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prestations (id INT AUTO_INCREMENT NOT NULL, duree_id INT DEFAULT NULL, distance_rdv_id INT DEFAULT NULL, tva_id INT DEFAULT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, texte LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, prix INT DEFAULT NULL, slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, active TINYINT(1) NOT NULL, INDEX IDX_B338D8D196689031 (distance_rdv_id), INDEX IDX_B338D8D1D13C140 (duree_id), INDEX IDX_B338D8D14D79775F (tva_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE prestations_payment_method (prestations_id INT NOT NULL, payment_method_id INT NOT NULL, INDEX IDX_17D6BC078BE96D0D (prestations_id), INDEX IDX_17D6BC075AA1164F (payment_method_id), PRIMARY KEY(prestations_id, payment_method_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE horaires ADD CONSTRAINT FK_39B7118FD13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE jours_horaires ADD CONSTRAINT FK_507540126180639B FOREIGN KEY (jours_id) REFERENCES jours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jours_horaires ADD CONSTRAINT FK_507540128AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestations ADD CONSTRAINT FK_B338D8D14D79775F FOREIGN KEY (tva_id) REFERENCES tva (id)');
        $this->addSql('ALTER TABLE prestations ADD CONSTRAINT FK_B338D8D196689031 FOREIGN KEY (distance_rdv_id) REFERENCES distance_rdv (id)');
        $this->addSql('ALTER TABLE prestations ADD CONSTRAINT FK_B338D8D1D13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE prestations_payment_method ADD CONSTRAINT FK_17D6BC075AA1164F FOREIGN KEY (payment_method_id) REFERENCES payment_method (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestations_payment_method ADD CONSTRAINT FK_17D6BC078BE96D0D FOREIGN KEY (prestations_id) REFERENCES prestations (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE days');
        $this->addSql('DROP TABLE days_hours');
        $this->addSql('DROP TABLE distance');
        $this->addSql('DROP TABLE duration');
        $this->addSql('DROP TABLE hours');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE services_payment_method');
        $this->addSql('DROP TABLE unavailable');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8D13C140');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA8220C6AD0');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA88AF49C8B');
        $this->addSql('ALTER TABLE rendezvous DROP FOREIGN KEY FK_C09A9BA89E45C554');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8D13C140 FOREIGN KEY (duree_id) REFERENCES duree (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA8220C6AD0 FOREIGN KEY (jour_id) REFERENCES jours (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA88AF49C8B FOREIGN KEY (horaires_id) REFERENCES horaires (id)');
        $this->addSql('ALTER TABLE rendezvous ADD CONSTRAINT FK_C09A9BA89E45C554 FOREIGN KEY (prestation_id) REFERENCES prestations (id)');
    }
}
