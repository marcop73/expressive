<?php

declare(strict_types=1);

namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Template;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Diactoros\Response\RedirectResponse;

class HomePageHandler implements RequestHandlerInterface
{
    /** @var Template\TemplateRendererInterface  */
    private $template;

    /** @var SessionInterface */
    private $session;

    /**
     * HomePageHandler constructor.
     *
     * @param Template\TemplateRendererInterface|null $template
     */
    public function __construct(Template\TemplateRendererInterface $template = null )
    {
        $this->template = $template;
    }

    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $this->session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        if (null === $this->session || false === $this->session->has('register')) {
            return new RedirectResponse('/register');
        }

        $data = [
            'first_name' => $this->session->get('register')
        ];
        return new HtmlResponse($this->template->render('app::home-page', [ 'data' => $data,]));
    }
}
