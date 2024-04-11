#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace Ghostwriter\Phest\Console;

use ErrorException;
use Ghostwriter\Container\Container;
use Ghostwriter\Phest\ServiceProvider;
use Throwable;

use function dirname;
use function error_reporting;
use function file_exists;
use function fwrite;
use function ini_set;
use function restore_error_handler;
use function set_error_handler;
use function sprintf;

use const PHP_EOL;
use const STDERR;

/** @var ?string $_composer_autoload_path */
(static function (string $composerAutoloadPath): void {
    if (! file_exists($composerAutoloadPath)) {
        fwrite(
            STDERR,
            sprintf('[ERROR]Cannot locate "%s"\n please run "composer install"\n', $composerAutoloadPath)
        );

        exit(1);
    }

    require $composerAutoloadPath;

    ini_set('memory_limit', '-1');

    set_error_handler(static function (int $severity, string $message, string $filename, int $line): bool {
        if (0 === ($severity & error_reporting())) {
            return false;
        }

        throw new ErrorException($message, 0, $severity, $filename, $line);
    });

    /**
     * #BlackLivesMatter.
     */

    try {
        $container = Container::getInstance();

        if (! $container->has(ServiceProvider::class)) {
            $container->provide(ServiceProvider::class);
        }

        $exitCode = $container->get(Application::class)->run();

        exit($exitCode);
    } catch (Throwable $exception) {
        fwrite(STDERR, sprintf(
            '[%s] %s: ' . PHP_EOL . '%s' . PHP_EOL,
            $exception::class,
            $exception->getMessage(),
            $exception->getTraceAsString()
        ));
    } finally {
        restore_error_handler();
    }
})($_composer_autoload_path ?? dirname(__DIR__) . '/vendor/autoload.php');
