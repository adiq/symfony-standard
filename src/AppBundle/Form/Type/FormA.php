<?php

namespace AppBundle\Form\Type;


use AppBundle\Model\FormAModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class FormA extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fieldOne', FormB::class)
            ->add('fieldTwo', FormB::class, ['constraints' => [new Valid()]]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => FormAModel::class
            ]
        );
    }
}
