<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\Register;

use App\AppRouter;
use Fig\Http\Message\RequestMethodInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\Core\Crypt\Password\Password;
use Woda\Form\FormElementManager;
use Woda\MessageBus\CommandBus\CommandBus;
use Woda\MezzioModule\Core\Http\ResponseFactory;
use Woda\MezzioModule\Core\Middleware\CsrfMiddleware;
use Woda\MezzioModule\Core\View\Renderer\SinglePageTemplateRenderer;
use Woda\User\Command\RegisterUser;

final class RegisterHandler implements RequestHandlerInterface
{
    /** @var SinglePageTemplateRenderer */
    private $template;
    /** @var ResponseFactory */
    private $response;
    /** @var CommandBus */
    private $commandBus;
    /** @var AppRouter */
    private $router;
    /** @var FormElementManager */
    private $formManager;
    /** @var Password */
    private $password;

    public function __construct(
        SinglePageTemplateRenderer $template,
        ResponseFactory $response,
        CommandBus $commandBus,
        AppRouter $router,
        FormElementManager $formManager,
        Password $password
    ) {
        $this->template = $template;
        $this->response = $response;
        $this->commandBus = $commandBus;
        $this->router = $router;
        $this->formManager = $formManager;
        $this->password = $password;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $guard = CsrfMiddleware::extractGuard($request);
        $form = $this->formManager->get(RegisterForm::class, ['guard' => $guard, 'password' => $this->password]);
        if ($request->getMethod() === RequestMethodInterface::METHOD_POST) {
            return $this->post($request, $form);
        }
        return $this->get($request, $form);
    }

    private function post(ServerRequestInterface $request, RegisterForm $form): ResponseInterface
    {
        $form->setData((array)$request->getParsedBody());
        if (!$form->isValid()) {
            var_dump($form->getMessages());
            return $this->get($request, $form);
        }
        $this->commandBus->handle(new RegisterUser($form->getEmail(), $form->getPassword()));
        return $this->response->redirect($this->router->homeUri());
    }

    private function get(ServerRequestInterface $request, RegisterForm $form): ResponseInterface
    {
        $form->generateCsrfToken();
        return new HtmlResponse(
            $this->template->render(
                $request,
                'user::register',
                [
                    'form' => $form,
                ]
            )
        );
    }
}
