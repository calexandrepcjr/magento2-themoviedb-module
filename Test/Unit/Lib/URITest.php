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
            'www.themoviedb.com',
            (new URI('www.themoviedb.com'))->build()
        );
    }
}
