<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:01 PM
 */

namespace Ezi\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

class EziIssueType implements Migration
{
    const TABLE_NAME = 'ezi_issue_type';

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
        $table->addColumn('type', 'string', ['notnull' => true, 'length' => 32]);

        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['type'], 'ISSUE_TYPE_UNIQ_IDX');

        $this->createRelations($schema);
    }
}