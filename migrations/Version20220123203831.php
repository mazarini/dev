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
final class Version20220123203831 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create table USER';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "USER" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , name VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX USER_UNIQ_EMAIL ON "USER" (email)');
        $this->addSql('CREATE UNIQUE INDEX USER_UNIQ_NAME ON "USER" (name)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE "USER"');
    }
}
