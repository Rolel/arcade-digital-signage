<?php

namespace App\Admin;

use App\Entity\Score;
use App\Entity\Scoreboard;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DatePickerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

final class ScoreAdmin extends AbstractAdmin
{

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('scoreboard.game')
            ->add('scoreboard')
            ->add('playername')
			->add('date')
			;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('scoreboard.game')
            ->add('scoreboard')
            ->add('value')
            ->add('playername')
			->add('date')
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
            ->add('scoreboard', ModelListType::class, [
                'required' => true,
                'btn_add' => false,
                'btn_edit' => false,
                'btn_list' => 'Select a scoreboard',
                'btn_delete' => false
            ])
        ->add('playername');

        $type = 0;
        /*
        if (($score = $this->getSubject()) instanceof Score) {
            dump($score);
            if (($scoreboard = $score->getScoreboard()) instanceof Scoreboard) {
                $type = $scoreboard->getType();
            }
        }
        */

        /*
        if (in_array($type, [10,11])) {
            $formMapper->add('value', TimeType::class, [
                'input'  => 'timestamp',
                'widget' => 'text',
            ]);
        }
        if (in_array($type, [21,22])) {
            $formMapper->add('value', MoneyType::class, [
                'currency'  => Scoreboard::TYPES_UNIT[$type],
            ]);
        }
        if (in_array($type, [20])) {
            $formMapper->add('value', IntegerType::class, []);
        }
        if (in_array($type, [0])) {
            $formMapper->add('value');
        }
        */

        // Set date to now when new score is created
        if ($this->getSubject() instanceof Score && $this->getSubject()->getDate() == null) {
            $this->getSubject()->setDate(new \DateTime("now"));
        }

        $formMapper
            ->add('rawvalue')
            ->add('date', DateType::class)
        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
			->add('id')
			->add('date')
			;
    }
}
