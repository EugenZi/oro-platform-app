<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:03 PM
 */

namespace Ezi\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class EziIssueResolution implements Migration
{

    const TABLE_NAME = 'ezi_issue_resolution';

    /**
     * Modifies the given schema to apply necessary changes of a database
     * The given query bag can be used to apply additional SQL queries before and after schema changes
     *
     * @param Schema $schema
     * @param QueryBag $queries
     * @return void
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        if ($schema->hasTable(self::TABLE_NAME)) {
            $schema->dropTable(self::TABLE_NAME);
        }

        $table = $schema->createTable(self::TABLE_NAME);

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('resolution', 'string', ['notnull' => true, 'length' => 32]);

        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['resolution'], 'ISSUE_RESOLUTION_UNIQ_IDX');

        $this->createRelations($schema);
    }

    protected function createRelations(Schema $schema)
    {

    }
}