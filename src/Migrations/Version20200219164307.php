<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200219164307 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE asset_categories (id INT AUTO_INCREMENT NOT NULL, category_name VARCHAR(255) DEFAULT NULL, active TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assets (id INT AUTO_INCREMENT NOT NULL, individ_id INT NOT NULL, category_id INT DEFAULT NULL, asset_name VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_79D17D8E744B3D1B (individ_id), INDEX IDX_79D17D8E12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individ_connections (id INT AUTO_INCREMENT NOT NULL, individ1_id INT DEFAULT NULL, individ2_id INT DEFAULT NULL, timestamp DATETIME DEFAULT NULL, connection_type TINYINT(1) DEFAULT NULL, INDEX IDX_270FA1B45C7DAF42 (individ1_id), INDEX IDX_270FA1B44EC800AC (individ2_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE individuals (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, middle_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, individ_id INT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, active TINYINT(1) DEFAULT NULL, news_subscription TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9744B3D1B (individ_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assets ADD CONSTRAINT FK_79D17D8E744B3D1B FOREIGN KEY (individ_id) REFERENCES individuals (id)');
        $this->addSql('ALTER TABLE assets ADD CONSTRAINT FK_79D17D8E12469DE2 FOREIGN KEY (category_id) REFERENCES asset_categories (id)');
        $this->addSql('ALTER TABLE individ_connections ADD CONSTRAINT FK_270FA1B45C7DAF42 FOREIGN KEY (individ1_id) REFERENCES individuals (id)');
        $this->addSql('ALTER TABLE individ_connections ADD CONSTRAINT FK_270FA1B44EC800AC FOREIGN KEY (individ2_id) REFERENCES individuals (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9744B3D1B FOREIGN KEY (individ_id) REFERENCES individuals (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assets DROP FOREIGN KEY FK_79D17D8E12469DE2');
        $this->addSql('ALTER TABLE assets DROP FOREIGN KEY FK_79D17D8E744B3D1B');
        $this->addSql('ALTER TABLE individ_connections DROP FOREIGN KEY FK_270FA1B45C7DAF42');
        $this->addSql('ALTER TABLE individ_connections DROP FOREIGN KEY FK_270FA1B44EC800AC');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9744B3D1B');
        $this->addSql('DROP TABLE asset_categories');
        $this->addSql('DROP TABLE assets');
        $this->addSql('DROP TABLE individ_connections');
        $this->addSql('DROP TABLE individuals');
        $this->addSql('DROP TABLE users');
    }
}
