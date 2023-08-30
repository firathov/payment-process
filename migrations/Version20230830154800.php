<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830154800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE country_taxes (id INT AUTO_INCREMENT NOT NULL, country VARCHAR(50) NOT NULL, tax DOUBLE PRECISION NOT NULL, country_code VARCHAR(2) NOT NULL,PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');

        $this->addSql("INSERT INTO country_taxes (country, tax, country_code) VALUES ('Германии', 0.19, 'DE'), ('Италии', 0.22, 'IT'), ('Франции', 0.2, 'FR'), ('Греции', 0.24, 'GR')");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE country_taxes');
    }
}
