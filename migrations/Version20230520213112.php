<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520213112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD travel_package_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEADF94A2C FOREIGN KEY (travel_package_id) REFERENCES travel_package (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEADF94A2C ON booking (travel_package_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEADF94A2C');
        $this->addSql('DROP INDEX IDX_E00CEDDEADF94A2C ON booking');
        $this->addSql('ALTER TABLE booking DROP travel_package_id');
    }
}
