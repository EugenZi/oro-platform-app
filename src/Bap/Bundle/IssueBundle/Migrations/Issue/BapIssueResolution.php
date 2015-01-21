<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/5/15
 * Time: 5:03 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssueResolution;

class BapIssueResolution implements Migration
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
        if ($schema->hasTable(IssueResolution::TABLE_NAME)) {
            $schema->dropTable(IssueResolution::TABLE_NAME);
        }

        $table = $schema->createTable(IssueResolution::TABLE_NAME);

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 32]);

        $table->setPrimaryKey(['id']);
        $table->addUniqueIndex(['name'], 'BAP_ISSUE_RESOLUTION_NAME_UNIQUE_INDEX');
    }
}