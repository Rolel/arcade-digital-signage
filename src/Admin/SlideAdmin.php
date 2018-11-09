<?php

namespace App\Admin;

use App\Entity\Slide;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class SlideAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->addIdentifier('name')
            ->add('type', 'choice', ['editable' => true, 'choices'  => Slide::TYPES])
            ->add('glow', 'boolean', ['editable' => true,
                'expanded' => true,
                'multiple' => false])
            ->add('style', 'choice', ['editable' => true, 'choices'  => Slide::STYLES])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('type', ChoiceFieldMaskType::class, [
                'choices' => array_flip(Slide::TYPES),
                'map' => [
                    'top' => ['autoscroll', 'count', 'direction', 'scoreboard'],
                    'topbytype' => ['autoscroll', 'count', 'direction', 'gametype'],
                    'content' => ['autoscroll', 'content'],
                    'video' => ['video'],
                ],
                'placeholder' => 'Choose an option',
                'required' => true
            ]);

        $formMapper
            ->add('name')
            ->add('showtitle')
            ->add('glow', 'choice', ['editable' => true])
            ->add('style', ChoiceType::class, [
                'choices'  => array_flip(Slide::STYLES),
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('count')
            ->add('direction', ChoiceType::class, [
                'choices'  => [
                    'Biggest first (desc)' => 'DESC',
                    'Smallest first (asc)' => 'ASC',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('autoscroll')
            ->add('content')
            ->add('scoreboard', ModelType::class, [
                'required' => false,
                'btn_add' => false,
            ])
            ->add('gametype', ModelType::class, [
                'required' => false,
                'btn_add' => false,
            ])
            ->add('video', TextType::class, ['required' => false])
            ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('type');
    }
}
