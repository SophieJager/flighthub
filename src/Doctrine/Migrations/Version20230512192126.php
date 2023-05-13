<?php

declare(strict_types=1);

namespace App\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512192126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create all tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE airline_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE airport_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flight_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE airline (id INT NOT NULL, code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, uuid UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EC141EF8D17F50A6 ON airline (uuid)');
        $this->addSql('COMMENT ON COLUMN airline.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE airport (id INT NOT NULL, city_id INT NOT NULL, code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, timezone VARCHAR(255) DEFAULT NULL, uuid UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E91F7C2D17F50A6 ON airport (uuid)');
        $this->addSql('CREATE INDEX IDX_7E91F7C28BAC62AF ON airport (city_id)');
        $this->addSql('COMMENT ON COLUMN airport.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, code VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, region_code VARCHAR(255) DEFAULT NULL, uuid UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B0234D17F50A6 ON city (uuid)');
        $this->addSql('COMMENT ON COLUMN city.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE flight (id INT NOT NULL, airline_id INT NOT NULL, departure_airport_id INT NOT NULL, arrival_airport_id INT NOT NULL, number INT DEFAULT NULL, departure_time TIMESTAMP(0) WITH TIME ZONE NOT NULL, arrival_time TIMESTAMP(0) WITH TIME ZONE NOT NULL, price DOUBLE PRECISION DEFAULT NULL, uuid UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C257E60ED17F50A6 ON flight (uuid)');
        $this->addSql('CREATE INDEX IDX_C257E60E130D0C16 ON flight (airline_id)');
        $this->addSql('CREATE INDEX IDX_C257E60EF631AB5C ON flight (departure_airport_id)');
        $this->addSql('CREATE INDEX IDX_C257E60E7F43E343 ON flight (arrival_airport_id)');
        $this->addSql('COMMENT ON COLUMN flight.departure_time IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('COMMENT ON COLUMN flight.arrival_time IS \'(DC2Type:datetimetz_immutable)\'');
        $this->addSql('COMMENT ON COLUMN flight.uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(255) NOT NULL, roles TEXT NOT NULL, password VARCHAR(255) NOT NULL, uuid UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D17F50A6 ON "user" (uuid)');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN "user".uuid IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE airport ADD CONSTRAINT FK_7E91F7C28BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E130D0C16 FOREIGN KEY (airline_id) REFERENCES airline (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60EF631AB5C FOREIGN KEY (departure_airport_id) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flight ADD CONSTRAINT FK_C257E60E7F43E343 FOREIGN KEY (arrival_airport_id) REFERENCES airport (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EC141EF877153098 ON airline (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E91F7C277153098 ON airport (code)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2D5B023477153098 ON city (code)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE airline_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE airport_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flight_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('ALTER TABLE airport DROP CONSTRAINT FK_7E91F7C28BAC62AF');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E130D0C16');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60EF631AB5C');
        $this->addSql('ALTER TABLE flight DROP CONSTRAINT FK_C257E60E7F43E343');
        $this->addSql('DROP INDEX UNIQ_7E91F7C277153098');
        $this->addSql('DROP INDEX UNIQ_2D5B023477153098');
        $this->addSql('DROP INDEX UNIQ_EC141EF877153098');
        $this->addSql('DROP TABLE airline');
        $this->addSql('DROP TABLE airport');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE flight');
        $this->addSql('DROP TABLE "user"');
    }
}
