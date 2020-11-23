<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123184708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE redirect_counter (id INT AUTO_INCREMENT NOT NULL, short_link_id INT NOT NULL, redirected_date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_77F65414605D5D9 (short_link_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE redirect_counter ADD CONSTRAINT FK_77F65414605D5D9 FOREIGN KEY (short_link_id) REFERENCES short_link (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE redirect_counter');
    }
}
