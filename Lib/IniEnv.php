<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib;

use Capcj\TheMovieDb\Lib\Contracts\Environment;

class IniEnv implements Environment
{
    /**
     * @var array
     **/
    protected $env;

    public function __construct(string $iniFile = '.env')
    {
        $this->env = parse_ini_file(
            dirname(__FILE__) . '/../' . $iniFile
        );
    }

    public function putString(string $key, string $value): Environment
    {
        $this->env[$key] = $value;
        return $this;
    }

    public function string(string $var, string $default = ''): string
    {
        return (string) ($this->env[$var] ?? $default);
    }
}
