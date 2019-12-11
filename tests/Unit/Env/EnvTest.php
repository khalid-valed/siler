<?php declare(strict_types=1);

namespace Siler\Test\Unit\Env;

use PHPUnit\Framework\TestCase;
use function Siler\Env\env_bool;
use function Siler\Env\env_int;
use function Siler\Env\env_var;

class EnvTest extends TestCase
{
    public function testEnvVar()
    {
        putenv('FOO=bar');
        $this->assertSame('bar', env_var('FOO'));
    }

    public function testEnvVarDefault()
    {
        $this->assertSame('foo', env_var('BAR', 'foo'));
    }

    public function testEnvVarThrows()
    {
        $this->expectException(\UnexpectedValueException::class);
        env_var('BAR');
    }

    public function testEnvInt()
    {
        putenv('FOO=42');
        $this->assertSame(42, env_int('FOO'));
    }

    public function testEnvIntDefault()
    {
        $this->assertSame(43, env_int('BAR', 43));
    }

    public function testEnvBool()
    {
        putenv('FOO=true');
        $this->assertSame(true, env_bool('FOO'));

        putenv('FOO=false');
        $this->assertSame(false, env_bool('FOO'));
    }
}
