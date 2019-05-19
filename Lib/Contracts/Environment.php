<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib\Contracts;

interface Environment
{
    public function __construct(string $iniFile = '.env');
    public function putString(string $key, string $value): self;
    public function string(string $var, string $default = ''): string;
}
