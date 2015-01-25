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

use Bap\Bundle\IssueBundle\Entity\IssueRelation;
use Bap\Bundle\IssueBundle\Migrations\AbstractMigration;

class BapIssueRelation extends AbstractMigration
{
    /**
     * @return string
     */
    public function getTableName()
    {
        return IssueRelation::TABLE_NAME;
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addColumns(Table $table)
    {
        $table->setPrimaryKey(['id']);
        $table->addIndex(['issue_id'], 'BAP_ISSUE_RELATION_ISSUE_ID_INDEX');
        $table->addIndex(['related_issue_id'], 'BAP_ISSUE_RELATION_RELATED_ISSUE_ID_INDEX');

        return $table;
    }

    /**
     * @param Table $table
     * @return Table
     */
    public function addIndexKeys(Table $table)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('issue_id', 'integer');
        $table->addColumn('related_issue_id', 'integer');

        return $table;
    }

    /**
     * @param Table $table
     * @return Table
     * @throws \Doctrine\DBAL\Schema\SchemaException
     */
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
            ['related_issue_id'],
            ['id'],
            ['onDelete' => 'CASCADE']
        );

        return $table;
    }
}