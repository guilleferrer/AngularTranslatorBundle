<?php

namespace Undf\AngularTranslatorBundle\Twig\Extension;

use Undf\AngularTranslatorBundle\Services\Translator;

class UTranslationsExtension extends \Twig_Extension
{

    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function getFunctions()
    {
        return array(
            'utrans_expose_translations' => new \Twig_Function_Method($this, 'configUTrans', array('is_safe' => array('html')))
        );
    }

    public function configUTrans($domain = 'messages', $locale = 'es')
    {
        $json = $this->translator->getCatalogue($locale)->all($domain);

        $jsonTranslations = json_encode($json);

        $html = '<script type="text/javascript">
                    angular.module("uTrans").config("translations", ' . $jsonTranslations .');
                </script>';

        return $html;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'utranslations_extension';
    }

}
