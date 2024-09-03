<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240826133451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update Tache table to set default values for specific columns.';
    }

    public function up(Schema $schema): void
    {
        // Make sure the table `tache` exists
        $this->addSql('ALTER TABLE tache ALTER completed SET DEFAULT false');
        $this->addSql('ALTER TABLE tache ALTER date_creation SET DEFAULT CURRENT_TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // Revert changes if necessary
        $this->addSql('ALTER TABLE tache ALTER completed DROP DEFAULT');
        $this->addSql('ALTER TABLE tache ALTER date_creation DROP DEFAULT');
    }
}
