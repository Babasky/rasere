<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250527092347 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE accueil (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, slogan VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE coordinateur (id INT AUTO_INCREMENT NOT NULL, year VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE forum (id INT AUTO_INCREMENT NOT NULL, photo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, subgroup_id INT DEFAULT NULL, specialite_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) NOT NULL, INDEX IDX_F6B4FB29F5C464CE (subgroup_id), INDEX IDX_F6B4FB292195E0F0 (specialite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE responsite (id INT AUTO_INCREMENT NOT NULL, site_id INT DEFAULT NULL, firstnam VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) NOT NULL, poste VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, INDEX IDX_5ED21D3BF6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE secretaire_general (id INT AUTO_INCREMENT NOT NULL, year VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE specialite (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE subgroup (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO `user` (email, roles, password, firstname, lastname) VALUES ('admin@rasere.com', '["ROLE_USER"]', '$2y$13$qW/qEVw7JQ188FfkcpvpVepilq6ExR5ivt/gYfMPyvLUTtYW1F0XK', 'Admin', 'Rasere')
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29F5C464CE FOREIGN KEY (subgroup_id) REFERENCES subgroup (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB292195E0F0 FOREIGN KEY (specialite_id) REFERENCES specialite (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE responsite ADD CONSTRAINT FK_5ED21D3BF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29F5C464CE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB292195E0F0
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE responsite DROP FOREIGN KEY FK_5ED21D3BF6BD1646
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE accueil
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE coordinateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE forum
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
            DROP TABLE `user`
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
