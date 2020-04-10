<?php

namespace App\Service\Shared;

use App\Service\Logger\LoggerTrait;
use Http\Client\Exception;
use Nexy\Slack\Client;

class SlackClient
{
    use LoggerTrait;

    protected const SLACK_FROM = 'Card Core API';

    /**
     * @var Client
     */
    private $slackClient;

    /**
     * @codeCoverageIgnore
     * SlackClient constructor.
     * @param Client $slackClient
     */
    public function __construct (Client $slackClient)
    {
        $this->slackClient = $slackClient;
    }

    /**
     * @param string $text
     */
    public function sendMessage(string $text): void
    {
        $message = $this->slackClient->createMessage()
            ->from(self::SLACK_FROM)
            ->withIcon(':ghost:')
            ->setText($text);

        try {
            $this->slackClient->sendMessage($message);
        } catch (Exception $e) {
            $this->logWarning(
                'Could not send a message to Slack.',
                [
                    'message' => $text,
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}