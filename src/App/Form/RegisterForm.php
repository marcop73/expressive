<?php
declare( strict_types=1 );

namespace App\Form;

use Zend\Form\Element\Text;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

/**
 *
 * # Class RegisterForm
 *
 * @package App\Form
 * @author: Marco Peemöller
 */
class RegisterForm extends Form implements InputFilterProviderInterface
{
    /**
     * RegisterForm constructor.
     */
    public function __construct()
    {
        parent::__construct('register-form');
    }

    /**
     *
     */
    public function init(): void
    {
        $this->add([
            'type' => Text::class,
            'name' => 'first_name',
            'options' => [
                'label' => 'First Name',
            ],
        ]);

        $this->add([
            'type' => Text::class,
            'name' => 'last_name',
            'options' => [
                'label' => 'Last Name',
            ],
        ]);

        $this->add([
            //For demonstration we use Text instead of Email and specify the validator in getInputFilterSpecification
            'type' => Text::class,
            'name' => 'email',
            'options' => [
                'label' => 'Email Address',
            ],
        ]);

        $this->add([
            'name' => 'Register',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Register',
            ],
        ]);
    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification(): array
    {
        return [
            [
                'name' => 'first_name',
                'required' => false,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],

            [
                'name' => 'last_name',
                'required' => false,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],

            [
                'name' => 'email',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    ['name' => 'EmailAddress'],
                ],
            ],
        ];
    }
}
