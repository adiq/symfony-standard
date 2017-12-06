<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\FormA;
use AppBundle\Form\Type\FormB;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @throws \Symfony\Component\Form\Exception\AlreadySubmittedException
     */
    public function indexAction(Request $request)
    {
        $formA = $this->createForm(FormA::class);
        $formB = $this->createForm(FormB::class);

        $formA->submit([]);
        $formB->submit([]);

        dump(
            'Thanks for looking into my report :-) You\'re cool!',
            'What is the problem? When using groups on nested forms, Valid constraint defined in YAML is not applied and additional duplication of Valid constraint (in builder) is required to work properly. I consider it a bug: as whatever we define constraint in YAML or in builder, behavior/outcome of the validation should be the same (valid = error occurred).'
        );

        // Validation
        dump(
            'Validation defined in YAML',
            '
            AppBundle\Model\FormModel:
                properties:
                    field:
                        - Valid: ~
            
            AppBundle\Model\NestedFormModel:
                properties:
                    nestedField:
                        - NotBlank:
                            message: VALIDATION.NOT_BLANK
                            groups: [groupA]
            '
        );

        // NestedForm
        dump(
            'Nested Form definition',
             '
                $builder->add(\'nestedField\', TextType::class, [\'validation_groups\' => $options[\'validation_groups\']]);
                $resolver->setDefaults(
                    [
                        \'data_class\'         => NestedFormModel::class,
                        \'validation_groups\'  => [\'Default\', \'groupA\']
                    ]
                );
            ');

        // FormA
        dump(
            [
                'formA' => [
                    'description' => 'Valid constraint defined in YAML',
                    'definition' => '
                        $builder->add(\'field\', NestedForm::class);
                        $resolver->setDefaults([\'data_class\' => FormModel::class]);
                    ',
                    'isFormValid' => $formA->isValid(),
                    'formErrors' => $formA->getErrors(true, true)
                ]
            ]
        );

        // FormB
        dump(
            [
                'formB' => [
                    'description' => 'Valid constraint defined in YAML and builder',
                    'definition' => '
                        $builder->add(\'field\', NestedForm::class, [\'constraints\' => [new Valid()]]);
                        $resolver->setDefaults([\'data_class\' => FormModel::class]);
                    ',
                    'isFormValid' => $formB->isValid(),
                    'formErrors' => $formB->getErrors(true, true)
                ]
            ]
        );

        die;
    }
}
