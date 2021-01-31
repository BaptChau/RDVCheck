<?php

namespace App\Form;

use App\Entity\Calendar;
use App\Entity\Importance;
use App\Repository\ImportanceRepository;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalendarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {   
        $builder
            ->add('debut',DateTimeType::class, [
                'date_widget'=>'single_text'
            ])
            ->add('fin',DateTimeType::class, [
                'date_widget'=>'single_text'
            ])
            ->add('titre')
            ->add('description')
            ->add('all_day')
            ->add('importance', EntityType::class,[
                'class'=>Importance::class,
                'choice_label'=>function(Importance $importance){
                    return sprintf('(%s) %s', $importance->getLibelle(), $importance->getId());
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}
