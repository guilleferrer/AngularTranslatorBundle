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
            'utranslator_expose_translations' => new \Twig_Function_Method($this, 'exposed_translations', array('is_safe' => array('html')))
        );
    }

    public function exposed_translations($appName = 'app', $domain = 'UndfExposed')
    {
        $json = $this->translator->getCatalogue('es')->all('UndfExposed');

        $translations = json_encode($json);

        $html = '<script type="text/javascript">
                    ' . $appName . '.run(function(translationsLoader){

                    // Set the translations
                    translationsLoader.load(' . $translations . ');
                });
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
