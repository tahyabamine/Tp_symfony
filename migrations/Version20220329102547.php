<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329102547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF968F5EA509');
        $this->addSql('DROP INDEX IDX_8F87BF968F5EA509 ON classe');
        $this->addSql('ALTER TABLE classe ADD eleve_id INT DEFAULT NULL, DROP classe_id');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF96A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF96A6CC7B2 ON classe (eleve_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe DROP FOREIGN KEY FK_8F87BF96A6CC7B2');
        $this->addSql('DROP INDEX IDX_8F87BF96A6CC7B2 ON classe');
        $this->addSql('ALTER TABLE classe ADD classe_id INT NOT NULL, DROP eleve_id');
        $this->addSql('ALTER TABLE classe ADD CONSTRAINT FK_8F87BF968F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_8F87BF968F5EA509 ON classe (classe_id)');
    }
}
