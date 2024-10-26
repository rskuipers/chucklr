<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\GiggleExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class GiggleExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('giggles', [GiggleExtensionRuntime::class, 'countGiggles']),
        ];
    }
}
