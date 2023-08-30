<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230830161749 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<SQL
CREATE TABLE coupons
(
    id       INT AUTO_INCREMENT       NOT NULL,
    coupon_code     VARCHAR(5)               NOT NULL,
    type     ENUM('fix', 'percent'),
    discount DOUBLE PRECISION         NOT NULL,
    PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8
  COLLATE `utf8_unicode_ci`
  ENGINE = InnoDB;
SQL
        );
        $this->addSql("INSERT INTO coupons (coupon_code, type, discount) VALUES ('D15', 'percent', 15), ('M5', 'percent', 5), ('A10', 'fix', 10)");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE coupons');
    }
}
