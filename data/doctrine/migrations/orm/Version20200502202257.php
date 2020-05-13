<?php

declare(strict_types=1);

namespace Woda\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

final class Version20200502202257 extends AbstractMigration
{
    private const USER_TABLE = 'users';

    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $table = $schema->createTable(self::USER_TABLE);
        $table->addColumn('id', Types::STRING, ['is_unique' => true, 'notnull' => true]);
        $table->addColumn('email', Types::STRING, ['is_unique' => true, 'notnull' => true]);
        $table->addColumn('password_hash', Types::STRING, ['notnull' => true]);
        $table->setPrimaryKey(['id']);
    }

    public function down(Schema $schema) : void
    {
        $schema->dropTable(self::USER_TABLE);
    }
}
