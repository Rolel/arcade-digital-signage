<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181029160429 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE deck_has_slide (id INT AUTO_INCREMENT NOT NULL, deck_id INT NOT NULL, slide_id INT NOT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, INDEX IDX_5C5F888B111948DC (deck_id), INDEX IDX_5C5F888BDD5AFB87 (slide_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deck_has_slide ADD CONSTRAINT FK_5C5F888B111948DC FOREIGN KEY (deck_id) REFERENCES deck (id)');
        $this->addSql('ALTER TABLE deck_has_slide ADD CONSTRAINT FK_5C5F888BDD5AFB87 FOREIGN KEY (slide_id) REFERENCES slide (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE deck_has_slide');
    }
}
