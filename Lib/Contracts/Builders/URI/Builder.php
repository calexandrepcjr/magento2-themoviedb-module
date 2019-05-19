<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib\Contracts\Builders\URI;

interface Builder
{
    public function __construct(string $basePath);
    public function basePath(string $basePath): self;
    public function route(string $value): self;
    public function query(string $key, $value): self;
    public function build(): string;
}
