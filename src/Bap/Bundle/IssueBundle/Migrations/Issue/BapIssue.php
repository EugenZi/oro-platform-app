<?php
/**
 * User: ezi
 * Date: 1/5/15
 * Time: 5:04 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Issue;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

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
     * @return string
     */
    public function getTableName()
    {
        return Issue::TABLE_NAME;
    }

    /**
     * @return Table
     */
    public function addColumns()
    {
        $table = $this->getTargetTable();

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('parent_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('reporter_id', 'integer', ['notnull' => false]);
        $table->addColumn('assignee_id', 'integer', ['notnull' => false]);
        $table->addColumn('collaborator_id', 'integer', ['notnull' => false]);
        $table->addColumn('workflow_item_id', 'integer', ['notnull' => false]);
        $table->addColumn('workflow_step_id', 'integer', ['notnull' => false]);
        $table->addColumn('type_id', 'integer', ['notnull' => false]);
        $table->addColumn('priority_id', 'integer', ['notnull' => false]);
        $table->addColumn('resolution_id', 'integer', ['notnull' => false]);
        $table->addColumn('summary', 'string', ['notnull' => false, 'length' => 255]);
        $table->addColumn('code', 'string', ['length' => 32]);
        $table->addColumn('description', 'string', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');

        $table->setPrimaryKey(['id']);

        return $table;
    }

    /**
     * @return Table
     */
    public function addIndexKeys()
    {
        $table = $this->getTargetTable();

        $table->addIndex(['parent_id'], "BAP_ISSUE_ISSUE_PARENT_ID_INDEX");
        $table->addIndex(['organization_id'], "BAP_ISSUE_ORGANIZATION_ID_INDEX");
        $table->addIndex(['owner_id'], "BAP_ISSUE_OWNER_ID_INDEX");
        $table->addIndex(['reporter_id'], "BAP_ISSUE_STATUS_INDEX");
        $table->addIndex(['assignee_id'], "BAP_ISSUE_ASSIGNEE_ID_INDEX");
        $table->addIndex(['collaborator_id'], "BAP_ISSUE_COLLABORATORS_ID_IDX");
        $table->addIndex(['workflow_item_id'], "BAP_ISSUE_WORKFLOW_ITEM_ID_INDEX");
        $table->addIndex(['workflow_step_id'], "BAP_ISSUE_WORKFLOW_STEP_ID_IDX");
        $table->addIndex(['type_id'], "BAP_ISSUE_TYPE_ID_INDEX");
        $table->addIndex(['priority_id'], "BAP_ISSUE_PRIORITY_ID_INDEX");
        $table->addIndex(['resolution_id'], "BAP_ISSUE_RESOLUTION_ID_INDEX");
        $table->addIndex(['summary'], "BAP_ISSUE_SUMMARY_IDX");
        $table->addIndex(['code'], "BAP_ISSUE_CODE_IDX");
        $table->addIndex(['description'], "BAP_ISSUE_DESCRIPTION_IDX");

        return $table;
    }

    /**
     * @return Table
     */
    public function addForeignKeys()
    {
        $table  = $this->getTargetTable();
        $schema = $this->getSchema();

        $table->addForeignKeyConstraint(
            $schema->getTable(Issue::TABLE_NAME),
            ['parent_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable(IssueType::TABLE_NAME),
            ['type_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable(IssuePriority::TABLE_NAME),
            ['priority_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable(IssueResolution::TABLE_NAME),
            ['resolution_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['owner_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['reporter_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_user'),
            ['assignee_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_organization'),
            ['organization_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_workflow_item'),
            ['workflow_item_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        $table->addForeignKeyConstraint(
            $schema->getTable('oro_workflow_step'),
            ['workflow_step_id'],
            ['id'],
            ['onDelete' => 'SET NULL']
        );

        return $table;
    }
}
