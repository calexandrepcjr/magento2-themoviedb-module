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
        $this->basePath = $this->sanitizeSlashes($basePath);
    }

    protected function sanitizeSlashes(string $value): string
    {
        return trim($value, '/');
    }

    protected function addSlashes(
        string $content,
        bool $checkQuery = false
    ): string {
        return $content === '' || ($checkQuery && $this->queries !== []) ?
                        $content :
                        $content . '/';
    }

    protected function addQuery(string $query): string
    {
        return $query === '' ? '' : '?' . $query;
    }

    public function basePath(string $basePath): Builder
    {
        $this->basePath = $this->sanitizeSlashes($basePath);
        $this->uri = null;

        return $this;
    }

    public function route(string $value): Builder
    {
        $this->routes[] = $this->sanitizeSlashes($value);
        $this->uri = null;

        return $this;
    }

    public function query(string $key, $value): Builder
    {
        $this->queries[$key] = $value;
        $this->uri = null;

        return $this;
    }

    public function hasQuery(string $key): bool
    {
        return isset($this->queries[$key]);
    }

    public function build(): string
    {
        $this->uri = $this->uri ??
            $this->addSlashes($this->basePath) .
            $this->addSlashes(implode('/', $this->routes), true) .
            $this->addQuery(http_build_query($this->queries));

        return $this->uri;
    }
}
