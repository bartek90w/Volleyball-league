<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190222182912 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE league_table (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, team_id INT NOT NULL, points INT NOT NULL, matches_played INT NOT NULL, matches_win INT NOT NULL, matches_lost INT NOT NULL, sets_win INT NOT NULL, sets_lost INT NOT NULL, points_win INT NOT NULL, points_lost INT NOT NULL, result30 INT NOT NULL, result31 INT NOT NULL, result32 INT NOT NULL, result23 INT NOT NULL, result13 INT NOT NULL, result03 INT NOT NULL, UNIQUE INDEX UNIQ_81C4607058AFC4DE (league_id), UNIQUE INDEX UNIQ_81C46070296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE league_table ADD CONSTRAINT FK_81C4607058AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE league_table ADD CONSTRAINT FK_81C46070296CD8AE FOREIGN KEY (team_id) REFERENCES team (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE league_table');
    }
}
