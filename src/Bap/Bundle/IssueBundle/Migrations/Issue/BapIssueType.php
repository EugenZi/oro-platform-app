<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:01 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssueType;

class BapIssueType implements Migration
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
        if ($schema->hasTable(IssueType::TABLE_NAME)) {
            $schema->dropTable(IssueType::TABLE_NAME);
        }

        $this->createIndexes(
            $this->createColumns(
                $schema->createTable(IssueType::TABLE_NAME)
            )
        );
    }

    private function createColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);

        return $table;
    }

    private function createIndexes(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'BAP_ISSUE_TYPE_NAME_UNIQUE_INDEX');

        return $table;
    }
}