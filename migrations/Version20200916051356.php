<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916051356 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_user (book_id UUID NOT NULL, user_id UUID NOT NULL, PRIMARY KEY(book_id, user_id))');
        $this->addSql('CREATE INDEX IDX_940E9D4116A2B381 ON book_user (book_id)');
        $this->addSql('CREATE INDEX IDX_940E9D41A76ED395 ON book_user (user_id)');
        $this->addSql('ALTER TABLE book_user ADD CONSTRAINT FK_940E9D4116A2B381 FOREIGN KEY (book_id) REFERENCES books (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_user ADD CONSTRAINT FK_940E9D41A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE books DROP author_id');
        $this->addSql('ALTER TABLE users DROP book_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE book_user');
        $this->addSql('ALTER TABLE books ADD author_id TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN books.author_id IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE users ADD book_id TEXT DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN users.book_id IS \'(DC2Type:array)\'');
    }
}
