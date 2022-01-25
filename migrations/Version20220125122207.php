<?php

declare(strict_types=1);

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125122207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX UNIQ_8D93D64924A232CF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__USER AS SELECT id, email, roles, user_name, password, public_name FROM USER');
        $this->addSql('DROP TABLE USER');
        $this->addSql('CREATE TABLE USER (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL COLLATE BINARY, roles CLOB NOT NULL COLLATE BINARY --(DC2Type:json)
        , username VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL COLLATE BINARY, public_name VARCHAR(100) NOT NULL COLLATE BINARY)');
        $this->addSql('INSERT INTO USER (id, email, roles, username, password, public_name) SELECT id, email, roles, user_name, password, public_name FROM __temp__USER');
        $this->addSql('DROP TABLE __temp__USER');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON USER (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON USER (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, public_name, email, roles, username, password FROM "user"');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, public_name VARCHAR(100) NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , user_name VARCHAR(180) NOT NULL COLLATE BINARY, password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO "user" (id, public_name, email, roles, user_name, password) SELECT id, public_name, email, roles, username, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64924A232CF ON "user" (user_name)');
    }
}
