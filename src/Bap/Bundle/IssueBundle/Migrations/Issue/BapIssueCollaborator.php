<?php
/**
 * Created by PhpStorm.
 * User: ezi
 * Date: 1/20/15
 * Time: 7:48 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Table;

use Bap\Bundle\IssueBundle\Entity\Issue;

/**
 * Class BapIssueCollaborator
 *
 * @package Ezi\Bundle\IssueBundle\Migrations\Issue
 */
class BapIssueCollaborator extends AbstractMigration
{
    /**
     * @return mixed
     */
    public function getTableName()
    {
        return Issue::COLLABORATOR_TABLE_NAME;
    }

    /**
     * @return Table
     */
    public function addIndexKeys()
    {
        $table = $this->getTargetTable();

        $table->addIndex(['issue_id'], 'BAP_ISSUE_COLLABORATOR_ISSUE_ID_INDEX');
        $table->addIndex(['user_id'], 'BAP_ISSUE_COLLABORATOR_USER_ID_INDEX');

        return $table;
    }

    /**
     * @return Table
     */
    public function addColumns()
    {
        $table = $this->getTargetTable();

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('issue_id', 'integer');
        $table->addColumn('user_id', 'integer');

        $table->setPrimaryKey(['id']);

        return $table;
    }

    /**
     * @return Table
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
    public function addForeignKeys()
    {
        $table = $this->getTargetTable();

        $table->addForeignKeyConstraint(
            $this->getSchema()->getTable('bap_issue'),
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