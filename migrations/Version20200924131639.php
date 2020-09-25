<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924131639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fos_group (id UUID NOT NULL, name VARCHAR(180) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B019DDB5E237E06 ON fos_group (name)');
        $this->addSql('COMMENT ON COLUMN fos_group.roles IS \'(DC2Type:array)\'');
        $this->addSql('DROP INDEX uniq_1483a5e9f85e0677');
        $this->addSql('ALTER TABLE users ADD username_canonical VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE users ADD email VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE users ADD email_canonical VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE users ADD enabled BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE users ADD salt VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD confirmation_token VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE users ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE users ADD date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD website VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD biography VARCHAR(1000) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD gender VARCHAR(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD locale VARCHAR(8) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD timezone VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD phone VARCHAR(64) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD facebook_uid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD facebook_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD facebook_data JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD twitter_uid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD twitter_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD twitter_data JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD gplus_uid VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD gplus_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD gplus_data JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD token VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD two_step_code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE users ALTER firstname DROP NOT NULL');
        $this->addSql('ALTER TABLE users ALTER firstname TYPE VARCHAR(64)');
        $this->addSql('ALTER TABLE users ALTER lastname DROP NOT NULL');
        $this->addSql('ALTER TABLE users ALTER lastname TYPE VARCHAR(64)');
        $this->addSql('ALTER TABLE users ALTER roles TYPE TEXT');
        $this->addSql('ALTER TABLE users ALTER roles DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN users.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E992FC23A8 ON users (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A0D96FBF ON users (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9C05FB297 ON users (confirmation_token)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE fos_group');
        $this->addSql('DROP INDEX UNIQ_1483A5E992FC23A8');
        $this->addSql('DROP INDEX UNIQ_1483A5E9A0D96FBF');
        $this->addSql('DROP INDEX UNIQ_1483A5E9C05FB297');
        $this->addSql('ALTER TABLE "users" DROP username_canonical');
        $this->addSql('ALTER TABLE "users" DROP email');
        $this->addSql('ALTER TABLE "users" DROP email_canonical');
        $this->addSql('ALTER TABLE "users" DROP enabled');
        $this->addSql('ALTER TABLE "users" DROP salt');
        $this->addSql('ALTER TABLE "users" DROP last_login');
        $this->addSql('ALTER TABLE "users" DROP confirmation_token');
        $this->addSql('ALTER TABLE "users" DROP password_requested_at');
        $this->addSql('ALTER TABLE "users" DROP created_at');
        $this->addSql('ALTER TABLE "users" DROP updated_at');
        $this->addSql('ALTER TABLE "users" DROP date_of_birth');
        $this->addSql('ALTER TABLE "users" DROP website');
        $this->addSql('ALTER TABLE "users" DROP biography');
        $this->addSql('ALTER TABLE "users" DROP gender');
        $this->addSql('ALTER TABLE "users" DROP locale');
        $this->addSql('ALTER TABLE "users" DROP timezone');
        $this->addSql('ALTER TABLE "users" DROP phone');
        $this->addSql('ALTER TABLE "users" DROP facebook_uid');
        $this->addSql('ALTER TABLE "users" DROP facebook_name');
        $this->addSql('ALTER TABLE "users" DROP facebook_data');
        $this->addSql('ALTER TABLE "users" DROP twitter_uid');
        $this->addSql('ALTER TABLE "users" DROP twitter_name');
        $this->addSql('ALTER TABLE "users" DROP twitter_data');
        $this->addSql('ALTER TABLE "users" DROP gplus_uid');
        $this->addSql('ALTER TABLE "users" DROP gplus_name');
        $this->addSql('ALTER TABLE "users" DROP gplus_data');
        $this->addSql('ALTER TABLE "users" DROP token');
        $this->addSql('ALTER TABLE "users" DROP two_step_code');
        $this->addSql('ALTER TABLE "users" ALTER roles TYPE JSON');
        $this->addSql('ALTER TABLE "users" ALTER roles DROP DEFAULT');
        $this->addSql('ALTER TABLE "users" ALTER firstname SET NOT NULL');
        $this->addSql('ALTER TABLE "users" ALTER firstname TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE "users" ALTER lastname SET NOT NULL');
        $this->addSql('ALTER TABLE "users" ALTER lastname TYPE VARCHAR(255)');
        $this->addSql('COMMENT ON COLUMN "users".roles IS NULL');
        $this->addSql('CREATE UNIQUE INDEX uniq_1483a5e9f85e0677 ON "users" (username)');
    }
}
