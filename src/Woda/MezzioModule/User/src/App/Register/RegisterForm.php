<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\Register;

use Laminas\Form\Element;
use Laminas\Form\Element\Hidden;
use Laminas\Form\Form;
use Laminas\InputFilter\InputFilterProviderInterface;
use Mezzio\Csrf\CsrfGuardInterface;
use Woda\Core\Crypt\Password\Password;
use Woda\Core\ValueObject\Email;
use Woda\Core\ValueObject\PasswordHash;

final class RegisterForm extends Form implements InputFilterProviderInterface
{
    /** @var CsrfGuardInterface */
    private $guard;
    /** @var Password */
    private $password;

    /**
     * @param array{guard: CsrfGuardInterface} $options
     */
    public function __construct(string $name, array $options)
    {
        parent::__construct($name);
        $this->guard = $options['guard'];
        $this->password = $options['password'];
        $this->init();
    }

    public function init()
    {
        $this->add(
            [
                'type' => Element\Email::class,
                'name' => 'email',
                'options' => [
                    'label' => 'E-Mail',
                ],
            ]
        );

        $this->add(
            [
                'type' => Element\Password::class,
                'name' => 'password',
                'options' => [
                    'label' => 'Password',
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
                'name' => 'register',
                'type' => 'submit',
                'attributes' => [
                    'value' => 'Register',
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
                'filters' => [],
            ],
            [
                'name' => 'password',
                'required' => true,
                'filters' => [],
            ],
        ];
    }

    public function generateCsrfToken(): void
    {
        $this->get('csrf')->setValue($this->guard->generateToken());
    }

    public function getEmail(): Email
    {
        return Email::fromString($this->getData()['email']);
    }

    public function getPassword(): PasswordHash
    {
        return $this->password->create($this->getData()['password']);
    }
}
