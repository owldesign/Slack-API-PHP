<?php

namespace Owldesign\Slack;


class ActionConfirmation
{
    protected $title;
    protected $text;
    protected $okText;
    protected $dismissText;

    /**
     * ActionConfirmation constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }

        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['ok_text'])) {
            $this->setOkText($attributes['ok_text']);
        }

        if (isset($attributes['dismiss_text'])) {
            $this->setDismissText($attributes['dismiss_text']);
        }
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOkText()
    {
        return $this->okText;
    }

    /**
     * @param $okText
     * @return $this
     */
    public function setOkText($okText)
    {
        $this->okText = $okText;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDismissText()
    {
        return $this->dismissText;
    }

    /**
     * @param $dismissText
     * @return $this
     */
    public function setDismissText($dismissText)
    {
        $this->dismissText = $dismissText;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'title' => $this->getTitle(),
            'text' => $this->getText(),
            'ok_text' => $this->getOkText(),
            'dismiss_text' => $this->getDismissText(),
        ];
    }
}