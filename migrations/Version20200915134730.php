<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200915134730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ALTER name TYPE TEXT');
        $this->addSql('ALTER TABLE book ALTER name DROP DEFAULT');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE5A3315E237E06 ON book (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_CBE5A3315E237E06');
        $this->addSql('ALTER TABLE book ALTER name TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE book ALTER name DROP DEFAULT');
    }
}
