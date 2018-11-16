<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;

final class ScreenAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('description');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                    'viewfront' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        // define group zoning
        $formMapper
            ->with('Decks', ['class' => 'col-md-9'])->end()
            ->with('Infos', ['class' => 'col-md-3'])->end();

        $formMapper
            ->with('Infos')
                ->add('name')
                ->add('description')
            ->end()
            ->with('Decks')
                ->add(
                    'screenHasDecks',
                    CollectionType::class,
                    [
                        'by_reference' => false,
                        'btn_add' => 'Add a new deck to the screen',
                    ],
                    [
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                    ]
                )
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('description');
    }
}
