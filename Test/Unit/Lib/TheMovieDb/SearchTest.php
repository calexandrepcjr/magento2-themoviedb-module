<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Tests\Unit\Lib\TheMovieDb;

use PHPUnit\Framework\TestCase;

use Capcj\TheMovieDb\Lib\{
    TheMovieDbAPI\Search,
    Contracts\Builders\TheMovieDb\Search\Builder
};

final class SearchTest extends TestCase
{
    public function testHasProperInterface(): void
    {
        $this->assertInstanceOf(Builder::class, new Search(''));
    }

    public function testSearchMoviesUrl(): void
    {
        $this->assertSame(
            'https://api.themoviedb.org/3/search/movie?api_key=123&query=Accountant',
            (new Search('123'))->movie('Accountant')->url()
        );
    }

    public function testSearchMoviesWithLangUrl(): void
    {
        $this->assertSame(
            'https://api.themoviedb.org/3/search/movie'.
            '?api_key=123&language=pt_BR&query=Accountant',
            (new Search('123'))
            ->language('pt_BR')
            ->movie('Accountant')
            ->url()
        );
    }

    public function testSearchMoviesWithPageUrl(): void
    {
        $this->assertSame(
            'https://api.themoviedb.org/3/search/movie'.
            '?api_key=123&page=123&query=Accountant',
            (new Search('123'))
            ->page(123)
            ->movie('Accountant')
            ->url()
        );
    }

    public function testSearchMoviesIncludingAdultsUrl(): void
    {
        $this->assertSame(
            'https://api.themoviedb.org/3/search/movie'.
            '?api_key=123&include_adult=1&query=Accountant',
            (new Search('123'))
            ->adult(true)
            ->movie('Accountant')
            ->url()
        );
    }
}
