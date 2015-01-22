<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:02 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssuePriority;

class BapIssuePriority implements Migration
{
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
        if ($schema->hasTable(IssuePriority::TABLE_NAME)) {
            $schema->dropTable(IssuePriority::TABLE_NAME);
        }

        $this->createIndexes(
            $this->createColumns(
                $schema->createTable(IssuePriority::TABLE_NAME)
            )
        );
    }

    private function createColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);
        $table->addColumn('priority', 'integer', ['length' => 3]);

        return $table;
    }

    private function createIndexes(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['priority'], 'BAP_ISSUE_PRIORITY_FIELD_UNIQUE_IDX');

        return $table;
    }
}