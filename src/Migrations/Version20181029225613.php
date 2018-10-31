<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181029225613 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE game_brand');
        $this->addSql('DROP TABLE game_game_category');
        $this->addSql('ALTER TABLE game ADD brand_id INT DEFAULT NULL, ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C12469DE2 FOREIGN KEY (category_id) REFERENCES game_category (id)');
        $this->addSql('CREATE INDEX IDX_232B318C44F5D008 ON game (brand_id)');
        $this->addSql('CREATE INDEX IDX_232B318C12469DE2 ON game (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE game_brand (game_id INT NOT NULL, brand_id INT NOT NULL, INDEX IDX_2E6180D7E48FD905 (game_id), INDEX IDX_2E6180D744F5D008 (brand_id), PRIMARY KEY(game_id, brand_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_game_category (game_id INT NOT NULL, game_category_id INT NOT NULL, INDEX IDX_7EC7A8CE48FD905 (game_id), INDEX IDX_7EC7A8CCC13DFE0 (game_category_id), PRIMARY KEY(game_id, game_category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_brand ADD CONSTRAINT FK_2E6180D744F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_brand ADD CONSTRAINT FK_2E6180D7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_game_category ADD CONSTRAINT FK_7EC7A8CCC13DFE0 FOREIGN KEY (game_category_id) REFERENCES game_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_game_category ADD CONSTRAINT FK_7EC7A8CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C44F5D008');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C12469DE2');
        $this->addSql('DROP INDEX IDX_232B318C44F5D008 ON game');
        $this->addSql('DROP INDEX IDX_232B318C12469DE2 ON game');
        $this->addSql('ALTER TABLE game DROP brand_id, DROP category_id');
    }
}
