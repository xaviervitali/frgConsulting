<?php

namespace App\Form;

use App\Service\CSVExport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EntitySelectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Entity', ChoiceType::class, [
            'choices'  => [
                'Question' =>  'Question',
                'Answer' => 'Answer',
                'Historic of Questions' => "HistoricQuestion",
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }


    
    
}
