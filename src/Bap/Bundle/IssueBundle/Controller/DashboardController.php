<?php

namespace Bap\Bundle\IssueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DashboardController
 * @package Bap\Bundle\IssueBundle\Controller
 *
 * @Route("/dashboard")
 */
class DashboardController extends Controller
{
    /**
     * @Route(
     *      "/issue_chart/{widget}",
     *      name="main_issue_chart",
     *      requirements={"widget"="[\w-]+"}
     * )
     *
     * @Template("BapIssueBundle:Dashboard:issueChart.html.twig")
     *
     * @param string $widget
     * @return array
     */
    public function issueChartAction($widget)
    {
        $issues = $this
            ->get('doctrine')
            ->getRepository('BapIssueBundle:Issue')
            ->getIssuesByStatus();

        $widgetAttr = $this
            ->get('oro_dashboard.widget_configs')
            ->getWidgetAttributesForTwig($widget);

        $widgetAttr['chartView'] = $this
            ->get('oro_chart.view_builder')
            ->setArrayData($issues)
            ->setOptions(
                [
                    'name' => 'bar_chart',
                    'data_schema' => [
                        'label' => ['field_name' => 'label'],
                        'value' => [
                            'field_name' => 'count',
                            'type'       => 'integer',
                        ]
                    ],
                    'settings' => ['xNoTicks' => 0],
                ]
            )
            ->getView();

        return $widgetAttr;
    }

    /**
     * @Route(
     *      "/_issues/{widget}",
     *      name="bap_user_issues_board",
     *      requirements={"widget"="[\w-]+"}
     * )
     * @Template("BapIssueBundle:Dashboard:myIssues.html.twig")
     *
     * @param string $widget
     * @return array
     */
    public function myIssuesAction($widget)
    {
        $widgetAttr = array_merge(
            $this
                ->get('oro_dashboard.widget_configs')
                ->getWidgetAttributesForTwig($widget),
            [
                'user' => $this->getUser()
            ]
        );

        return $widgetAttr;
    }
}
