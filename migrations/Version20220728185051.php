<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728185051 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_reservation ADD id_voiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE admin_reservation ADD CONSTRAINT FK_42C84955A40B286D FOREIGN KEY (id_voiture_id) REFERENCES voiture (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A40B286D ON admin_reservation (id_voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin_reservation DROP FOREIGN KEY FK_42C84955A40B286D');
        $this->addSql('DROP INDEX IDX_42C84955A40B286D ON admin_reservation');
        $this->addSql('ALTER TABLE admin_reservation DROP id_voiture_id');
    }
}
