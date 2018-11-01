<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
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
            ->add('type')
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
                'choices' => [
                    'Top X' => 'top',
                    'Content' => 'content',
                    'Video' => 'video',
                ],
                'map' => [
                    'top' => ['autoscroll', 'count', 'scoreboard'],
                    'content' => ['autoscroll', 'content'],
                    'video' => ['video'],
                ],
                'placeholder' => 'Choose an option',
                'required' => true
            ]);

        $formMapper
            ->add('name')
            ->add('showtitle')
            ->add('count')
            ->add('autoscroll')
            ->add('content')
            ->add('scoreboard', ModelType::class, [
                'required' => false,
                'btn_add' => 'Create a new slide',
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
