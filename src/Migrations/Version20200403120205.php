<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200403120205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE card (id INT AUTO_INCREMENT NOT NULL, type_id_id INT NOT NULL, front_value VARCHAR(255) DEFAULT NULL, back_value VARCHAR(255) DEFAULT NULL, front_formating VARCHAR(1000) DEFAULT NULL, back_formating VARCHAR(1000) DEFAULT NULL, INDEX IDX_161498D3714819A0 (type_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3714819A0 FOREIGN KEY (type_id_id) REFERENCES card_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3714819A0');
        $this->addSql('DROP TABLE card');
        $this->addSql('DROP TABLE card_type');
    }
}
