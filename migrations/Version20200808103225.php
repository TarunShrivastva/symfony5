<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200808103225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD content_id INT NOT NULL, ADD category_id INT NOT NULL, ADD language_id INT NOT NULL, ADD image VARCHAR(255) NOT NULL, ADD status TINYINT(1) NOT NULL, ADD recent TINYINT(1) NOT NULL, ADD feature TINYINT(1) NOT NULL, ADD popular TINYINT(1) NOT NULL, ADD how TINYINT(1) NOT NULL, ADD published TINYINT(1) NOT NULL, ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6684A0A3ED FOREIGN KEY (content_id) REFERENCES content_types (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E6682F1BAF4 FOREIGN KEY (language_id) REFERENCES language (id)');
        $this->addSql('CREATE INDEX IDX_23A0E6684A0A3ED ON article (content_id)');
        $this->addSql('CREATE INDEX IDX_23A0E6612469DE2 ON article (category_id)');
        $this->addSql('CREATE INDEX IDX_23A0E6682F1BAF4 ON article (language_id)');
        $this->addSql('ALTER TABLE article RENAME INDEX idx_23a0e6669ccbe9a TO IDX_23A0E66F675F31B');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6684A0A3ED');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6612469DE2');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E6682F1BAF4');
        $this->addSql('DROP INDEX IDX_23A0E6684A0A3ED ON article');
        $this->addSql('DROP INDEX IDX_23A0E6612469DE2 ON article');
        $this->addSql('DROP INDEX IDX_23A0E6682F1BAF4 ON article');
        $this->addSql('ALTER TABLE article DROP content_id, DROP category_id, DROP language_id, DROP image, DROP status, DROP recent, DROP feature, DROP popular, DROP how, DROP published, DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE article RENAME INDEX idx_23a0e66f675f31b TO IDX_23A0E6669CCBE9A');
    }
}
