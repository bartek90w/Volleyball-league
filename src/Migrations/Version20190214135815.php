<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214135815 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE league DROP FOREIGN KEY FK_3EB4C3187E3C61F9');
        $this->addSql('ALTER TABLE league CHANGE owner_id owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE league ADD CONSTRAINT FK_3EB4C3187E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE league DROP FOREIGN KEY FK_3EB4C3187E3C61F9');
        $this->addSql('ALTER TABLE league CHANGE owner_id owner_id INT NOT NULL');
        $this->addSql('ALTER TABLE league ADD CONSTRAINT FK_3EB4C3187E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
    }
}
