<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240822112854 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Make user_id column not null and add foreign key constraint.';
    }

    public function up(Schema $schema): void
    {
        // Add the foreign key constraint
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        
        // Alter the column to be NOT NULL
        $this->addSql('ALTER TABLE tache ALTER COLUMN user_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // Drop the foreign key constraint
        $this->addSql('ALTER TABLE tache DROP CONSTRAINT IF EXISTS FK_93872075A76ED395');
        
        // Alter the column to be NULL
        $this->addSql('ALTER TABLE tache ALTER COLUMN user_id DROP NOT NULL');
    }
}
