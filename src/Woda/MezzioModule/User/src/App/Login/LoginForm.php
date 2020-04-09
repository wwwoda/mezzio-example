<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\Login;

use Laminas\Form\Element\Checkbox;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Element\Password;
use Laminas\Form\Element\Text;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;
use Mezzio\Csrf\CsrfGuardInterface;

class LoginForm extends Form implements InputFilterProviderInterface
{
    /** @var CsrfGuardInterface */
    private $guard;

    public function __construct(CsrfGuardInterface $guard)
    {
        parent::__construct('login-form');

        $this->guard = $guard;
        $this->init();
    }

    public function init()
    {
        $this->add(
            [
                'type' => Text::class,
                'name' => 'email',
                'options' => [
                    'label' => 'Email',
                ],
            ]
        );

        $this->add(
            [
                'type' => Password::class,
                'name' => 'password',
                'options' => [
                    'label' => 'Password',
                ],
            ]
        );

        $this->add(
            [
                'type' => Checkbox::class,
                'name' => 'remember_me',
                'options' => [
                    'label' => 'Remember me',
                    'checked_value' => 1,
                    'unchecked_value' => 0,
                ],
            ]
        );

        $this->add(
            [
                'type' => Hidden::class,
                'name' => 'csrf',
            ]
        );

        $this->add(
            [
                'name' => 'Login',
                'type' => 'submit',
                'attributes' => [
                    'value' => 'Login',
                ],
            ]
        );
    }

    public function getInputFilterSpecification(): array
    {
        return [
            [
                'name' => 'email',
                'required' => true,
                'filters' => [
                ],
            ],
            [
                'name' => 'password',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ],
            [
                'name' => 'remember_me',
                'required' => false,
                'allow_empty' => true,
            ],
            [
                'name' => 'csrf',
                'required' => true,
                'validators' => [
                    [
                        'name' => 'callback',
                        'options' => [
                            'callback' => function (string $value): bool {
                                return $this->guard->validateToken($value);
                            },
                            'messages' => [
                                'callbackValue' => 'The form submitted did not originate from the expected site',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
