<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403195800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE system (id INT AUTO_INCREMENT NOT NULL, discovered_by_id INT DEFAULT NULL, owner_id INT DEFAULT NULL, seed INT NOT NULL, size VARCHAR(255) NOT NULL, discovered_at DATETIME DEFAULT NULL, name VARCHAR(255) NOT NULL, public_name VARCHAR(255) DEFAULT NULL, x DOUBLE PRECISION DEFAULT NULL, y DOUBLE PRECISION DEFAULT NULL, speed DOUBLE PRECISION DEFAULT NULL, INDEX IDX_C94D118BC3951C6B (discovered_by_id), INDEX IDX_C94D118B7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, online TINYINT(1) NOT NULL, flag VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE system ADD CONSTRAINT FK_C94D118BC3951C6B FOREIGN KEY (discovered_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE system ADD CONSTRAINT FK_C94D118B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE system DROP FOREIGN KEY FK_C94D118BC3951C6B');
        $this->addSql('ALTER TABLE system DROP FOREIGN KEY FK_C94D118B7E3C61F9');
        $this->addSql('DROP TABLE system');
        $this->addSql('DROP TABLE user');
    }
}
