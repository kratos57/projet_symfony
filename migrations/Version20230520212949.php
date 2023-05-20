<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230520212949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer ADD package_chosen_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09C964F846 FOREIGN KEY (package_chosen_id) REFERENCES travel_package (id)');
        $this->addSql('CREATE INDEX IDX_81398E09C964F846 ON customer (package_chosen_id)');
        $this->addSql('ALTER TABLE travel_package DROP FOREIGN KEY FK_1F2BD0849395C3F3');
        $this->addSql('DROP INDEX IDX_1F2BD0849395C3F3 ON travel_package');
        $this->addSql('ALTER TABLE travel_package DROP customer_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09C964F846');
        $this->addSql('DROP INDEX IDX_81398E09C964F846 ON customer');
        $this->addSql('ALTER TABLE customer DROP package_chosen_id');
        $this->addSql('ALTER TABLE travel_package ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE travel_package ADD CONSTRAINT FK_1F2BD0849395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_1F2BD0849395C3F3 ON travel_package (customer_id)');
    }
}
