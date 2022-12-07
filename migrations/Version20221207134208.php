<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221207134208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE personne_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE multiple_personne (multiple_id INT NOT NULL, personne_id INT NOT NULL, PRIMARY KEY(multiple_id, personne_id))');
        $this->addSql('CREATE INDEX IDX_FEA8B95FAEDC4C7D ON multiple_personne (multiple_id)');
        $this->addSql('CREATE INDEX IDX_FEA8B95FA21BD112 ON multiple_personne (personne_id)');
        $this->addSql('CREATE TABLE personne (id INT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE multiple_personne ADD CONSTRAINT FK_FEA8B95FAEDC4C7D FOREIGN KEY (multiple_id) REFERENCES multiple (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE multiple_personne ADD CONSTRAINT FK_FEA8B95FA21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE simple ADD personne_id INT NOT NULL');
        $this->addSql('ALTER TABLE simple ADD CONSTRAINT FK_C17B3D02A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C17B3D02A21BD112 ON simple (personne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE simple DROP CONSTRAINT FK_C17B3D02A21BD112');
        $this->addSql('DROP SEQUENCE personne_id_seq CASCADE');
        $this->addSql('ALTER TABLE multiple_personne DROP CONSTRAINT FK_FEA8B95FAEDC4C7D');
        $this->addSql('ALTER TABLE multiple_personne DROP CONSTRAINT FK_FEA8B95FA21BD112');
        $this->addSql('DROP TABLE multiple_personne');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP INDEX IDX_C17B3D02A21BD112');
        $this->addSql('ALTER TABLE simple DROP personne_id');
    }
}
