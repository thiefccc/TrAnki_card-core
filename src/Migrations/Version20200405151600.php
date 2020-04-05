<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405151600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deck (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, shared TINYINT(1) NOT NULL, time_created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_settings (id INT AUTO_INCREMENT NOT NULL, card_id INT NOT NULL, weight INT NOT NULL, again SMALLINT NOT NULL, easy SMALLINT NOT NULL, normal SMALLINT NOT NULL, hard SMALLINT NOT NULL, last_time_stadied DATETIME DEFAULT NULL, INDEX IDX_5C746E464ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card_settings ADD CONSTRAINT FK_5C746E464ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id)');
        $this->addSql('ALTER TABLE card ADD deck_id INT NOT NULL, ADD time_created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3111948DC FOREIGN KEY (deck_id) REFERENCES deck (id)');
        $this->addSql('CREATE INDEX IDX_161498D3111948DC ON card (deck_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE card DROP FOREIGN KEY FK_161498D3111948DC');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE card_settings');
        $this->addSql('DROP INDEX IDX_161498D3111948DC ON card');
        $this->addSql('ALTER TABLE card DROP deck_id, DROP time_created');
    }
}
