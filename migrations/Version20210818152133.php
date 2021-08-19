<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210818152133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historic_question ADD question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historic_question ADD CONSTRAINT FK_D247F9B11E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('CREATE INDEX IDX_D247F9B11E27F6BF ON historic_question (question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE historic_question DROP FOREIGN KEY FK_D247F9B11E27F6BF');
        $this->addSql('DROP INDEX IDX_D247F9B11E27F6BF ON historic_question');
        $this->addSql('ALTER TABLE historic_question DROP question_id');
    }
}
