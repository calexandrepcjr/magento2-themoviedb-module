<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Tests\Unit\Lib;

use PHPUnit\Framework\TestCase;

use Capcj\TheMovieDb\Lib\{
    IniEnv,
    Contracts\Environment
};

final class IniEnvTest extends TestCase
{
    public function testEnvHasProperInterface(): void
    {
        $this->assertInstanceOf(Environment::class, new IniEnv());
    }

    public function testStringDefault(): void
    {
        $this->assertSame('default', (new IniEnv())->string('API', 'default'));
    }

    public function testString(): void
    {
        $env = new IniEnv();
        $env->putString('THEMOVIEDB_API_KEY', 'ABCD');
        $this->assertSame(
            'ABCD',
            $env->string('THEMOVIEDB_API_KEY', 'default')
        );
    }
}
