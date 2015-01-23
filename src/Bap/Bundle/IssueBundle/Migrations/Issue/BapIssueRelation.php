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
use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;

class BapIssueRelation extends AbstractMigration
{
    protected function addColumns(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addIndex(['issue_id'], 'BAP_ISSUE_RELATION_ISSUE_ID_INDEX');
        $table->addIndex(['related_issue_id'], 'BAP_ISSUE_RELATION_RELATED_ISSUE_ID_INDEX');

        return $table;
    }

    protected function addIndexKeys(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('issue_id', 'integer');
        $table->addColumn('related_issue_id', 'integer');

        return $table;
    }

    protected function addForeignKeys(Schema $schema, Table $table)
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