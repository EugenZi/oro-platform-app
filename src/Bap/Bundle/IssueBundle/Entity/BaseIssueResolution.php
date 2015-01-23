<?php

namespace Bap\Bundle\IssueBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bap\Bundle\IssueBundle\Entity\BapIssueResolution
 *
 * @ORM\Entity(repositoryClass="Entity\Repository\IssueResolutionRepository")
 * @ORM\Table(
 *      name="bap_issue_resolution",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="value_UNIQUE",
 *              columns={"`value`"}
 *          )
 *      }
 * )
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"base"="BaseIssueResolution", "extended"="IssueResolution"})
 */
abstract class BaseIssueResolution
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="`value`", type="string", length=45)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Issue", mappedBy="issueResolution")
     * @ORM\JoinColumn(name="`value`", referencedColumnName="resolution")
     */
    protected $issues;
}