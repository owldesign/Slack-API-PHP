<?php

namespace Owldesign\Slack;

use GuzzleHttp\Client as Guzzle;
use RuntimeException;

class Client
{
    protected $endpoint;
    protected $channel;
    protected $username;
    protected $icon;
    protected $guzzle;

    /**
     * Client constructor.
     * @param $endpoint
     * @param array $attributes
     * @param Guzzle|null $guzzle
     */
    public function __construct($endpoint, array $attributes = [], Guzzle $guzzle = null)
    {
        $this->endpoint = $endpoint;

        if (isset($attributes['channel'])) {
            $this->setDefaultChannel($attributes['channel']);
        }

        if (isset($attributes['username'])) {
            $this->setDefaultUsername($attributes['username']);
        }

        if (isset($attributes['icon'])) {
            $this->setDefaultIcon($attributes['icon']);
        }

        $this->guzzle = $guzzle ?: new Guzzle;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->createMessage(), $name], $arguments);
    }

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @return mixed
     */
    public function getDefaultChannel()
    {
        return $this->channel;
    }

    public function setDefaultChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return mixed
     */
    public function getDefaultUsername()
    {
        return $this->username;
    }

    /**
     * @param $username
     */
    public function setDefaultUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getDefaultIcon()
    {
        return $this->icon;
    }

    /**
     * @param $icon
     */
    public function setDefaultIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return Message
     */
    public function createMessage()
    {
        $message = new Message($this);
        $message->setChannel($this->getDefaultChannel());
        $message->setUsername($this->getDefaultUsername());
        $message->setIcon($this->getDefaultIcon());

        return $message;
    }

    /**
     * @param Message $message
     */
    public function sendMessage(Message $message)
    {
        $payload = $this->preparePayload($message);

        $encode = json_encode($payload, JSON_UNESCAPED_UNICODE);

        if ($encode === false) {
            throw new RuntimeException(sprintf('JSON encoding error %s: %s', json_last_error(), json_last_error_msg()));
        }

        $this->guzzle->post($this->endpoint, ['body' => $encode]);
    }

    /**
     * @param Message $message
     * @return array
     */
    public function preparePayload(Message $message)
    {
        $payload = [
            'text' => $message->getText(),
            'channel' => $message->getChannel(),
            'username' => $message->getUsername()
        ];

        if ($icon = $message->getIcon()) {
            $payload[$message->getIconType()] = $icon;
        }

        $payload['attachments'] = $this->getAttachmentsAsArrays($message);

        return $payload;
    }

    /**
     * @param Message $message
     * @return array
     */
    protected function getAttachmentsAsArrays(Message $message)
    {
        $attachments = [];

        foreach ($message->getAttachments() as $attachment) {
            $attachments[] = $attachment->toArray();
        }

        return $attachments;
    }
}