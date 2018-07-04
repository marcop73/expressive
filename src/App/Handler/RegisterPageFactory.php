<?php
declare( strict_types=1 );

namespace App\Handler;

use App\Form\RegisterForm;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 *
 * # Class RegisterPageFactory
 *
 * @package App\Handler
 * @author: Marco Peemöller
 */
class RegisterPageFactory
{

    /** @var RegisterForm */
    private $registerForm;

    public function __invoke(ContainerInterface $container) : MiddlewareInterface
    {
        $template  = $container->get(TemplateRendererInterface::class);

        $this->registerForm = $container->get('FormElementManager')->get(RegisterForm::class);

        return new RegisterPageHandler($template, $this->registerForm);
    }
}
