<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220715062442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shift (id INT AUTO_INCREMENT NOT NULL, worker_id INT NOT NULL, shift_hours VARCHAR(50) NOT NULL, shift_date_time DATETIME NOT NULL, create_date_time DATETIME NOT NULL, update_date_time DATETIME NOT NULL, INDEX IDX_A50B3B456B20BA36 (worker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE worker (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, create_date_time DATETIME NOT NULL, update_date_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_9FB2BF625E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shift ADD CONSTRAINT FK_A50B3B456B20BA36 FOREIGN KEY (worker_id) REFERENCES worker (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shift DROP FOREIGN KEY FK_A50B3B456B20BA36');
        $this->addSql('DROP TABLE shift');
        $this->addSql('DROP TABLE worker');
    }
}
