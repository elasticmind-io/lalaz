<?php declare(strict_types=1);

namespace App;

use Lalaz\Bootstrap;

class App
{
    public static function run(): void {
        require __DIR__ . '/Config/index.php';
        Bootstrap::boot(new Routes());
    }
}