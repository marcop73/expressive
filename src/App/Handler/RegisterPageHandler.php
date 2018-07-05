<?php
declare( strict_types=1 );

namespace App\Handler;

use App\Form\RegisterForm;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 *
 * # Class RegisterPageHandler
 *
 * @package App\Handler
 * @author: Marco Peemöller
 */
class RegisterPageHandler implements RequestHandlerInterface
{
    private const POST_REQUEST = 'POST';

    /** @var TemplateRendererInterface  */
    private $template;

    /** @var RegisterForm  */
    private $registerForm;

    /** @var SessionInterface */
    private $session;

    /**
     * RegisterPageHandler constructor.
     *
     * @param TemplateRendererInterface $template
     * @param RegisterForm $registerForm
     */
    public function __construct(TemplateRendererInterface $template, RegisterForm $registerForm)
    {
        $this->template = $template;
        $this->registerForm = $registerForm;
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $this->session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if (true === $this->session->has('register')) {
            return new RedirectResponse('/');
        }

        $this->registerForm->setData($request->getParsedBody());

        if (self::POST_REQUEST === $request->getMethod() && true === $this->registerForm->isValid()) {
            $this->session->set('register', $this->registerForm->get('first_name')->getValue());
            return new RedirectResponse('/');
        }

        $error = '';
        if (self::POST_REQUEST === $request->getMethod()) {
            $error = 'Register failure, please try again';
        }

        return new HtmlResponse(
            $this->template->render('app::register-page', [
                'form'  => $this->registerForm,
                'error' => $error,
            ])
        );
    }
}
