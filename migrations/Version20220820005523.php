<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220820005523 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conducteur ADD reservation_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_236771433C3B4EF0 FOREIGN KEY (reservation_id_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_236771433C3B4EF0 ON conducteur (reservation_id_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F16F4AC6');
        $this->addSql('DROP INDEX IDX_42C84955F16F4AC6 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP conducteur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_236771433C3B4EF0');
        $this->addSql('DROP INDEX IDX_236771433C3B4EF0 ON conducteur');
        $this->addSql('ALTER TABLE conducteur DROP reservation_id_id');
        $this->addSql('ALTER TABLE reservation ADD conducteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('CREATE INDEX IDX_42C84955F16F4AC6 ON reservation (conducteur_id)');
    }
}
