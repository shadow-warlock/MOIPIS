<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110170554 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characteristic (id INT AUTO_INCREMENT NOT NULL, measure_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_522FA9505DA37D00 (measure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE characteristic_value (id INT AUTO_INCREMENT NOT NULL, characteristic_id INT NOT NULL, product_id INT NOT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_719F040EDEE9D12B (characteristic_id), INDEX IDX_719F040E4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, product_id INT NOT NULL, component_group_id INT NOT NULL, count NUMERIC(10, 2) NOT NULL, INDEX IDX_49FEA1574584665A (product_id), INDEX IDX_49FEA157BC564DAA (component_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE component_group (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, product_id INT NOT NULL, name VARCHAR(255) NOT NULL, type TINYINT(1) NOT NULL, required TINYINT(1) NOT NULL, INDEX IDX_A2C6F1EB727ACA70 (parent_id), INDEX IDX_A2C6F1EB4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, si VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, parent_class_id INT NOT NULL, process_id INT NOT NULL, prev_operation_id INT DEFAULT NULL, INDEX IDX_1981A66D75CDA7C1 (parent_class_id), INDEX IDX_1981A66D7EC2F574 (process_id), UNIQUE INDEX UNIQ_1981A66D870ABB87 (prev_operation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_tool (tool_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_F8363408F7B22CC (tool_id), INDEX IDX_F8363404584665A (product_id), PRIMARY KEY(tool_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_equipment (equipment_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_40D45C61517FE9FE (equipment_id), INDEX IDX_40D45C614584665A (product_id), PRIMARY KEY(equipment_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operation_class (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6A6CCA10727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, complectation JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_product (order_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_2530ADE68D9F6D38 (order_id), INDEX IDX_2530ADE64584665A (product_id), PRIMARY KEY(order_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE process (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, measure_id INT NOT NULL, parent_class_id INT NOT NULL, name VARCHAR(255) NOT NULL, is_tool TINYINT(1) NOT NULL, is_equipment TINYINT(1) NOT NULL, INDEX IDX_D34A04AD5DA37D00 (measure_id), INDEX IDX_D34A04AD75CDA7C1 (parent_class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_class (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_4C1762C3727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_class_characteristic (product_class_id INT NOT NULL, characteristic_id INT NOT NULL, INDEX IDX_8AF9041721B06187 (product_class_id), INDEX IDX_8AF90417DEE9D12B (characteristic_id), PRIMARY KEY(product_class_id, characteristic_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characteristic ADD CONSTRAINT FK_522FA9505DA37D00 FOREIGN KEY (measure_id) REFERENCES measure (id)');
        $this->addSql('ALTER TABLE characteristic_value ADD CONSTRAINT FK_719F040EDEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id)');
        $this->addSql('ALTER TABLE characteristic_value ADD CONSTRAINT FK_719F040E4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA1574584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE component ADD CONSTRAINT FK_49FEA157BC564DAA FOREIGN KEY (component_group_id) REFERENCES component_group (id)');
        $this->addSql('ALTER TABLE component_group ADD CONSTRAINT FK_A2C6F1EB727ACA70 FOREIGN KEY (parent_id) REFERENCES component_group (id)');
        $this->addSql('ALTER TABLE component_group ADD CONSTRAINT FK_A2C6F1EB4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D75CDA7C1 FOREIGN KEY (parent_class_id) REFERENCES operation_class (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D7EC2F574 FOREIGN KEY (process_id) REFERENCES process (id)');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D870ABB87 FOREIGN KEY (prev_operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE operation_tool ADD CONSTRAINT FK_F8363408F7B22CC FOREIGN KEY (tool_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE operation_tool ADD CONSTRAINT FK_F8363404584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE operation_equipment ADD CONSTRAINT FK_40D45C61517FE9FE FOREIGN KEY (equipment_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE operation_equipment ADD CONSTRAINT FK_40D45C614584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE operation_class ADD CONSTRAINT FK_6A6CCA10727ACA70 FOREIGN KEY (parent_id) REFERENCES operation_class (id)');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE68D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_product ADD CONSTRAINT FK_2530ADE64584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5DA37D00 FOREIGN KEY (measure_id) REFERENCES measure (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD75CDA7C1 FOREIGN KEY (parent_class_id) REFERENCES product_class (id)');
        $this->addSql('ALTER TABLE product_class ADD CONSTRAINT FK_4C1762C3727ACA70 FOREIGN KEY (parent_id) REFERENCES product_class (id)');
        $this->addSql('ALTER TABLE product_class_characteristic ADD CONSTRAINT FK_8AF9041721B06187 FOREIGN KEY (product_class_id) REFERENCES product_class (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_class_characteristic ADD CONSTRAINT FK_8AF90417DEE9D12B FOREIGN KEY (characteristic_id) REFERENCES characteristic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characteristic_value DROP FOREIGN KEY FK_719F040EDEE9D12B');
        $this->addSql('ALTER TABLE product_class_characteristic DROP FOREIGN KEY FK_8AF90417DEE9D12B');
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA157BC564DAA');
        $this->addSql('ALTER TABLE component_group DROP FOREIGN KEY FK_A2C6F1EB727ACA70');
        $this->addSql('ALTER TABLE characteristic DROP FOREIGN KEY FK_522FA9505DA37D00');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5DA37D00');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D870ABB87');
        $this->addSql('ALTER TABLE operation_tool DROP FOREIGN KEY FK_F8363408F7B22CC');
        $this->addSql('ALTER TABLE operation_equipment DROP FOREIGN KEY FK_40D45C61517FE9FE');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D75CDA7C1');
        $this->addSql('ALTER TABLE operation_class DROP FOREIGN KEY FK_6A6CCA10727ACA70');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE68D9F6D38');
        $this->addSql('ALTER TABLE operation DROP FOREIGN KEY FK_1981A66D7EC2F574');
        $this->addSql('ALTER TABLE characteristic_value DROP FOREIGN KEY FK_719F040E4584665A');
        $this->addSql('ALTER TABLE component DROP FOREIGN KEY FK_49FEA1574584665A');
        $this->addSql('ALTER TABLE component_group DROP FOREIGN KEY FK_A2C6F1EB4584665A');
        $this->addSql('ALTER TABLE operation_tool DROP FOREIGN KEY FK_F8363404584665A');
        $this->addSql('ALTER TABLE operation_equipment DROP FOREIGN KEY FK_40D45C614584665A');
        $this->addSql('ALTER TABLE order_product DROP FOREIGN KEY FK_2530ADE64584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD75CDA7C1');
        $this->addSql('ALTER TABLE product_class DROP FOREIGN KEY FK_4C1762C3727ACA70');
        $this->addSql('ALTER TABLE product_class_characteristic DROP FOREIGN KEY FK_8AF9041721B06187');
        $this->addSql('DROP TABLE characteristic');
        $this->addSql('DROP TABLE characteristic_value');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE component_group');
        $this->addSql('DROP TABLE measure');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE operation_tool');
        $this->addSql('DROP TABLE operation_equipment');
        $this->addSql('DROP TABLE operation_class');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_product');
        $this->addSql('DROP TABLE process');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_class');
        $this->addSql('DROP TABLE product_class_characteristic');
    }
}
