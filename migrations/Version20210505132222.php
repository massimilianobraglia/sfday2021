<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210505132222 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(<<<SQL
CREATE TABLE record_label (
    id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
)
SQL
        );

        $this->addSql("INSERT INTO record_label (id, name) VALUES (1, 'EMI')");
        $this->addSql("INSERT INTO record_label (id, name) VALUES (2, 'Universal')");
        $this->addSql("INSERT INTO record_label (id, name) VALUES (3, 'Virgin')");
        $this->addSql("INSERT INTO record_label (id, name) VALUES (4, 'Nuclear Blast')");
        for ($i = 5; $i <= 30; ++$i) {
            $this->addSql("INSERT INTO record_label (id, name) VALUES ({$i}, 'Record Label {$i}')");
        }

        $this->addSql(<<<SQL
CREATE TABLE webzine (
    id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
)
SQL
        );

        $this->addSql("INSERT INTO webzine (id, name) VALUES (1, 'Classic Rock')");
        $this->addSql("INSERT INTO webzine (id, name) VALUES (2, 'Rolling Stone')");
        $this->addSql("INSERT INTO webzine (id, name) VALUES (3, 'Spazio Rock')");
        $this->addSql("INSERT INTO webzine (id, name) VALUES (4, 'Impatto sonoro')");
        for ($i = 5; $i <= 30; ++$i) {
            $this->addSql("INSERT INTO webzine (id, name) VALUES ({$i}, 'Webzine {$i}')");
        }

        $this->addSql(<<<SQL
CREATE TABLE band (
    id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    foundation_date DATETIME NOT NULL --(DC2Type:datetime_immutable)
    ,
    genre VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
)
SQL
        );

        $this->addSql("INSERT INTO band (id, name, foundation_date, genre) VALUES (1, 'Anabasi Road', '2009-09-01 00:00:00', 'ROCK')");
        $this->addSql("INSERT INTO band (id, name, foundation_date, genre) VALUES (2, 'Queen', '1970-06-30 00:00:00', 'ROCK')");
        $this->addSql("INSERT INTO band (id, name, foundation_date, genre) VALUES (3, 'Lady Gaga', '1986-03-28 00:00:00', 'POP')");
        $this->addSql("INSERT INTO band (id, name, foundation_date, genre) VALUES (4, 'Iron Maiden', '1975-05-02 00:00:00', 'HEAVY_METAL')");
        for ($i = 5; $i <= 30; ++$i) {
            $this->addSql("INSERT INTO band (id, name, foundation_date, genre) VALUES ({$i}, 'Band {$i}', DATETIME('now', 'localtime'), 'POP')");
        }

        $this->addSql(<<<SQL
CREATE TABLE user (
    id INTEGER NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id)
)
SQL
        );

        $this->addSql(<<<SQL
CREATE TABLE album (
    id INTEGER NOT NULL,
    band_id INTEGER NOT NULL,
    name VARCHAR(255) NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(band_id) REFERENCES band(id)
)
SQL
        );
        $this->addSql('CREATE INDEX IDX_39986E4349ABEB17 ON album (band_id)');

        $this->addSql("INSERT INTO album (id, band_id, name) VALUES (1, 1, 'Anabasi Road')");
        $this->addSql("INSERT INTO album (id, band_id, name) VALUES (2, 1, 'Ages')");
        $this->addSql("INSERT INTO album (id, band_id, name) VALUES (3, 2, 'A Night At The Opera')");
        $this->addSql("INSERT INTO album (id, band_id, name) VALUES (4, 3, 'The Fame')");
        $this->addSql("INSERT INTO album (id, band_id, name) VALUES (5, 4, 'The Number Of The Beast')");
        $id = 6;
        for ($bandId = 5; $bandId <= 30; ++$bandId) {
            for ($i = 1; $i <= 30; ++$i) {
                $this->addSql("INSERT INTO album (id, band_id, name) VALUES ({$id}, {$bandId}, 'Album numero {$id}')");
                ++$id;
            }
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE band');
        $this->addSql('DROP TABLE webzine');
        $this->addSql('DROP TABLE record_label');
    }
}
