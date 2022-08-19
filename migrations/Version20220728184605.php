<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728184605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_reservation ADD lieu_prise VARCHAR(255) NOT NULL, ADD lieu_reprise VARCHAR(255) NOT NULL, ADD date_prise DATE NOT NULL, ADD date_reprise DATE NOT NULL, ADD heure_prise VARCHAR(255) NOT NULL, ADD heure_reprise VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_reservation DROP lieu_prise, DROP lieu_reprise, DROP date_prise, DROP date_reprise, DROP heure_prise, DROP heure_reprise');
    }
}
