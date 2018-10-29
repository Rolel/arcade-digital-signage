<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181029220719 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE game_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_brand (game_id INT NOT NULL, brand_id INT NOT NULL, INDEX IDX_2E6180D7E48FD905 (game_id), INDEX IDX_2E6180D744F5D008 (brand_id), PRIMARY KEY(game_id, brand_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_game_category (game_id INT NOT NULL, game_category_id INT NOT NULL, INDEX IDX_7EC7A8CE48FD905 (game_id), INDEX IDX_7EC7A8CCC13DFE0 (game_category_id), PRIMARY KEY(game_id, game_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE score (id INT AUTO_INCREMENT NOT NULL, scoreboard_id INT DEFAULT NULL, value INT NOT NULL, date DATE NOT NULL, INDEX IDX_32993751F22C936C (scoreboard_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scoreboard (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type INT NOT NULL, INDEX IDX_2F6BDA2AE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_brand ADD CONSTRAINT FK_2E6180D7E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_brand ADD CONSTRAINT FK_2E6180D744F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_game_category ADD CONSTRAINT FK_7EC7A8CE48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_game_category ADD CONSTRAINT FK_7EC7A8CCC13DFE0 FOREIGN KEY (game_category_id) REFERENCES game_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE score ADD CONSTRAINT FK_32993751F22C936C FOREIGN KEY (scoreboard_id) REFERENCES scoreboard (id)');
        $this->addSql('ALTER TABLE scoreboard ADD CONSTRAINT FK_2F6BDA2AE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('DROP TABLE deck_slide');
        $this->addSql('DROP TABLE screen_deck');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_game_category DROP FOREIGN KEY FK_7EC7A8CCC13DFE0');
        $this->addSql('ALTER TABLE game_brand DROP FOREIGN KEY FK_2E6180D7E48FD905');
        $this->addSql('ALTER TABLE game_game_category DROP FOREIGN KEY FK_7EC7A8CE48FD905');
        $this->addSql('ALTER TABLE scoreboard DROP FOREIGN KEY FK_2F6BDA2AE48FD905');
        $this->addSql('ALTER TABLE game_brand DROP FOREIGN KEY FK_2E6180D744F5D008');
        $this->addSql('ALTER TABLE score DROP FOREIGN KEY FK_32993751F22C936C');
        $this->addSql('CREATE TABLE deck_slide (deck_id INT NOT NULL, slide_id INT NOT NULL, INDEX IDX_B3B2148D111948DC (deck_id), INDEX IDX_B3B2148DDD5AFB87 (slide_id), PRIMARY KEY(deck_id, slide_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screen_deck (screen_id INT NOT NULL, deck_id INT NOT NULL, INDEX IDX_4F12C3B841A67722 (screen_id), INDEX IDX_4F12C3B8111948DC (deck_id), PRIMARY KEY(screen_id, deck_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deck_slide ADD CONSTRAINT FK_B3B2148D111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deck_slide ADD CONSTRAINT FK_B3B2148DDD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE screen_deck ADD CONSTRAINT FK_4F12C3B8111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE screen_deck ADD CONSTRAINT FK_4F12C3B841A67722 FOREIGN KEY (screen_id) REFERENCES screen (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE game_category');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_brand');
        $this->addSql('DROP TABLE game_game_category');
        $this->addSql('DROP TABLE score');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE scoreboard');
    }
}
