<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201008124535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168F252D75F');
        $this->addSql('DROP INDEX IDX_BFDD3168F252D75F ON articles');
        $this->addSql('ALTER TABLE articles CHANGE id_sous_categorie_id sous_categories_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31689F751138 FOREIGN KEY (sous_categories_id) REFERENCES sous_categories (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31689F751138 ON articles (sous_categories_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31689F751138');
        $this->addSql('DROP INDEX IDX_BFDD31689F751138 ON articles');
        $this->addSql('ALTER TABLE articles CHANGE sous_categories_id id_sous_categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168F252D75F FOREIGN KEY (id_sous_categorie_id) REFERENCES sous_categories (id)');
        $this->addSql('CREATE INDEX IDX_BFDD3168F252D75F ON articles (id_sous_categorie_id)');
    }
}
