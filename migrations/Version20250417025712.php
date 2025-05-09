<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417025712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE accueil (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL, slogan VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE membre (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, subgroup_id INTEGER NOT NULL, specialite_id INTEGER DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) NOT NULL, CONSTRAINT FK_F6B4FB29F5C464CE FOREIGN KEY (subgroup_id) REFERENCES subgroup (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_F6B4FB292195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F6B4FB29F5C464CE ON membre (subgroup_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F6B4FB292195E0F0 ON membre (specialite_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE responsite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, site_id INTEGER DEFAULT NULL, firstnam VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, CONSTRAINT FK_5ED21D3BF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5ED21D3BF6BD1646 ON responsite (site_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE secretaire_general (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, year VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE site (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE specialite (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE subgroup (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
            , password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO "user" (email, roles, password, firstname, lastname) VALUES ('admin@rasere.com', '["ROLE_ADMIN"]', '$2y$13$v3sMjMkU6Dm3NL6XKDfpC.c0t4Hh79xDpiZcM3Coxb2Bzo06T6/j2', 'Admin', 'Admin')
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE accueil
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE membre
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE responsite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ressource
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE secretaire_general
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE site
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE specialite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE subgroup
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
