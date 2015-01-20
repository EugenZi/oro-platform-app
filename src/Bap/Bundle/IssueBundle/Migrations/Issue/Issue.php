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

use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssueType;
use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssuePriority;
use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssueResolution;

class BapIssue implements Migration
{
    const TABLE_NAME  = 'bap_issue';
    const PRIMARY_KEY = 'id';

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
        ['summary',           'string',   ['notnull' => false, 'length' => 255] ],
        ['code',              'string',   ['notnull' => true,  'length' => 32]  ],
        ['description',       'string',   ['notnull' => false, 'length' => 255] ],
        ['type_id',           'string',   ['notnull' => true,  'length' => 32]  ],
        ['priority_id',       'string',   ['notnull' => true,  'length' => 32]  ],
        ['resolution_id',     'string',   ['notnull' => true,  'length' => 32]  ],
        ['status',            'string',   ['notnull' => true,  'length' => 32]  ],
        ['tags',              'string',   ['notnull' => true,  'length' => 32]  ],
        ['reporter_id',       'integer',  ['notnull' => true,  'length' => 32]  ],
        ['assignee_id',       'integer',  ['notnull' => true,  'length' => 32]  ],
        ['related',           'string',   ['notnull' => true,  'length' => 32]  ],
        ['collaborators',     'string',   ['notnull' => true,  'length' => 32]  ],
        ['issue_parent_id',   'integer',  ['notnull' => true,  'length' => 32]  ],
        ['issue_children_id', 'integer',  ['notnull' => true,  'length' => 32]  ],
        ['workflow_item_id',  'integer',  ['notnull' => true,  'length' => 32]  ],
        ['workflow_step_id',  'integer',  ['notnull' => true,  'length' => 32]  ],
        ['notes',             'string',   ['notnull' => true,  'length' => 32]  ],
        ['created_at',        'datetime'                                        ],
        ['updated_at',        'datetime', ['notnull' => true]                   ],
    ];

    private $issueTableIndexes = [
        [['summary'],           "EZI_ISSUE_SUMMARY_IDX",           []],
        [['code'],              "EZI_ISSUE_CODE_IDX",              []],
        [['descripton'],        "EZI_ISSUE_DESCRIPTION_IDX",       []],
        [['reporter_id'],       "EZI_ISSUE_STATUS_IDX",            []],
        [['assignee_id'],       "EZI_ISSUE_ASSIGNEE_ID_IDX",       []],
        [['assignee_id'],       "EZI_ISSUE_RELATED_ISSUES_ID_IDX", []],
        [['related_issues_id'], "EZI_ISSUE_RELATED_ISSUES_ID_IDX", []],
        [['collaborators'],     "EZI_ISSUE_COLLABORATORS_ID_IDX",  []],
        [['parent_id'],         "EZI_ISSUE_ISSUE_PARENT_ID_IDX",   []],
        [['child_id'],          "EZI_ISSUE_CHILDREN_ID_IDX",       []],
        [['workflow_step_id'],  "EZI_ISSUE_WORKFLOW_STEP_ID_IDX",  []],
        [['notes'],             "EZI_ISSUE_NOTES_IDX",             []]
    ];

    private $issueForeignKeys = [
        [
            BapIssueType::TABLE_NAME,
            ['type_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            BapIssuePriority::TABLE_NAME,
            ['priority_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        ],
        [
            BapIssueResolution::TABLE_NAME,
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

    protected function setup()
    {
        $this->dropTableIfExists($this->schema);
        $this->createDictionaryTables($this->schema, $this->queries);

        $this->addIssueForeignKeys(
            $this->addIssueIndexes(
                $this->addTableStructure(
                    $this->schema->createTable(self::TABLE_NAME)
                )
            )
        );

    }

    private function dropTableIfExists(Schema $schema)
    {
        if ($schema->hasTable(self::TABLE_NAME)) {
            $schema->dropTable(self::TABLE_NAME);
        }
    }

    private function createDictionaryTables()
    {
        (new BapIssueType())->up($this->schema, $this->queries);
        (new BapIssuePriority())->up($this->schema, $this->queries);
        (new BapIssueResolution())->up($this->schema, $this->queries);
    }

    private function addTableStructure(Table $table)
    {
        return $this->invokeTableMethod($table, 'addColumn', $this->issueTableColumns);
    }

    private function addIssueIndexes(Table $table)
    {
        return $this->invokeTableMethod($table, 'addIndex', $this->issueTableIndexes);
    }

    private function addIssueForeignKeys(Table $table)
    {
        $schema   = $this->schema;
        $callback = function(array $args) use ($schema) {
            $args[0] = $schema->getTable($args[0]);

            return $args;
        };

        return $this->invokeTableMethod($table, 'addForeignKeyConstraint', $this->issueForeignKeys, $callback);
    }

    private function invokeTableMethod(Table $table, $method, array $argsArray, \Closure $redefineArgs = null)
    {
        $method = new \ReflectionMethod($table, $method);

        foreach($argsArray as $args) {

            if (!is_null($redefineArgs)) {
                $args = $redefineArgs($args);
            }

            $method->invokeArgs($table, $args);
        }

        return $table;
    }
}