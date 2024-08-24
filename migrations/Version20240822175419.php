<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240822175419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE document_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_test_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE calendrier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE calendrier (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE user_test');
        $this->addSql('ALTER TABLE contrat ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE contrat RENAME COLUMN parties_impliquées TO parties_impliquees');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_60349993A76ED395 ON contrat (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE calendrier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_test (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('ALTER TABLE contrat DROP CONSTRAINT FK_60349993A76ED395');
        $this->addSql('DROP INDEX IDX_60349993A76ED395');
        $this->addSql('ALTER TABLE contrat DROP user_id');
        $this->addSql('ALTER TABLE contrat RENAME COLUMN parties_impliquees TO "parties_impliquées"');
    }
}
