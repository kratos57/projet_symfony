<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230529125518 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_travel_package DROP FOREIGN KEY FK_A1F91BDADF94A2C');
        $this->addSql('ALTER TABLE reservation_travel_package DROP FOREIGN KEY FK_A1F91BDB83297E7');
        $this->addSql('ALTER TABLE reservation_user DROP FOREIGN KEY FK_9BAA1B21A76ED395');
        $this->addSql('ALTER TABLE reservation_user DROP FOREIGN KEY FK_9BAA1B21B83297E7');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE reservation_travel_package');
        $this->addSql('DROP TABLE reservation_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_travel_package (reservation_id INT NOT NULL, travel_package_id INT NOT NULL, INDEX IDX_A1F91BDB83297E7 (reservation_id), INDEX IDX_A1F91BDADF94A2C (travel_package_id), PRIMARY KEY(reservation_id, travel_package_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation_user (reservation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9BAA1B21B83297E7 (reservation_id), INDEX IDX_9BAA1B21A76ED395 (user_id), PRIMARY KEY(reservation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE reservation_travel_package ADD CONSTRAINT FK_A1F91BDADF94A2C FOREIGN KEY (travel_package_id) REFERENCES travel_package (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_travel_package ADD CONSTRAINT FK_A1F91BDB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_user ADD CONSTRAINT FK_9BAA1B21A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_user ADD CONSTRAINT FK_9BAA1B21B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
    }
}
