<?php declare(strict_types = 1);

namespace Capcj\TheMovieDb\Lib\Environment\Ini;

use Capcj\TheMovieDb\Lib\Contracts\Environment;

class Env implements Environment
{
    /**
     * @var array
     **/
    protected $env;

    public function __construct(string $iniFile = '.env')
    {
        $iniPath = dirname(__FILE__) . '/../../../' . $iniFile;

        if (file_exists($iniPath)) {
            $this->env = parse_ini_file($iniPath);
            return;
        }

        $this->env = parse_ini_file(
            dirname(__FILE__) . '/../../../../../../../' . $iniFile
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
