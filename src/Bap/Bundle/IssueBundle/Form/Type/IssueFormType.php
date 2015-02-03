<?php

namespace Bap\Bundle\IssueBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Oro\Bundle\TranslationBundle\Translation\Translator;

use Bap\Bundle\IssueBundle\Entity\Issue;
use Bap\Bundle\IssueBundle\Entity\IssueType;
use Bap\Bundle\IssueBundle\Entity\IssueResolution;

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
        $builderClosure = $this->getPreSetDataCallback($builder);

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            $builderClosure
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
        return 'bap_issue';
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
            Issue::STATUS_OPEN,
            Issue::STATUS_REOPENED,
            Issue::STATUS_IN_PROGRESS
        ];
    }

    private function getChoises()
    {
        return [
            IssueType::STORY_TYPE => $this->translate('bap.issue.type.story'),
            IssueType::TASK_TYPE  => $this->translate('bap.issue.type.task'),
            IssueType::BUG_TYPE   => $this->translate('bap.issue.type.bug'),
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
                'property' => 'value',
                'required' => false,
            ]
        ];
    }

    private function getPreSetDataCallback(FormBuilderInterface $builder)
    {
        return function (FormEvent $event) use ($builder) {

            $form = $event->getForm();

            /** @var Issue $issue */
            $issueId          = $issue->getId();
            $issue            = $event->getData();
            $issueParent      = $issue->getParent();
            $issueType        = $issue->getType();
            $issueStatus      = $issue->getWorkflowStep()->getName();
            $resolutionConfig = $this->getResolutionConfig();
            $configForm       = null;

            if (is_null($issueParent) &&  IssueType::SUB_TASK_TYPE !== $issueType) {
                $form->add(
                    'type',
                    'choice',
                    $this->getChoiceConfig()
                );
            }

            if (!is_null($issueId) && !in_array($issueStatus, $resolutionConfig)) {
                $form->add(
                    'resolution',
                    'entity',
                    $this->getResolutionConfig()
                );
            }

            return $this->getIssueFormBuilder($builder);
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
