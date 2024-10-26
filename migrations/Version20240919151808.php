<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240919151808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modifie la colonne fichier pour qu\'elle soit de type JSON';
    }

    public function up(Schema $schema): void
    {
        // Modification pour utiliser le type JSON avec conversion explicite
        $this->addSql('ALTER TABLE document ALTER COLUMN fichiers TYPE JSON USING fichiers::json');
    }

    public function down(Schema $schema): void
    {
        // Revenir à un type VARCHAR(255) pour la colonne fichier
        $this->addSql('ALTER TABLE document ALTER COLUMN fichier TYPE VARCHAR(255)');
    }
}

