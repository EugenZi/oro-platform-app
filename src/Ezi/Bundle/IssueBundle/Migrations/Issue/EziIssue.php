<?php
/**
 * User: ezi
 * Date: 1/5/15
 * Time: 5:04 PM
 */

namespace Ezi\Bundle\IssueBundle\Migrations\Schema\v1_0;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Ezi\Bundle\IssueBundle\Migrations\Issue\EziIssueType;
use Ezi\Bundle\IssueBundle\Migrations\Issue\EziIssuePriority;
use Ezi\Bundle\IssueBundle\Migrations\Issue\EziIssueResolution;

class EziIssue implements Migration
{
    const TABLE_NAME = 'ezi_issue';

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
        $this->setup($schema, $queries);
    }

    protected function setup(Schema $schema, QueryBag $queries)
    {
        if ($schema->hasTable(self::TABLE_NAME)) {
            $schema->dropTable(self::TABLE_NAME);
        }

        $table = $this->addIssueColumns(
            $schema->createTable(self::TABLE_NAME)
        );

        $this->createDictionaryTables($schema, $queries);

    }

    protected function createDictionaryTables(Schema $schema, QueryBag $queries)
    {
        (new EziIssueType())->up($schema, $queries);
        (new EziIssuePriority())->up($schema, $queries);
        (new EziIssueResolution())->up($schema, $queries);
    }

    protected function addIssueColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('summary', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('code', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('description', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('type', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('priority', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('resolution', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('status', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('tags', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('reporter_id', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('assignee_id', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('related', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('collaborators', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('issue_parent_id', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('issue_children_id', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('notes', 'string', ['notnull' => true, 'length' => 32]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime', ['notnull' => true]);

        return $table;
    }

    protected function addIssueIndexes(Table $table)
    {
        return $table;
    }

    protected function addIssueForeighns(Table $table)
    {
        return $table;
    }
}