<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818161501 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conducteur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, age INT NOT NULL, tel INT NOT NULL, numero_vol VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD conducteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id)');
        $this->addSql('CREATE INDEX IDX_42C84955F16F4AC6 ON reservation (conducteur_id)');
        $this->addSql('ALTER TABLE voiture ADD image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F16F4AC6');
        $this->addSql('DROP TABLE conducteur');
        $this->addSql('DROP INDEX IDX_42C84955F16F4AC6 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP conducteur_id');
        $this->addSql('ALTER TABLE voiture DROP image');
    }
}
