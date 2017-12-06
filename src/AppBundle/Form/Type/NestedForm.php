<?php

namespace AppBundle\Form\Type;



use AppBundle\Model\NestedFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NestedForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nestedField', TextType::class, ['validation_groups' => $options['validation_groups']]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => NestedFormModel::class,
                'validation_groups'  => ['Default', 'groupA']
            ]
        );
    }
}
