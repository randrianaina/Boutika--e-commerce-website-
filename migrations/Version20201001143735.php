<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201001143735 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresse_livraison (id INT AUTO_INCREMENT NOT NULL, nom_contact VARCHAR(255) NOT NULL, prenom_contact VARCHAR(255) NOT NULL, adresse_contact VARCHAR(255) NOT NULL, cp_contact INT NOT NULL, ville_contact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, id_categorie_id INT NOT NULL, libelle_article VARCHAR(255) NOT NULL, prix_ht_article DOUBLE PRECISION NOT NULL, image_article VARCHAR(255) NOT NULL, INDEX IDX_BFDD31689F34925F (id_categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, libelle_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, id_type_livraison_id INT NOT NULL, id_adresse_livraison_id INT NOT NULL, id_utilisateur_id INT NOT NULL, date_commande DATE NOT NULL, montant_commande DOUBLE PRECISION NOT NULL, INDEX IDX_35D4282CF8202937 (id_type_livraison_id), INDEX IDX_35D4282CB2DFFB91 (id_adresse_livraison_id), INDEX IDX_35D4282CC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commandes (id INT AUTO_INCREMENT NOT NULL, id_commande_id INT NOT NULL, id_article_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_FA3127A49AF8E3A3 (id_commande_id), INDEX IDX_FA3127A4D71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_liste_envies (id INT AUTO_INCREMENT NOT NULL, id_article_id INT NOT NULL, id_liste_envies_id INT NOT NULL, INDEX IDX_9E827319D71E064B (id_article_id), INDEX IDX_9E82731990AD37F3 (id_liste_envies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE liste_envies (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT NOT NULL, UNIQUE INDEX UNIQ_265C33D6C6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE types_livraison (id INT AUTO_INCREMENT NOT NULL, libelle_livraison VARCHAR(255) NOT NULL, delai_livraison INT NOT NULL, frais_livraison DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, email_utilisateur VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, civilite_utilisateur VARCHAR(255) NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, adresse_utilisateur VARCHAR(255) NOT NULL, cp_utilisateur INT NOT NULL, ville_utilisateur VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_497B315EBDC1F04 (email_utilisateur), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CF8202937 FOREIGN KEY (id_type_livraison_id) REFERENCES types_livraison (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CB2DFFB91 FOREIGN KEY (id_adresse_livraison_id) REFERENCES adresse_livraison (id)');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282CC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateurs (id)');
        $this->addSql('ALTER TABLE ligne_commandes ADD CONSTRAINT FK_FA3127A49AF8E3A3 FOREIGN KEY (id_commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE ligne_commandes ADD CONSTRAINT FK_FA3127A4D71E064B FOREIGN KEY (id_article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE ligne_liste_envies ADD CONSTRAINT FK_9E827319D71E064B FOREIGN KEY (id_article_id) REFERENCES articles (id)');
        $this->addSql('ALTER TABLE ligne_liste_envies ADD CONSTRAINT FK_9E82731990AD37F3 FOREIGN KEY (id_liste_envies_id) REFERENCES liste_envies (id)');
        $this->addSql('ALTER TABLE liste_envies ADD CONSTRAINT FK_265C33D6C6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateurs (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CB2DFFB91');
        $this->addSql('ALTER TABLE ligne_commandes DROP FOREIGN KEY FK_FA3127A4D71E064B');
        $this->addSql('ALTER TABLE ligne_liste_envies DROP FOREIGN KEY FK_9E827319D71E064B');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689F34925F');
        $this->addSql('ALTER TABLE ligne_commandes DROP FOREIGN KEY FK_FA3127A49AF8E3A3');
        $this->addSql('ALTER TABLE ligne_liste_envies DROP FOREIGN KEY FK_9E82731990AD37F3');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CF8202937');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282CC6EE5C49');
        $this->addSql('ALTER TABLE liste_envies DROP FOREIGN KEY FK_265C33D6C6EE5C49');
        $this->addSql('DROP TABLE adresse_livraison');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE ligne_commandes');
        $this->addSql('DROP TABLE ligne_liste_envies');
        $this->addSql('DROP TABLE liste_envies');
        $this->addSql('DROP TABLE types_livraison');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
