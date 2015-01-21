<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/20/15
 * Time: 7:48 PM
 */

namespace Ezi\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Entity\IssueCollaborator;

class BapIssueCollaborator implements Migration
{
    const TABLE_NAME = 'bap_issues_collaborator';

    public function up(Schema $schema, QueryBag $queryBag)
    {
        if ($schema->hasTable(IssueCollaborator::TABLE_NAME)) {
            $schema->dropTable(IssueCollaborator::TABLE_NAME);
        }

        $this->createForeighnKeys(
            $schema,
            $this->createIndexes(
                $this->createColumns(
                    $schema->createTable(IssueCollaborator::TABLE_NAME)
                )
            )
        );
    }

    private function createIndexes(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addIndex(['issue_id'], 'BAP_ISSUE_COLLABORATOR_ISSUE_ID_INDEX');
        $table->addIndex(['user_id'], 'BAP_ISSUE_COLLABORATOR_USER_ID_INDEX');

        return $table;
    }

    private function createColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('issue_id', 'integer');
        $table->addColumn('user_id', 'integer');

        return $table;
    }

    private function createForeighnKeys(Schema $schema, Table $table)
    {
        $table->addForeignKeyConstraint(
            $schema->getTable('bts_issue'),
            ['issue_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['user_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        return $table;
    }
}