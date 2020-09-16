<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916015923 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE books ALTER author_id TYPE TEXT');
        $this->addSql('ALTER TABLE books ALTER author_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN books.author_id IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE users ALTER book_id TYPE TEXT');
        $this->addSql('ALTER TABLE users ALTER book_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN users.book_id IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE books ALTER author_id TYPE TEXT');
        $this->addSql('ALTER TABLE books ALTER author_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN books.author_id IS \'(DC2Type:simple_array)\'');
        $this->addSql('ALTER TABLE users ALTER book_id TYPE TEXT');
        $this->addSql('ALTER TABLE users ALTER book_id DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN users.book_id IS \'(DC2Type:simple_array)\'');
    }
}
