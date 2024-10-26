<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240918181006 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE calendrier_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE contrat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE document_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tache_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE calendrier (id INT NOT NULL, title VARCHAR(255) NOT NULL, start TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE contrat (id INT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, document_name VARCHAR(255) DEFAULT NULL, description TEXT NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, parties_impliquees VARCHAR(255) NOT NULL, statut VARCHAR(50) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_60349993A76ED395 ON contrat (user_id)');
        $this->addSql('CREATE TABLE document (id INT NOT NULL, contrat_associe_id INT DEFAULT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_de_modification TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(100) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, statut VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8698A76792CD4E7 ON document (contrat_associe_id)');
        $this->addSql('CREATE INDEX IDX_D8698A76A76ED395 ON document (user_id)');
        $this->addSql('CREATE TABLE tache (id INT NOT NULL, user_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, completed BOOLEAN NOT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_echeance TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, date_completion TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_93872075A76ED395 ON tache (user_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE contrat ADD CONSTRAINT FK_60349993A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76792CD4E7 FOREIGN KEY (contrat_associe_id) REFERENCES contrat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE calendrier_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE contrat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE document_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tache_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE contrat DROP CONSTRAINT FK_60349993A76ED395');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A76792CD4E7');
        $this->addSql('ALTER TABLE document DROP CONSTRAINT FK_D8698A76A76ED395');
        $this->addSql('ALTER TABLE tache DROP CONSTRAINT FK_93872075A76ED395');
        $this->addSql('DROP TABLE calendrier');
        $this->addSql('DROP TABLE contrat');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
