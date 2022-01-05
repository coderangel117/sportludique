<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211218153409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP INDEX I_FK_AVIS_PRODUIT ON avis');
        $this->addSql('DROP INDEX I_FK_AVIS_UTILISATEUR ON avis');
        $this->addSql('ALTER TABLE avis ADD date DATE NOT NULL, DROP ID_ECRIT, DROP ID_CONCERNE, DROP DATE_CREATION, CHANGE ID id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('DROP INDEX I_FK_PRODUIT_UTILISATEUR ON produit');
        $this->addSql('ALTER TABLE produit DROP ID_PANIER, DROP QUANTITE, CHANGE ID id INT AUTO_INCREMENT NOT NULL, CHANGE DESCRIPTION description VARCHAR(255) DEFAULT NULL, CHANGE PRIX prix DOUBLE PRECISION DEFAULT NULL, CHANGE IMAGE image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_produit ADD CONSTRAINT FK_71A8F22DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (ID INT NOT NULL, USERNAME CHAR(32) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, ROLES CHAR(32) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PASSWORD CHAR(32) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(ID)) DEFAULT CHARACTER SET latin1 COLLATE `latin1_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE avis ADD ID_ECRIT INT NOT NULL, ADD ID_CONCERNE INT NOT NULL, ADD DATE_CREATION DATETIME DEFAULT NULL, DROP date, CHANGE id ID INT NOT NULL');
        $this->addSql('CREATE INDEX I_FK_AVIS_PRODUIT ON avis (ID_CONCERNE)');
        $this->addSql('CREATE INDEX I_FK_AVIS_UTILISATEUR ON avis (ID_ECRIT)');
        $this->addSql('ALTER TABLE produit ADD ID_PANIER INT DEFAULT NULL, ADD QUANTITE BIGINT NOT NULL, CHANGE id ID INT NOT NULL, CHANGE description DESCRIPTION VARCHAR(128) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE prix PRIX NUMERIC(10, 2) NOT NULL, CHANGE image IMAGE CHAR(32) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('CREATE INDEX I_FK_PRODUIT_UTILISATEUR ON produit (ID_PANIER)');
        $this->addSql('ALTER TABLE user_produit DROP FOREIGN KEY FK_71A8F22DF347EFB');
    }
}
