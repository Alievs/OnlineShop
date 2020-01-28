<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200128161502 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cart_line (id INT AUTO_INCREMENT NOT NULL, total_price INT NOT NULL, quantity INT NOT NULL, sold TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_line_product (cart_line_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_106117A3B6A1BD45 (cart_line_id), INDEX IDX_106117A34584665A (product_id), PRIMARY KEY(cart_line_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_line_product ADD CONSTRAINT FK_106117A3B6A1BD45 FOREIGN KEY (cart_line_id) REFERENCES cart_line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_line_product ADD CONSTRAINT FK_106117A34584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart DROP total_price, DROP quantity, DROP sold');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart_line_product DROP FOREIGN KEY FK_106117A3B6A1BD45');
        $this->addSql('DROP TABLE cart_line');
        $this->addSql('DROP TABLE cart_line_product');
        $this->addSql('ALTER TABLE cart ADD total_price INT NOT NULL, ADD quantity INT NOT NULL, ADD sold TINYINT(1) NOT NULL');
    }
}
