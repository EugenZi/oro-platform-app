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

use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;
use Bap\Bundle\IssueBundle\Entity\IssueCollaborator;

class BapIssueCollaborator extends AbstractMigration
{
    public function getTableName()
    {
        return IssueCollaborator::TABLE_NAME;
    }

    public function addIndexKeys(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addIndex(['issue_id'], 'BAP_ISSUE_COLLABORATOR_ISSUE_ID_INDEX');
        $table->addIndex(['user_id'], 'BAP_ISSUE_COLLABORATOR_USER_ID_INDEX');

        return $table;
    }

    public function addColumns(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('issue_id', 'integer');
        $table->addColumn('user_id', 'integer');

        return $table;
    }

    public function addForeignKeys(Table $table)
    {
        $table->addForeignKeyConstraint(
            $this->getSchema()->getTable('bts_issue'),
            ['issue_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        $table->addForeignKeyConstraint(
            $this->getSchema()->getTable('oro_user'),
            ['user_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        return $table;
    }
}