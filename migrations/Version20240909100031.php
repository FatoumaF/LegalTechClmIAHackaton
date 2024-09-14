<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240909100031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE user_test_id_seq CASCADE');
        $this->addSql('DROP TABLE user_test');
        $this->addSql('ALTER TABLE contrat ADD document_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE contrat ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE user_test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_test (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE contrat DROP document_name');
        $this->addSql('ALTER TABLE contrat DROP updated_at');
    }
}
