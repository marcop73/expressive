<?php
declare( strict_types=1 );

namespace App\Form\View\Helpers;

use Zend\Form\View\Helper\FormElementErrors as BaseFormElementErrors;

/**
 *
 * # Class FormElementErrors
 *
 * @package App\Form\View\Helpers
 * @author: Marco Peemöller
 *
 * @todo: class has 4 parent classes, use decorator pattern?
 */
class FormElementErrors extends BaseFormElementErrors
{
    protected $messageCloseString     = '</li></ul>';
    protected $messageOpenFormat      = '<ul%s class="alert alert-danger"><li class="alert alert-danger">';
    protected $messageSeparatorString = '</li><li class="alert alert-danger">';
}
