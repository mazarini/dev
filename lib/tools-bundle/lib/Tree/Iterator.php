<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\ToolsBundle\Tree;

/**
 * Iterator.
 *
 * @implements \iterator <int,mixed>.
 */
class Iterator implements \iterator, \Countable
{
    /**
     * @var array<int,mixed> items
     */
    private array $items = [];

    /**
     * @var int key
     */
    private int $key = 0;

    /**
     * addChild.
     *
     * @return \iterator <int,mixed>
     */
    public function addChild(mixed $item): \iterator
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * key.
     */
    public function key(): int
    {
        return $this->key;
    }

    /**
     * current.
     *
     * @return object|mixed
     */
    public function current(): mixed
    {
        return $this->items[$this->key];
    }

    /**
     * next.
     */
    public function next(): void
    {
        ++$this->key;
    }

    /**
     * rewind.
     */
    public function rewind(): void
    {
        $this->key = 0;
    }

    /**
     * valid.
     */
    public function valid(): bool
    {
        return isset($this->items[$this->key]);
    }

    public function count(): int
    {
        return \count($this->items);
    }
}
