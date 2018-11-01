<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181101181726 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slide ADD gametype_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE62414AC6D8 FOREIGN KEY (gametype_id) REFERENCES game_category (id)');
        $this->addSql('CREATE INDEX IDX_72EFEE62414AC6D8 ON slide (gametype_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE62414AC6D8');
        $this->addSql('DROP INDEX IDX_72EFEE62414AC6D8 ON slide');
        $this->addSql('ALTER TABLE slide DROP gametype_id');
    }
}
