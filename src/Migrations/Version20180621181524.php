<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180621181524 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD176665648E9');
        $this->addSql('DROP INDEX UNIQ_34DCD176665648E9 ON person');
        $this->addSql('ALTER TABLE person DROP color');
        $this->addSql('DROP INDEX person_id_UNIQUE ON person_data');
        $this->addSql('ALTER TABLE person_data CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE product ADD color VARCHAR(45) DEFAULT NULL, ADD website LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE person ADD color INT DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD176665648E9 FOREIGN KEY (color) REFERENCES person_data (person_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD176665648E9 ON person (color)');
        $this->addSql('ALTER TABLE person_data CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX person_id_UNIQUE ON person_data (person_id)');
        $this->addSql('ALTER TABLE product DROP color, DROP website');
    }
}
