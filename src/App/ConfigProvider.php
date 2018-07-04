<?php

declare(strict_types=1);

namespace App;

use App\Form\View\Helpers\FormElementErrors;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'view_helpers' => $this->getViewHelperConfig(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies() : array
    {
        return [
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                Handler\RegisterPageHandler::class => Handler\RegisterPageFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates() : array
    {
        return [
            'paths' => [
                'app'    => ['templates/app'],
                'error'  => ['templates/error'],
                'layout' => ['templates/layout'],
            ],
        ];
    }

    /**
     * Return zend-form helper configuration.
     *
     * Obsoletes View\HelperConfig.
     *
     * @return array
     */
    public function getViewHelperConfig(): array
    {
        return [
            'aliases' => [
                'form_element_errors'        => FormElementErrors::class,
                'formelementerrors'          => FormElementErrors::class,
                'formElementErrors'          => FormElementErrors::class,
                'FormElementErrors'          => FormElementErrors::class,
            ],
            'factories' => [
                FormElementErrors::class           => InvokableFactory::class,
            ],
        ];
    }
}
