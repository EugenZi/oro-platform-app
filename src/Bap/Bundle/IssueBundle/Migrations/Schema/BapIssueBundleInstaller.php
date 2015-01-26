<?php
/**
 * User: ezi
 * Date: 1/5/15
 * Time: 2:21 PM
 */

namespace Bap\Bundle\IssueBundle\Migrations\Schema;

use Bap\Bundle\IssueBundle\Entity\Issue;
use Doctrine\DBAL\Schema\Schema;

use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtension;
use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareInterface;
use Oro\Bundle\NoteBundle\Migration\Extension\NoteExtension;
use Oro\Bundle\NoteBundle\Migration\Extension\NoteExtensionAwareInterface;
use Oro\Bundle\MigrationBundle\Migration\Installation;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssue;
use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssueType;
use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssueResolution;
use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssuePriority;
use Bap\Bundle\IssueBundle\Migrations\Issue\BapIssueCollaborator;

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
    const ISSUE_MIGRATION_VERSION = 'v1_0';

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
        (new BapIssueType($schema))->setup();
        (new BapIssuePriority($schema))->setup();
        (new BapIssueResolution($schema))->setup();
        (new BapIssue($schema))->setup();
        (new BapIssueCollaborator($schema))->setup();

        $this->noteExtension
             ->addNoteAssociation(
                 $schema,
                 Issue::TABLE_NAME
             );

        $this->activityExtension
             ->addActivityAssociation(
                 $schema,
                 'oro_email',
                 Issue::TABLE_NAME,
                 true
             );

        $this->activityExtension
             ->addActivityAssociation(
                 $schema,
                 'oro_calendar_event',
                 Issue::TABLE_NAME
             );
    }
}
