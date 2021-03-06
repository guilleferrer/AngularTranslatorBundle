<?php

namespace Undf\AngularTransBundle\Twig\Extension;

use Undf\AngularTransBundle\Services\Translator;

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

    public function configUTrans($domains = 'messages', $locale = 'es')
    {
        $translations = array();
        $domains = is_array($domains) ? $domains : array($domains);
        foreach($domains as $domain) {
            $translations = array_merge($translations, $this->translator->getCatalogue($locale)->all($domain));
        }

        $html = '<script type="text/javascript">
                    angular.module("uTrans").value("translations", '. json_encode($translations) . ');
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
