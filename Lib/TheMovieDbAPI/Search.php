<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib\TheMovieDbAPI;

use BadFunctionCallException;
use stdClass;

use Capcj\TheMovieDb\Lib\Contracts\Builders\{
    TheMovieDb\Search\Builder,
    URI\Builder as URIBuilder
};
use Capcj\TheMovieDb\Lib\{
    Environment\Ini\Env,
    URI
};

class Search implements Builder
{
    /**
     * @var string
     **/
    protected $apiKey;

    /**
     * @var URIBuilder
     **/
    protected $uri;

    /**
     * @var object[]
     **/
    protected $result;

    public function __construct(string $apiKey = '')
    {
        $this->loadApiKey($apiKey);

        $this->uri = (new URI(Builder::API_URL))
                   ->route('search')
                   ->route('movie')
                   ->query('api_key', $this->apiKey);
    }

    protected function loadApiKey(string $apiKey): void
    {
        if ($apiKey === '') {
            $apiKey = (new Env())->string('THEMOVIEDB_API_KEY', '');
        }

        $this->apiKey = $apiKey;
    }

    public function language(string $lang = 'en-US'): Builder
    {
        $this->uri->query('language', $lang);

        return $this;
    }

    public function movie(string $name): Builder
    {
        $this->uri->query('query', $name);

        return $this;
    }

    public function page(int $number = 1): Builder
    {
        $this->uri->query('page', $number);

        return $this;
    }

    public function adult(bool $value = false): Builder
    {
        $this->uri->query('include_adult', $value);

        return $this;
    }

    public function url(): string
    {
        return $this->uri->build();
    }

    protected function checkRequiredFields(): void
    {
        if ($this->uri->hasQuery('query')) {
            return;
        }

        throw new BadFunctionCallException('Movie function is required');
    }

    public function build(): stdClass
    {
        $this->checkRequiredFields();

        if ($this->result === null) {
            $this->result = json_decode(
                file_get_contents($this->url())
            );
        }

        return $this->result;
    }
}
