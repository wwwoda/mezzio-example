<?php

declare(strict_types=1);

namespace Woda\MezzioModule\User\App\Login;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Authentication\AuthenticationInterface;
use Mezzio\Csrf\CsrfGuardInterface;
use Mezzio\Session\SessionMiddleware;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Woda\Form\FormElementManager;
use Woda\MezzioModule\Authentication\Middleware\AuthenticationMiddleware;
use Woda\MezzioModule\Core\Http\ResponseFactory;
use Woda\MezzioModule\Core\Middleware\CsrfMiddleware;
use Woda\MezzioModule\Core\Middleware\FlashMessageMiddleware;
use Woda\MezzioModule\Core\View\Renderer\SinglePageTemplateRenderer;

class LoginHandler implements RequestHandlerInterface
{
    /** @var SinglePageTemplateRenderer */
    private $template;
    /** @var ResponseFactory */
    private $response;
    /** @var AuthenticationInterface */
    private $auth;
    /** @var FormElementManager */
    private $formManager;

    public function __construct(
        SinglePageTemplateRenderer $template,
        ResponseFactory $response,
        AuthenticationInterface $auth,
        FormElementManager $formManager
    ) {
        $this->template = $template;
        $this->response = $response;
        $this->auth = $auth;
        $this->formManager = $formManager;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $guard = CsrfMiddleware::extractGuard($request);
        $user = AuthenticationMiddleware::user($request);
        if ($user !== null) {
            return $this->response->redirect('/backend');
        }
        $loginForm = new LoginForm($guard);
        $flashMessages = FlashMessageMiddleware::extractFlash($request);
        if ($request->getMethod() === 'POST') {
            $prg = (array)$request->getParsedBody();
            $loginForm->setData($prg);
            if ($loginForm->isValid()) {
                $user = $this->auth->authenticate($request);
                if ($user === null) {
                    $flashMessages->flash('message', 'Cannot authenticate, please try again');
                    return $this->response->redirect('/login');
                }
                $rememberMe = $prg['rememberme'] ?? '0';
                if ($rememberMe === '1') {
                    $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
                    $session->persistSessionFor(86400);
                }

                $flashMessages->flash('message', 'You are succesfully authenticated');
                return $this->response->redirect('/backend');
            }
            $flashMessages->flash('message', 'Login Failure, please try again');
            return $this->response->redirect('/login');
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
}
