<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link https://phpdoc.org
 */

namespace phpDocumentor\Guides\Twig;

use phpDocumentor\Guides\Meta\Entry;
use phpDocumentor\Guides\Metas;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TocExtension extends AbstractExtension
{
    /** @var Metas */
    private $metas;

    public function __construct(Metas $metas)
    {
        $this->metas = $metas;
    }

    public function getFunctions() : array
    {
        return [
            new TwigFunction('menu', [$this, 'menu']),
        ];
    }

    /**
     * @return array<string, array<int, array<string, array|string>>|string>
     */
    public function menu(int $maxLevel = 2) : array
    {
        $index = $this->metas->get('index');

        if (!$index instanceof Entry) {
            return [];
        }

        return $this->createMenuItem($index, $maxLevel);
    }

    /**
     * @return array{label: string, path: string, items: list<array<mixed>>}
     */
    private function createMenuItem(Entry $index, int $levelsRemaining) : array
    {
        $menu = [
            'label' => $index->getTitle(),
            'path' => $index->getUrl(),
            'items' => [],
        ];

        if ($levelsRemaining < 1) {
            return $menu;
        }

        foreach ($index->getTocs()[0] ?? [] as $url) {
            $meta = $this->metas->get($url);
            if (!$meta instanceof Entry) {
                continue;
            }

            $menu['items'][] = $this->createMenuItem($meta, $levelsRemaining - 1);
        }

        return $menu;
    }
}
