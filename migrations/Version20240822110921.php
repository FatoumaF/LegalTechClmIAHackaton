<?php
declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240822110921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add user_id column to tache table and set up foreign key relationship.';
    }

    public function up(Schema $schema): void
    {
        // Add the user_id column with nullable constraint
        $this->addSql('ALTER TABLE tache ADD user_id INT DEFAULT NULL');

        // Create the foreign key constraint
        // Note: We won't add it here until we have non-null values
        // $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        
        // Create an index on the user_id column
        $this->addSql('CREATE INDEX IDX_93872075A76ED395 ON tache (user_id)');
    }

    public function down(Schema $schema): void
    {
        // Remove the index
        $this->addSql('DROP INDEX IF EXISTS IDX_93872075A76ED395');

        // Drop the foreign key constraint
        // $this->addSql('ALTER TABLE tache DROP CONSTRAINT IF EXISTS FK_93872075A76ED395');

        // Remove the user_id column
        $this->addSql('ALTER TABLE tache DROP COLUMN user_id');
    }
}
