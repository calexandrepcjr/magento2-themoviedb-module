<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib\Contracts\Builders\TheMovieDb\Search;

use stdClass;

use Capcj\TheMovieDb\Lib\Contracts\Builders\{
    Builder as BaseBuilder,
    URI\Builder as URI
};

/**
 * @property string $apiKey;
 * @property URI $uri
 **/
interface Builder extends BaseBuilder
{
    public const API_URL = 'https://api.themoviedb.org/3';

    public function __construct(string $apiKey = '');
    public function language(string $lang = 'en-US'): self;
    public function movie(string $name): self;
    public function page(int $number = 1): self;
    public function adult(bool $value = false): self;
    public function url(): string;
    public function build(): stdClass;
}
