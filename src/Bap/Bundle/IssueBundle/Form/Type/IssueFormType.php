<?php

namespace Bap\Bundle\IssueBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Oro\Bundle\TranslationBundle\Translation\Translator;

use Bap\Bundle\IssueBundle\Entity\Issue as IssueEntity;
use Bap\Bundle\IssueBundle\Entity\IssueType as Type;
use Bap\Bundle\IssueBundle\Entity\IssueResolution as Resolution;

/**
 * Class IssueType
 * @package Bap\Bundle\IssueBundle\Form\Type
 */
class IssueFormType extends AbstractType
{
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            $this->getPreSetDataCallback()
        );
        $builder
            ->add('priority', 'entity', [
                'class' => 'Bap\Bundle\IssueBundle\Entity\IssuePriority',
                'property' => 'name',
            ])
            ->add('code', 'text', ['required' => true,])
            ->add('summary', 'text', ['required' => true,])
            ->add('description', 'textarea')
            ->add('reporter', 'oro_user_select', ['required' => true])
            ->add('tags', 'oro_tag_select', ['label' => 'oro.tag.entity_plural_label'])
            ->add('assignee', 'oro_user_select');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Bap\Bundle\IssueBundle\Entity\Issue',
                'intention'  => 'issue',
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'academic_bts_issue';
    }

    /**
     * @param $key
     * @return string
     */
    private function translate($key)
    {
        return $this->translator->trans($key);
    }

    private function getIssueStatusTypes()
    {
        return [
            IssueEntity::STATUS_OPEN,
            IssueEntity::STATUS_REOPENED,
            IssueEntity::STATUS_IN_PROGRESS
        ];
    }

    private function getChoises()
    {
        return [
            Type::STORY_TYPE => $this->translate('bap.issue.type.story'),
            Type::TASK_TYPE  => $this->translate('bap.issue.type.task'),
            Type::BUG_TYPE   => $this->translate('bap.issue.type.bug'),
        ];
    }

    private function getChoiceConfig()
    {
        return [
            'required' => true,
            'choices'  => $this->getChoises(),
        ];
    }

    private function getResolutionConfig()
    {
        return [
            'resolution',
            'entity',
            [
                'class'    => 'Bap\Bundle\IssueBundle\Entity\IssueResolution',
                'property' => 'title',
                'required' => false,
            ]
        ];
    }

    private function getPreSetDataCallback(FormEvent $event)
    {
        return function () use ($event) {

            $form = $event->getForm();

            /** @var IssueEntity $issue */
            $issueId       = $issue->getId();
            $issue         = $event->getData();
            $issueParent   = $issue->getParent();
            $issueType     = (string)$issue->getType();
            $issueStatus   = $issue->getWorkflowStep()->getName();
            $configForm    = null;

            if (is_null($issueParent) &&  $issueType !== Type::SUB_TASK_TYPE) {
                $form->add(
                    'type',
                    'choice',
                    $this->getChoiceConfig()
                );
            }

            if (!is_null($issueId) && !in_array($issueStatus, $this->getResolutionConfig())) {
                $form->add(
                    'resolution',
                    'entity',
                    $this->getResolutionConfig()
                );
            }

            return $this->getIssueFormBuilder($form);
        };
    }

    private function getIssueFormBuilder (FormBuilderInterface $builder)
    {
        $builder
            ->add('priority', 'entity', [
                'class' => 'Academic\BtsBundle\Entity\Priority',
                'property' => 'title',
            ])
            ->add('code', 'text', ['required' => true,])
            ->add('summary', 'text', ['required' => true,])
            ->add('description', 'textarea')
            ->add('reporter', 'oro_user_select', ['required' => true])
            ->add('tags', 'oro_tag_select', ['label' => 'oro.tag.entity_plural_label'])
            ->add('assignee', 'oro_user_select');

        return $builder;
    }
}
