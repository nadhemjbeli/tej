<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220825101926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prix (id INT AUTO_INCREMENT NOT NULL, date_debut_s1 DATE NOT NULL, date_fin_s1 DATE NOT NULL, prix_s1 DOUBLE PRECISION NOT NULL, date_debut_s2 DATE NOT NULL, date_fin_s2 DATE NOT NULL, prix_s2 DOUBLE PRECISION NOT NULL, date_debut_s3 DATE NOT NULL, date_fin_s3 DATE NOT NULL, prix_s3 DOUBLE PRECISION NOT NULL, date_debut_s4 DATE NOT NULL, date_fin_s4 DATE NOT NULL, prix_s4 DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prix');
    }
}
