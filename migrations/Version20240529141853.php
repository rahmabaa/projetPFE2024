<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529141853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alerte (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alerte_boite_fibre (alerte_id INT NOT NULL, boite_fibre_id INT NOT NULL, INDEX IDX_254B8F192C9BA629 (alerte_id), INDEX IDX_254B8F19AFD2ADB4 (boite_fibre_id), PRIMARY KEY(alerte_id, boite_fibre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alerte_boite_fibre ADD CONSTRAINT FK_254B8F192C9BA629 FOREIGN KEY (alerte_id) REFERENCES alerte (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alerte_boite_fibre ADD CONSTRAINT FK_254B8F19AFD2ADB4 FOREIGN KEY (boite_fibre_id) REFERENCES boite_fibre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alerte_boite_fibre DROP FOREIGN KEY FK_254B8F192C9BA629');
        $this->addSql('ALTER TABLE alerte_boite_fibre DROP FOREIGN KEY FK_254B8F19AFD2ADB4');
        $this->addSql('DROP TABLE alerte');
        $this->addSql('DROP TABLE alerte_boite_fibre');
    }
}
