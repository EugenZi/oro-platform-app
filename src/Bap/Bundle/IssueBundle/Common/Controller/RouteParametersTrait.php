<?php
/**
 * User: ezi
 * Date: 2/5/15
 * Time: 1:33 PM
 */

namespace Bap\Bundle\IssueBundle\Common\Controller;


trait RouteParametersTrait
{
    /**
     * @param string $status
     * @param string $message
     */
    private function setFlashMessage($status = 'success', $message = '')
    {
        $this
            ->get('session')
            ->getFlashBag()
            ->add(
                'success',
                $message
            );
    }

    /**
     * @param mixed $entity
     * @param string $routeName
     * @return array
     */
    private function getRouteParams($routeName, $entity = null)
    {
        $returnData = [
            'route' => (string)$routeName
        ];

        if (is_object($entity) && method_exists($entity, 'getId')) {
            $returnData = [
                'parameters' => [
                    'id' => $entity->getId()
                ]
            ];
        }

        return $returnData;
    }
}