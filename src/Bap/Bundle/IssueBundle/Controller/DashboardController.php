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
     * @param string $widget
     *
     * @Route(
     *      "/issue_chart/{widget}",
     *      name="bts_dashboard_issue_chart",
     *      requirements={"widget"="[\w-]+"}
     * )
     * @Template("AcademicBtsBundle:Dashboard:issueChart.html.twig")
     *
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
                            'type' => 'integer',
                        ]
                    ],
                    'settings' => ['xNoTicks' => 5],
                ]
            )
            ->getView();

        return $widgetAttr;
    }

    /**
     * @param string $widget
     *
     * @Route(
     *      "/my_issues/{widget}",
     *      name="bts_dashboard_my_issues",
     *      requirements={"widget"="[\w-]+"}
     * )
     * @Template("AcademicBtsBundle:Dashboard:myIssues.html.twig")
     *
     * @return array
     */
    public function myIssuesAction($widget)
    {
        $widgetAttr = array_merge(
            $this->get('oro_dashboard.widget_configs')->getWidgetAttributesForTwig($widget),
            ['user' => $this->getUser()]
        );

        return $widgetAttr;
    }
}
