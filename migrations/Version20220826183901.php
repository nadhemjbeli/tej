<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220826183901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix DROP date_fin_s1, DROP date_fin_s2, DROP date_fin_s3, DROP date_fin_s4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prix ADD date_fin_s1 DATE NOT NULL, ADD date_fin_s2 DATE NOT NULL, ADD date_fin_s3 DATE NOT NULL, ADD date_fin_s4 DATE NOT NULL');
    }
}
