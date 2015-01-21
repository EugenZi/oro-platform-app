<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/20/15
 * Time: 7:48 PM
 */

namespace Bts\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssueRelation;

class BapIssueRelation implements Migration
{
    const TABLE_NAME = 'bap_issue_relation';

    public function up(Schema $schema, QueryBag $queryBag)
    {
        if ($schema->hasTable(IssueRelation::TABLE_NAME)) {
            $schema->dropTable(IssueRelation::TABLE_NAME);
        }

        $this->createForeignKeys(
            $schema,
            $this->createIndexes(
                $this->createColumns(
                    $schema->createTable(IssueRelation::TABLE_NAME)
                )
            )
        );
    }

    private function createColumns(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addIndex(['issue_id'], 'BAP_ISSUE_RELATION_ISSUE_ID_INDEX');
        $table->addIndex(['related_issue_id'], 'BAP_ISSUE_RELATION_RELATED_ISSUE_ID_INDEX');

        return $table;
    }

    private function createIndexes(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('issue_id', 'integer');
        $table->addColumn('related_issue_id', 'integer');

        return $table;
    }

    private function createForeignKeys(Schema $schema, Table $table)
    {
        $table->addForeignKeyConstraint(
            $schema->getTable('bts_issue'),
            ['issue_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['related_issue_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        return $table;
    }

}