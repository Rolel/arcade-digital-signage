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

        // define group zoning
        $formMapper
            ->with('Type', ['class' => 'col-md-12'])->end()
            ->with('Infos', ['class' => 'col-md-6'])->end()
            ->with('Style', ['class' => 'col-md-6'])->end()
            ->with('Slide', ['class' => 'col-md-12'])->end()
        ;

        $formMapper
            ->with('Type')
            ->add('type', ChoiceFieldMaskType::class, [
                'choices' => array_flip(Slide::TYPES),
                'map' => [
                    'top' => ['Top', 'autoscroll', 'count', 'direction', 'scoreboard'],
                    'topbytype' => ['Top', 'autoscroll', 'count', 'direction', 'gametype'],
                    'content' => ['autoscroll', 'content'],
                    'video' => ['Video', 'video'],
                ],
                'placeholder' => 'Choose an option',
                'required' => true
            ])
            ->end();

        $formMapper
            ->with('Infos')
            ->add('name')
            ->add('showtitle')
            ->add('autoscroll')
            ->end();

        $formMapper
            ->with('Style')
            ->add('glow')
            ->add('style', ChoiceType::class, [
                'choices'  => array_flip(Slide::STYLES),
                'expanded' => true,
                'multiple' => false,
            ])
            ->end();

        $formMapper
            ->with('Slide')
            ->add('count')
            ->add('direction', ChoiceType::class, [
                'choices'  => [
                    'Biggest first (desc)' => 'DESC',
                    'Smallest first (asc)' => 'ASC',
                ],
                'expanded' => true,
                'multiple' => false,
            ])
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
            ->end();
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('type');
    }
}
