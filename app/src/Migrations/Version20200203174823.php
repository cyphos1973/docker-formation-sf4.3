<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203174823 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE student (id INT UNSIGNED AUTO_INCREMENT NOT NULL, classroom_id INT UNSIGNED DEFAULT NULL, first_name VARCHAR(64) NOT NULL, last_name VARCHAR(128) NOT NULL, birth_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', gender TINYINT(1) NOT NULL, first_mark SMALLINT DEFAULT NULL, second_mark SMALLINT DEFAULT NULL, average NUMERIC(5, 2) DEFAULT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_B723AF33D17F50A6 (uuid), INDEX IDX_B723AF336278D5A8 (classroom_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classroom (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, grade SMALLINT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_497D309DD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF336278D5A8 FOREIGN KEY (classroom_id) REFERENCES classroom (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF336278D5A8');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE user');
    }
}
