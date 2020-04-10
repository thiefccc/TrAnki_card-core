<?php

namespace App\Service\Logger;

use Psr\Log\LoggerInterface;

/**
 * Trait LoggerTrait
 * @package App\Service\Logger
 */
trait LoggerTrait
{
    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @param string $message
     * @param array $context
     */
    public function logWarning(string $message, array $context = []): void
    {
        if ($this->logger) {
            $this->logger->warning($message, $context);
        }
    }

    /**
     * @required
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}