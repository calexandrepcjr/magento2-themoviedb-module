<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Tests\Unit\Lib;

use PHPUnit\Framework\TestCase;

use Capcj\TheMovieDb\Lib\{
    URI,
    Contracts\Builders\URI\Builder
};

final class URITest extends TestCase
{
    public function testHasProperInterface(): void
    {
        $this->assertInstanceOf(Builder::class, new URI(''));
    }

    public function testBaseURI(): void
    {
        $this->assertSame(
            'www.themoviedb.com/',
            (new URI('www.themoviedb.com'))->build()
        );
    }

    public function testRoutes(): void
    {
        $url = (new URI('www.themoviedb.com'))
             ->route('movies')
             ->route('all')
             ->route('/of')
             ->route('time/')
             ->build();

        $this->assertSame(
            'www.themoviedb.com/movies/all/of/time/',
            $url
        );
    }

    public function testQueries(): void
    {
        $url = (new URI('www.themoviedb.com'))
             ->route('movies')
             ->query('name', 'John')
             ->query('age', 18)
             ->build();

        $this->assertSame(
            'www.themoviedb.com/movies?name=John&age=18',
            $url
        );
    }
}
