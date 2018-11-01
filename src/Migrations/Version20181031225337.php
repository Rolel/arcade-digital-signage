<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181031225337 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slide ADD scoreboard_id INT DEFAULT NULL, ADD count INT DEFAULT NULL');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE62F22C936C FOREIGN KEY (scoreboard_id) REFERENCES scoreboard (id)');
        $this->addSql('CREATE INDEX IDX_72EFEE62F22C936C ON slide (scoreboard_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE62F22C936C');
        $this->addSql('DROP INDEX IDX_72EFEE62F22C936C ON slide');
        $this->addSql('ALTER TABLE slide DROP scoreboard_id, DROP count');
    }
}
