<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\DesignBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FakeExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            // new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('fake_list', [$this, 'getList']),
            new TwigFunction('fake_table', [$this, 'getTable']),
            new TwigFunction('fake_text', [$this, 'getText']),
            new TwigFunction('fake_title_text', [$this, 'getTitleText']),
        ];
    }

    public function getList(int $maxLines): array
    {
        $list = [];
        for ($i = 0; $i < $maxLines; ++$i) {
            $list[] = sprintf('line-%03d', $i);
        }

        return $list;
    }

    public function getTable(int $maxLines, int $maxCols): array
    {
        $table = [];
        for ($i = 0; $i < $maxLines; ++$i) {
            $cols = [];
            for ($j = 0; $j < $maxCols; ++$j) {
                $cols[] = sprintf('row-%03d-col-%03d', $i, $j);
            }
            $table[] = $cols;
        }

        return $table;
    }

    public function getText(int $word = 30): string
    {
        return 'Text'.str_repeat(' text', $word).'.';
    }

    public function getTitleText(int $maxText = 30, int $min = 30, int $max = 0): array
    {
        if ($max <= $min) {
            $max = $min + 20;
        }
        $text = [];
        for ($i = 0; $i < $maxText; ++$i) {
            $text[] = [sprintf('Title %03d', $i), $this->getText(random_int($min, $max))];
        }

        return $text;
    }
}
