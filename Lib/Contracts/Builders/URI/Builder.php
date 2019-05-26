<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib\Contracts\Builders\URI;

use Capcj\TheMovieDb\Lib\Contracts\Builders\Builder as BaseBuilder;

interface Builder extends BaseBuilder
{
    public function __construct(string $basePath);
    public function basePath(string $basePath): self;
    public function route(string $value): self;
    /**
     * @param string $key
     * @param mixed $value
     * @returns self
     **/
    public function query(string $key, $value): self;
    public function build(): string;
}
