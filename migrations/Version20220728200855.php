<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728200855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) DEFAULT NULL, datede_naissance DATETIME NOT NULL, adresse VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(50) NOT NULL, fonction_dansla_sté VARCHAR(50) DEFAULT NULL, sociéte VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salaries (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_de_naissance DATETIME NOT NULL, sexe VARCHAR(12) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, code_postal INT DEFAULT NULL, ville VARCHAR(53) DEFAULT NULL, courriel VARCHAR(255) DEFAULT NULL, fonction VARCHAR(255) NOT NULL, date_entree DATETIME NOT NULL, salaire INT DEFAULT NULL, nombrecongespris INT DEFAULT NULL, nombre_conges_restants INT DEFAULT NULL, cadre TINYINT(1) NOT NULL, date_passage_cadre DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE societe (id INT AUTO_INCREMENT NOT NULL, nomste VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, codepostal INT NOT NULL, ville VARCHAR(255) NOT NULL, siteweb VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE salaries');
        $this->addSql('DROP TABLE societe');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
