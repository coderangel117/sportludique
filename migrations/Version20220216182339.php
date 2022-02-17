<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216182339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE sportludique.user_produit ADD CONSTRAINT FK_A40BABA6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
//        $this->addSql('ALTER TABLE sportludique.user_produit ADD CONSTRAINT FK_A40BABA6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sportludique.user ADD email VARCHAR(255) NOT NULL');
//        $this->addSql('ALTER TABLE sportludique.user_produit ADD CONSTRAINT FK_71A8F22DF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE sportludique.avis DROP FOREIGN KEY FK_8F91ABF0F347EFB');
//        $this->addSql('ALTER TABLE sportludique.avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE sportludique.avis CHANGE contenu CONTENU VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`');
        $this->addSql('ALTER TABLE sportludique.produit CHANGE description description VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, CHANGE image image VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
//        $this->addSql('ALTER TABLE sportludique.produit_user DROP FOREIGN KEY FK_A40BABA6F347EFB');
//        $this->addSql('ALTER TABLE sportludique.produit_user DROP FOREIGN KEY FK_A40BABA6A76ED395');
        $this->addSql('ALTER TABLE sportludique.user DROP email, CHANGE username username VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
//        $this->addSql('ALTER TABLE sportludique.user_produit DROP FOREIGN KEY FK_71A8F22DF347EFB');
    }
}
