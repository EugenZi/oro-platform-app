<?php
/**
 * User: ezi
 * Date: 1/5/15
 * Time: 5:04 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;
use Bap\Bundle\IssueBundle\Entity\Issue;
use Bap\Bundle\IssueBundle\Entity\IssueType;
use Bap\Bundle\IssueBundle\Entity\IssuePriority;
use Bap\Bundle\IssueBundle\Entity\IssueResolution;

/**
 * Class BapIssue
 * @package Bap\Bundle\IssueBundle\Migrations\Issue
 */
class BapIssue extends AbstractMigration
{
    /**
     * @var Schema
     */
    private $schema;

    /**
     * @var QueryBag
     */
    private $queries;

    /**
     * Column array that provides in schema builder
     *
     * @var array
     */
    private $issueTableColumns = [
        ['id',                'integer',  ['autoincrement' => true]             ],
        ['type_id',           'integer',  ],
        ['owner_id',          'integer',  ['notnull' => false]],
        ['priority_id',       'integer',  ],
        ['resolution_id',     'integer',  ],
        ['reporter_id',       'integer',  ],
        ['assignee_id',       'integer',  ],
        ['issue_parent_id',   'integer',  ],
        ['workflow_item_id',  'integer',  ],
        ['workflow_step_id',  'integer',  ],
        ['summary',           'string',   ['notnull' => false, 'length' => 255] ],
        ['code',              'string',   ['length' => 32]],
        ['description',       'string',   ['notnull' => false, 'length' => 255] ],
        ['status',            'string',   ['length' => 32]],
        ['tags',              'string',   ['length' => 32]],
        ['related',           'string',   ['length' => 32]],
        ['collaborators',     'string',   ['length' => 32]],
        ['notes',             'string',   ['length' => 32]],
        ['created_at',        'datetime'                                        ],
        ['updated_at',        'datetime'  ],
    ];

    /**
     * Array of indexes that adding to table fields
     *
     * @var array
     */
    private $issueTableIndexes = [
        [['summary'],           "BAP_ISSUE_SUMMARY_IDX",           []],
        [['code'],              "BAP_ISSUE_CODE_IDX",              []],
        [['description'],       "BAP_ISSUE_DESCRIPTION_IDX",       []],
        [['reporter_id'],       "BAP_ISSUE_STATUS_IDX",            []],
        [['assignee_id'],       "BAP_ISSUE_ASSIGNEE_ID_IDX",       []],
        [['assignee_id'],       "BAP_ISSUE_RELATED_ISSUES_ID_IDX", []],
        [['related_issues_id'], "BAP_ISSUE_RELATED_ISSUES_ID_IDX", []],
        [['collaborators'],     "BAP_ISSUE_COLLABORATORS_ID_IDX",  []],
        [['parent_id'],         "BAP_ISSUE_ISSUE_PARENT_ID_IDX",   []],
        [['child_id'],          "BAP_ISSUE_CHILDREN_ID_IDX",       []],
        [['workflow_step_id'],  "BAP_ISSUE_WORKFLOW_STEP_ID_IDX",  []],
        [['notes'],             "BAP_ISSUE_NOTES_IDX",             []]
    ];

    /**
     * Array of issue table foreign keys
     *
     * @var array
     */
    private $issueForeignKeys = [
        [
            IssueType::TABLE_NAME,
            ['type_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            IssuePriority::TABLE_NAME,
            ['priority_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            IssueResolution::TABLE_NAME,
            ['resolution_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            'oro_user',
            ['owner_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            'orocrm_account',
            ['related_account_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            'orocrm_contact',
            ['related_contact_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            'oro_user',
            ['reporter_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            'oro_workflow_item',
            ['workflow_item_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            'oro_workflow_step',
            ['workflow_step_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ]
    ];

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
        $this->schema  = $schema;
        $this->queries = $queries;

        $this->setup($schema, $queries);
    }

    /**
     * @return string
     */
    protected function getTableName()
    {
        return Issue::TABLE_NAME;
    }

    /**
     * Method that create tables related to issue
     */
    protected function createRelationTables()
    {
        $issueType       = new IssueType();
        $issuePriority   = new IssuePriority();
        $issueResolution = new IssueResolution();

        $issueType->setup();
        $issuePriority->setup();
        $issueResolution->setup();
    }

    /**
     * @param Table $table
     * @return Table
     */
    protected function addColumns(Table $table)
    {
        return $this->invokeTableMethod($table, 'addColumn', $this->issueTableColumns);
    }

    /**
     * @param Table $table
     * @return Table
     */
    protected function addIndexKeys(Table $table)
    {
        return $this->invokeTableMethod($table, 'addIndex', $this->issueTableIndexes);
    }

    /**
     * @param Table $table
     * @return Table
     */
    protected function addForeignKeys(Table $table)
    {
        $schema   = $this->schema;

        $callback = function (array $args) use ($schema) {

            $args[0] = $schema->getTable($args[0]);

            return $args;
        };

        return $this->invokeTableMethod($table, 'addForeignKeyConstraint', $this->issueForeignKeys, $callback);
    }

    /**
     * @param Table $table
     * @param $method
     * @param array $argsArray
     * @param callable $redefineArgs
     * @return Table
     */
    private function invokeTableMethod(Table $table, $method, array $argsArray, \Closure $redefineArgs = null)
    {
        $method = new \ReflectionMethod($table, $method);

        foreach ($argsArray as $args) {

            if (!is_null($redefineArgs)) {
                $args = $redefineArgs($args);
            }

            $method->invokeArgs($table, $args);
        }

        return $table;
    }
}