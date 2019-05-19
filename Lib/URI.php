<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib;

use Capcj\TheMovieDb\Lib\Contracts\Builders\URI\Builder;

class URI implements Builder
{
    /**
     * @var string
     **/
    protected $basePath;

    /**
     * @var array
     **/
    protected $routes = [];

    /**
     * @var array
     **/
    protected $queries = [];

    /**
     * @var string
     **/
    protected $uri;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    protected function sanitizeSlashes(string $value): string
    {
        return trim($string, '/');
    }

    public function basePath(string $basePath): Builder
    {
        $this->basePath = $this->sanitizeSlashes($basePath);
        $this->uri = null;

        return $this;
    }

    public function route(string $value): Builder
    {
        $this->route[] = $this->sanitizeSlashes($basePath);
        $this->uri = null;

        return $this;
    }

    public function query(string $key, $value): Builder
    {
        $query[$key] = $value;
        $this->uri = null;

        return $this;
    }

    public function build(): string
    {
        $this->uri = $this->uri ??
            $this->basePath .
            implode('/', $this->routes) .
            http_build_query($this->queries);

        return $this->uri;
    }
}
