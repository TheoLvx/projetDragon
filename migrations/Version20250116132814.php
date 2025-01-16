<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116132814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE choix (id INT AUTO_INCREMENT NOT NULL, le_scenario_id INT NOT NULL, texte VARCHAR(255) NOT NULL, hp VARCHAR(255) NOT NULL, explications VARCHAR(255) NOT NULL, intelligence INT NOT NULL, attaque INT NOT NULL, INDEX IDX_4F488091A16933C0 (le_scenario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(5000) NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE perso (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, hp INT NOT NULL, attaque INT NOT NULL, intelligence INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenario (id INT AUTO_INCREMENT NOT NULL, le_niveau_id INT NOT NULL, nom VARCHAR(255) NOT NULL, contexte VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_3E45C8D8D2268876 (le_niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE choix ADD CONSTRAINT FK_4F488091A16933C0 FOREIGN KEY (le_scenario_id) REFERENCES scenario (id)');
        $this->addSql('ALTER TABLE scenario ADD CONSTRAINT FK_3E45C8D8D2268876 FOREIGN KEY (le_niveau_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE choix DROP FOREIGN KEY FK_4F488091A16933C0');
        $this->addSql('ALTER TABLE scenario DROP FOREIGN KEY FK_3E45C8D8D2268876');
        $this->addSql('DROP TABLE choix');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE perso');
        $this->addSql('DROP TABLE scenario');
        $this->addSql('DROP TABLE user');
    }
}
