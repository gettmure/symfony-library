<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200918104351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE users ALTER username TYPE VARCHAR(180)');
        $this->addSql('ALTER TABLE users ALTER password TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE users ALTER password DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "users" DROP roles');
        $this->addSql('ALTER TABLE "users" ALTER username TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "users" ALTER password TYPE TEXT');
        $this->addSql('ALTER TABLE "users" ALTER password DROP DEFAULT');
    }
}
