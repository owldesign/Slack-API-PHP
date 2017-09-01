<?php

namespace Owldesign\Slack;

use InvalidArgumentException;

class AttachmentAction
{
    const TYPE_BUTTON = 'button';
    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER = 'danger';

    protected $name;
    protected $text;
    protected $style;
    protected $type = self::TYPE_BUTTON;
    protected $value;
    protected $confirm;

    /**
     * AttachmentAction constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['name'])) {
            $this->setName($attributes['name']);
        }

        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['style'])) {
            $this->setStyle($attributes['style']);
        }

        if (isset($attributes['type'])) {
            $this->setType($attributes['type']);
        }

        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
        }

        if (isset($attributes['confirm'])) {
            $this->setConfirm($attributes['confirm']);
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

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
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param $style
     * @return $this
     */
    public function setStyle($style)
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirm()
    {
        return $this->confirm;
    }

    /**
     * @param $confirm
     * @return $this
     */
    public function setConfirm($confirm)
    {
        if ($confirm instanceof ActionConfirmation) {
            $this->confirm = $confirm;

            return $this;
        } elseif (is_array($confirm)) {
            $this->confirm = new ActionConfirmation($confirm);

            return $this;
        }

        throw new InvalidArgumentException('The action confirmation must be an instance of Maknz\Slack\ActionConfirmation or a keyed array');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'text' => $this->getText(),
            'style' => $this->getStyle(),
            'type' => $this->getType(),
            'value' => $this->getValue(),
            'confirm' => $this->getConfirm()->toArray(),
        ];
    }
}