<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826123357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, contrat_associe_id INT DEFAULT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_de_modification TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(100) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, statut VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8698A76792CD4E7 ON document (contrat_associe_id)');
        $this->addSql('CREATE INDEX IDX_D8698A76A76ED395 ON document (user_id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76792CD4E7 FOREIGN KEY (contrat_associe_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE document_id_seq CASCADE');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A76792CD4E7');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A76A76ED395');
        $this->addSql('DROP TABLE document');
    }
}
