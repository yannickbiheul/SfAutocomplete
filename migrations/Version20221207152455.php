<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207152455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE search_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE search (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE personne ADD search_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF650760A9 FOREIGN KEY (search_id) REFERENCES search (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FCEC9EF650760A9 ON personne (search_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE personne DROP CONSTRAINT FK_FCEC9EF650760A9');
        $this->addSql('DROP SEQUENCE search_id_seq CASCADE');
        $this->addSql('DROP TABLE search');
        $this->addSql('DROP INDEX IDX_FCEC9EF650760A9');
        $this->addSql('ALTER TABLE personne DROP search_id');
    }
}
