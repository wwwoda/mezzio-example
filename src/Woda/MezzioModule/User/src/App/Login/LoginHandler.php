<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\Login;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Csrf\CsrfGuardInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\MezzioModule\Authentication\Middleware\MezzioAuthenticationMiddleware;
use Woda\MezzioModule\Core\Http\ResponseFactory;
use Woda\MezzioModule\Core\Middleware\CsrfMiddleware;
use Woda\MezzioModule\Core\Middleware\FlashMessageMiddleware;
use Woda\MezzioModule\Core\Middleware\MezzioSessionMiddleware;
use Woda\MezzioModule\Core\View\Renderer\SinglePageTemplateRenderer;
use Woda\MezzioModule\LaminasForm\FormElementManagerInterface;
use Woda\MezzioModule\User\UserRouter;

class LoginHandler implements RequestHandlerInterface
{
    private SinglePageTemplateRenderer $template;
    private ResponseFactory $response;
    private AuthenticationInterface $auth;
    private FormElementManagerInterface $formManager;
    private UserRouter $router;

    public function __construct(
        SinglePageTemplateRenderer $template,
        ResponseFactory $response,
        AuthenticationInterface $auth,
        FormElementManagerInterface $formManager,
        UserRouter $router
    ) {
        $this->template = $template;
        $this->response = $response;
        $this->auth = $auth;
        $this->formManager = $formManager;
        $this->router = $router;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $guard = CsrfMiddleware::extractGuard($request);
        $user = MezzioAuthenticationMiddleware::user($request);
        if ($user !== null) {
            return $this->response->redirect('/backend');
        }
        $loginForm = new LoginForm($guard);
        if ($request->getMethod() === 'POST') {
            return $this->handlePost($loginForm, $request);
        }
        return $this->htmlResponse($loginForm, $guard, $request);
    }

    private function htmlResponse(
        LoginForm $loginForm,
        CsrfGuardInterface $guard,
        ServerRequestInterface $request
    ): ResponseInterface {
        return new HtmlResponse(
            $this->template->render(
                $request,
                'user::login',
                [
                    'form' => $loginForm,
                    'token' => $guard->generateToken(),
                ]
            )
        );
    }

    private function handlePost(
        LoginForm $loginForm,
        ServerRequestInterface $request
    ): ResponseInterface {
        $flashMessages = FlashMessageMiddleware::extractFlash($request);
        $prg = (array)$request->getParsedBody();
        $loginForm->setData($prg);
        if (!$loginForm->isValid()) {
            $flashMessages->flash('message', 'Login Failure, please try again');
            return $this->response->redirect($this->router->loginUrl());
        }
        $user = $this->auth->authenticate($request);
        if ($user === null) {
            $flashMessages->flash('message', 'Cannot authenticate, please try again');
            return $this->response->redirect($this->router->loginUrl());
        }
        $rememberMe = $prg['rememberme'] ?? '0';
        if ($rememberMe === '1') {
            $this->extendSessionLifetime($request);
        }
        $flashMessages->flash('message', 'You are successfully authenticated');
        return $this->response->redirect('/backend');
    }

    private function extendSessionLifetime(ServerRequestInterface $request)
    {
        $session = MezzioSessionMiddleware::extractSession($request);
        $session->persistSessionFor(86400);
    }
}
