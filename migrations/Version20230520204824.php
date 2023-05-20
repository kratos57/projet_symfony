<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520204824 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD user_id_id INT NOT NULL, ADD voyage_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE75D4A2B8 FOREIGN KEY (voyage_id_id) REFERENCES voyage (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE9D86650F ON booking (user_id_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE75D4A2B8 ON booking (voyage_id_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493301C60');
        $this->addSql('DROP INDEX IDX_8D93D6493301C60 ON user');
        $this->addSql('ALTER TABLE user DROP booking_id');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89553301C60');
        $this->addSql('DROP INDEX IDX_3F9D89553301C60 ON voyage');
        $this->addSql('ALTER TABLE voyage DROP booking_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9D86650F');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE75D4A2B8');
        $this->addSql('DROP INDEX IDX_E00CEDDE9D86650F ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE75D4A2B8 ON booking');
        $this->addSql('ALTER TABLE booking DROP user_id_id, DROP voyage_id_id');
        $this->addSql('ALTER TABLE user ADD booking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493301C60 ON user (booking_id)');
        $this->addSql('ALTER TABLE voyage ADD booking_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89553301C60 FOREIGN KEY (booking_id) REFERENCES booking (id)');
        $this->addSql('CREATE INDEX IDX_3F9D89553301C60 ON voyage (booking_id)');
    }
}
