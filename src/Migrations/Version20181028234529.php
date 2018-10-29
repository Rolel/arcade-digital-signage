<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028234529 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE slide (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deck (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screen (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screen_deck (screen_id INT NOT NULL, deck_id INT NOT NULL, INDEX IDX_4F12C3B841A67722 (screen_id), INDEX IDX_4F12C3B8111948DC (deck_id), PRIMARY KEY(screen_id, deck_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screen_slide (screen_id INT NOT NULL, slide_id INT NOT NULL, INDEX IDX_FE8CE2641A67722 (screen_id), INDEX IDX_FE8CE26DD5AFB87 (slide_id), PRIMARY KEY(screen_id, slide_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE screen_deck ADD CONSTRAINT FK_4F12C3B841A67722 FOREIGN KEY (screen_id) REFERENCES screen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE screen_deck ADD CONSTRAINT FK_4F12C3B8111948DC FOREIGN KEY (deck_id) REFERENCES deck (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE screen_slide ADD CONSTRAINT FK_FE8CE2641A67722 FOREIGN KEY (screen_id) REFERENCES screen (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE screen_slide ADD CONSTRAINT FK_FE8CE26DD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE screen_slide DROP FOREIGN KEY FK_FE8CE26DD5AFB87');
        $this->addSql('ALTER TABLE screen_deck DROP FOREIGN KEY FK_4F12C3B8111948DC');
        $this->addSql('ALTER TABLE screen_deck DROP FOREIGN KEY FK_4F12C3B841A67722');
        $this->addSql('ALTER TABLE screen_slide DROP FOREIGN KEY FK_FE8CE2641A67722');
        $this->addSql('DROP TABLE slide');
        $this->addSql('DROP TABLE deck');
        $this->addSql('DROP TABLE screen');
        $this->addSql('DROP TABLE screen_deck');
        $this->addSql('DROP TABLE screen_slide');
    }
}
