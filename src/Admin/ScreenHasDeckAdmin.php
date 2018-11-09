<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

final class ScreenHasDeckAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
			->add('id')
			->add('position')
			->add('enable')
			;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
			->add('position')
			->add('enable')
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
            // ->add('slide', ModelListType::class, ['required' => false])
            ->add('deck', ModelType::class, [
                'required' => false,
                'btn_add' => 'Create a new deck',
            ])
            ->add('enable', null, ['required' => false])
            ->add('position', HiddenType::class)
			;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
			->add('id')
			->add('position')
			->add('enable')
			;
    }
}
