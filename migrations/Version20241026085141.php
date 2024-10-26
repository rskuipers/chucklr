<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241026085141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE giggle (id SERIAL NOT NULL, chuckle_id INT NOT NULL, giggler_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2FE8281ECB0643F3 ON giggle (chuckle_id)');
        $this->addSql('CREATE INDEX IDX_2FE8281EC29CD860 ON giggle (giggler_id)');
        $this->addSql('ALTER TABLE giggle ADD CONSTRAINT FK_2FE8281ECB0643F3 FOREIGN KEY (chuckle_id) REFERENCES chuckle (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE giggle ADD CONSTRAINT FK_2FE8281EC29CD860 FOREIGN KEY (giggler_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE giggle DROP CONSTRAINT FK_2FE8281ECB0643F3');
        $this->addSql('ALTER TABLE giggle DROP CONSTRAINT FK_2FE8281EC29CD860');
        $this->addSql('DROP TABLE giggle');
    }
}
