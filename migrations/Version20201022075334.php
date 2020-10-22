<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201022075334 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_livraison ADD id_utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse_livraison ADD CONSTRAINT FK_B0B09C9C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_B0B09C9C6EE5C49 ON adresse_livraison (id_utilisateur_id)');
        $this->addSql('ALTER TABLE utilisateurs CHANGE civilite_utilisateur civilite_utilisateur VARCHAR(255) NOT NULL, CHANGE nom_utilisateur nom_utilisateur VARCHAR(255) NOT NULL, CHANGE prenom_utilisateur prenom_utilisateur VARCHAR(255) NOT NULL, CHANGE adresse_utilisateur adresse_utilisateur VARCHAR(255) NOT NULL, CHANGE cp_utilisateur cp_utilisateur INT NOT NULL, CHANGE ville_utilisateur ville_utilisateur VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse_livraison DROP FOREIGN KEY FK_B0B09C9C6EE5C49');
        $this->addSql('DROP INDEX IDX_B0B09C9C6EE5C49 ON adresse_livraison');
        $this->addSql('ALTER TABLE adresse_livraison DROP id_utilisateur_id');
        $this->addSql('ALTER TABLE utilisateurs CHANGE civilite_utilisateur civilite_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_utilisateur nom_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom_utilisateur prenom_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adresse_utilisateur adresse_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE cp_utilisateur cp_utilisateur INT DEFAULT NULL, CHANGE ville_utilisateur ville_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
