<?php
/**
 * User: ezi
 * Date: 1/5/15
 * Time: 2:21 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Schema;

use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtension;
use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareInterface;
use Oro\Bundle\NoteBundle\Migration\Extension\NoteExtension;
use Oro\Bundle\NoteBundle\Migration\Extension\NoteExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Migrations\Schema\v1_0\BapIssueBundle as BapIssueBundleMigration;

/**
 * Class BapIssueBundleInstaller
 * 
 * @package Bap\Bundle\IssueBundle\Migrations\Schema
 */
class BapIssueBundleInstaller implements Installation, NoteExtensionAwareInterface, ActivityExtensionAwareInterface
{
    /**
     * Previous migrations version
     */
    const ISSUE_MIGRATION_VERSION = 'v0_0';

    /**
     * @var NoteExtension
     */
    protected $noteExtension;

    /**
     * @var ActivityExtension
     */
    protected $activityExtension;

    /**
     * Sets the ActivityExtension
     *
     * @param ActivityExtension $activityExtension
     */
    public function setActivityExtension(ActivityExtension $activityExtension)
    {
        $this->activityExtension = $activityExtension;
    }

    /**
     * Sets the NoteExtension
     *
     * @param NoteExtension $noteExtension
     */
    public function setNoteExtension(NoteExtension $noteExtension)
    {
        $this->noteExtension = $noteExtension;
    }

    /**
     * Gets a number of the last migration version implemented by this installation script
     *
     * @return string
     */
    public function getMigrationVersion()
    {
        return self::ISSUE_MIGRATION_VERSION;
    }

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
        $migration = new BapIssueBundleMigration();

        $migration->up($schema, $queries);
    }
}