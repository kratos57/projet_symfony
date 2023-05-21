<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520224017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, travel_package_id INT DEFAULT NULL, INDEX IDX_E00CEDDE9395C3F3 (customer_id), INDEX IDX_E00CEDDEADF94A2C (travel_package_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, package_chosen_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_81398E09C964F846 (package_chosen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, prix DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_package (id INT AUTO_INCREMENT NOT NULL, destination VARCHAR(255) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEADF94A2C FOREIGN KEY (travel_package_id) REFERENCES travel_package (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09C964F846 FOREIGN KEY (package_chosen_id) REFERENCES travel_package (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDE9395C3F3');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDEADF94A2C');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09C964F846');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE travel_package');
    }
}
