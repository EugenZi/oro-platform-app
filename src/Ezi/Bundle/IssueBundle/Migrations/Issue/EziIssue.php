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
     * Column array that provides in schema builder
     *
     * @var array
     */
    protected $issueTableFields = [
        ['id',                'integer',  ['autoincrement' => true]             ],
        ['summary',           'string',   ['notnull' => false, 'length' => 255] ],
        ['code',              'string',   ['notnull' => true,  'length' => 32]  ],
        ['description',       'string',   ['notnull' => false, 'length' => 255] ],
        ['type',              'string',   ['notnull' => true,  'length' => 32]  ],
        ['priority',          'string',   ['notnull' => true,  'length' => 32]  ],
        ['resolution',        'string',   ['notnull' => true,  'length' => 32]  ],
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

    protected $issueTableIndexes = [

    ];

    protected $issueForeignKeys = [

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
        $this->setup($schema, $queries);
    }

    protected function setup(Schema $schema, QueryBag $queries)
    {
        if ($schema->hasTable(self::TABLE_NAME)) {
            $schema->dropTable(self::TABLE_NAME);
        }

        $table = $this->createTableStructure(
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

    protected function createTableStructure(Table $table)
    {
        $method = new \ReflectionMethod($table, 'addColumn');

        foreach($this->issueTableFields as $args) {
            $method->invokeArgs($table, $args);
        }

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