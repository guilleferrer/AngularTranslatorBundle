<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Undf\AngularTransBundle\Services;

use Symfony\Bundle\FrameworkBundle\Translation\Translator as BaseTranslator;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Config\ConfigCache;

/**
 * Translator.
 *
 * @author Guille
 */
class Translator extends BaseTranslator
{

    public function getCatalogue($locale)
    {
        $this->loadCatalogue($locale);

        return $this->catalogues[$locale];
    }

}
