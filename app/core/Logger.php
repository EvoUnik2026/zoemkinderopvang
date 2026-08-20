<?php
/**
 * Core Logger - ZOEM Kinderopvang
 * Simple file-based logger with severity levels.
 */
declare(strict_types=1);

namespace core;

class Logger
{
    public const DEBUG = 'debug';
    public const INFO  = 'info';
    public const ERROR = 'error';

    private static ?Logger $instance = null;
    private string $dir;
    private string $level;

    /** Ordered list of levels (most severe last). */
    private array $levels = ['debug', 'info', 'warning', 'error'];

    private function __construct(string $dir, string $level)
    {
        $this->dir   = $dir;
        $this->level = strtolower($level);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    public static function getInstance(): Logger
    {
        if (self::$instance === null) {
            $config = require __DIR__ . '/../config.php';
            $log    = $config['log'];
            self::$instance = new self($log['dir'], $log['level'] ?? 'info');
        }
        return self::$instance;
    }

    /** Check whether a given level is active. */
    private function isEnabled(string $level): bool
    {
        return array_search($level, $this->levels) <= array_search($this->level, $this->levels);
    }

    /** Write a general log entry. */
    public function write(string $level, string $message, array $context = []): void
    {
        if (!$this->isEnabled($level) && $level !== self::ERROR) {
            return;
        }

        $date = date('c');
        $pid  = getmypid();
        $line = sprintf('[%s] [%s] [pid:%d] %s', $date, strtoupper($level), $pid, $message);

        if (!empty($context)) {
            $line .= ' ' . json_encode($context);
        }

        $file = $this->dir . '/' . date('Y-m-d') . '.log';
        @file_put_contents($file, $line . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    public function debug(string $message, array $context = []): void
    {
        $this->write(self::DEBUG, $message, $context);
    }

    public function info(string $message, array $context = []): void
    {
        $this->write(self::INFO, $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->write(self::ERROR, $message, $context);
    }
}