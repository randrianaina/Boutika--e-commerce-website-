<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201008125848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categories DROP FOREIGN KEY FK_DC8B13829F34925F');
        $this->addSql('DROP INDEX IDX_DC8B13829F34925F ON sous_categories');
        $this->addSql('ALTER TABLE sous_categories CHANGE id_categorie_id categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categories ADD CONSTRAINT FK_DC8B1382A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_DC8B1382A21214B7 ON sous_categories (categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sous_categories DROP FOREIGN KEY FK_DC8B1382A21214B7');
        $this->addSql('DROP INDEX IDX_DC8B1382A21214B7 ON sous_categories');
        $this->addSql('ALTER TABLE sous_categories CHANGE categories_id id_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_categories ADD CONSTRAINT FK_DC8B13829F34925F FOREIGN KEY (id_categorie_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_DC8B13829F34925F ON sous_categories (id_categorie_id)');
    }
}
