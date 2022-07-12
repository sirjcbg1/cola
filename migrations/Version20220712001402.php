<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712001402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cola (id INT AUTO_INCREMENT NOT NULL, descripcion VARCHAR(25) NOT NULL, tiempo_atencion INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_cola (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_cola_id INT DEFAULT NULL, fecha_hora DATETIME NOT NULL, INDEX IDX_C220324079F37AE5 (id_user_id), INDEX IDX_C220324046558BF1 (id_cola_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_cola ADD CONSTRAINT FK_C220324079F37AE5 FOREIGN KEY (id_user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_cola ADD CONSTRAINT FK_C220324046558BF1 FOREIGN KEY (id_cola_id) REFERENCES cola (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_cola DROP FOREIGN KEY FK_C220324046558BF1');
        $this->addSql('ALTER TABLE user_cola DROP FOREIGN KEY FK_C220324079F37AE5');
        $this->addSql('DROP TABLE cola');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_cola');
    }
}
