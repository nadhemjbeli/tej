<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826185259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix CHANGE date_debut_s1 date_debut_s1 VARCHAR(10) NOT NULL, CHANGE date_debut_s2 date_debut_s2 VARCHAR(10) NOT NULL, CHANGE date_debut_s3 date_debut_s3 VARCHAR(10) NOT NULL, CHANGE date_debut_s4 date_debut_s4 VARCHAR(10) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix CHANGE date_debut_s1 date_debut_s1 DATE NOT NULL, CHANGE date_debut_s2 date_debut_s2 DATE NOT NULL, CHANGE date_debut_s3 date_debut_s3 DATE NOT NULL, CHANGE date_debut_s4 date_debut_s4 DATE NOT NULL');
    }
}
