<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214115252 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, captain_id INT NOT NULL, league_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C4E0A61F3346729B (captain_id), INDEX IDX_C4E0A61F58AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F3346729B FOREIGN KEY (captain_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F58AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE user ADD team_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649296CD8AE ON user (team_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649296CD8AE');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP INDEX IDX_8D93D649296CD8AE ON user');
        $this->addSql('ALTER TABLE user DROP team_id');
    }
}
