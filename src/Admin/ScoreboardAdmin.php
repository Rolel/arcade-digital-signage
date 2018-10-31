<?php

namespace App\Admin;

use App\Entity\Game;
use App\Entity\Scoreboard;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

final class ScoreboardAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
			->add('id')
            ->add('game')
            ->add('name')
			->add('type')
            ->add('description')
			;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('game')
            ->addIdentifier('name')
            ->add('type', 'choice', [
                'editable' => true,
                'choices' => Scoreboard::TYPES,
            ])
			->add('description')
			->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ])
            ->add('id')
        ;
    }

    protected function configureFormFields(FormMapper $formMapper)
    {

        // define group zoning
        $formMapper
            ->with('Settings', ['class' => 'col-md-6'])->end()
            ->with('Infos', ['class' => 'col-md-6'])->end()
            ->with('Scores', ['class' => 'col-md-12'])->end()
        ;


        $formMapper
            ->with('Infos')
            ->add('name')
            ->add('description')
            ->end();

        $formMapper
            ->with('Settings')
            ->add('game', ModelListType::class, [
                'required' => true,
                'btn_add' => false,
                'btn_edit' => false,
                'btn_list' => 'Select a game',
                'btn_delete' => false
            ])
            ->add('type', ChoiceType::class, [
                'choices' => array_flip(Scoreboard::TYPES)
            ])
            ->end();

        $formMapper
            ->with('Scores')
            ->add(
                'scores',
                CollectionType::class,
                [
                    'by_reference' => true,
                    'btn_add' => 'Add a new score to the board',
                ],
                [
                    'edit' => 'inline',
                    'inline' => 'table',
                ]
            )
            ->end();

    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
			->add('id')
			->add('name')
			->add('description')
			->add('type')
			;
    }
}
