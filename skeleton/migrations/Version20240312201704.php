<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240312201704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE coupon ALTER code TYPE VARCHAR(10)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64BF3F025E237E06 ON coupon (name)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64BF3F0277153098 ON coupon (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD5E237E06 ON product (name)');
        $this->addSql('ALTER TABLE tax_number ALTER country TYPE VARCHAR(2)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DA4A75FF5E237E06 ON tax_number (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_64BF3F025E237E06');
        $this->addSql('DROP INDEX UNIQ_64BF3F0277153098');
        $this->addSql('ALTER TABLE coupon ALTER code TYPE VARCHAR(3)');
        $this->addSql('DROP INDEX UNIQ_D34A04AD5E237E06');
        $this->addSql('DROP INDEX UNIQ_DA4A75FF5E237E06');
        $this->addSql('ALTER TABLE tax_number ALTER country TYPE VARCHAR(3)');
    }
}
