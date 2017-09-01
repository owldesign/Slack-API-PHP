<?php

namespace Owldesign\Slack;

use InvalidArgumentException;

class Attachment
{
    protected $fallback;
    protected $text;
    protected $image_url;
    protected $thumb_url;
    protected $pretext;
    protected $title;
    protected $title_link;
    protected $author_name;
    protected $author_link;
    protected $author_icon;
    protected $color = 'good';
    protected $footer;
    protected $footer_icon;
    protected $timestamp;
    protected $fields = [];
    protected $actions = [];

    /**
     * Attachment constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['fallback'])) {
            $this->setFallback($attributes['fallback']);
        }

        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['image_url'])) {
            $this->setImageUrl($attributes['image_url']);
        }

        if (isset($attributes['thumb_url'])) {
            $this->setThumbUrl($attributes['thumb_url']);
        }

        if (isset($attributes['pretext'])) {
            $this->setPretext($attributes['pretext']);
        }

        if (isset($attributes['color'])) {
            $this->setColor($attributes['color']);
        }

        if (isset($attributes['footer'])) {
            $this->setFooter($attributes['footer']);
        }

        if (isset($attributes['footer_icon'])) {
            $this->setFooterIcon($attributes['footer_icon']);
        }

        if (isset($attributes['timestamp'])) {
            $this->setTimestamp($attributes['timestamp']);
        }

        if (isset($attributes['fields'])) {
            $this->setFields($attributes['fields']);
        }

        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }

        if (isset($attributes['title_link'])) {
            $this->setTitleLink($attributes['title_link']);
        }

        if (isset($attributes['author_name'])) {
            $this->setAuthorName($attributes['author_name']);
        }

        if (isset($attributes['author_link'])) {
            $this->setAuthorLink($attributes['author_link']);
        }

        if (isset($attributes['author_icon'])) {
            $this->setAuthorIcon($attributes['author_icon']);
        }

        if (isset($attributes['actions'])) {
            $this->setActions($attributes['actions']);
        }
    }

    public function getFallback()
    {
        return $this->fallback;
    }

    public function setFallback($fallback)
    {
        $this->fallback = $fallback;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getThumbUrl()
    {
        return $this->thumb_url;
    }

    public function setThumbUrl($thumb_url)
    {
        $this->thumb_url = $thumb_url;

        return $this;
    }

    public function getPretext()
    {
        return $this->pretext;
    }

    public function setPretext($pretext)
    {
        $this->pretext = $pretext;

        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    public function getFooterIcon()
    {
        return $this->footer_icon;
    }

    public function setFooterIcon($footerIcon)
    {
        $this->footer_icon = $footerIcon;

        return $this;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitleLink()
    {
        return $this->title_link;
    }

    public function setTitleLink($title_link)
    {
        $this->title_link = $title_link;

        return $this;
    }

    public function getAuthorName()
    {
        return $this->author_name;
    }

    public function setAuthorName($author_name)
    {
        $this->author_name = $author_name;

        return $this;
    }

    public function getAuthorLink()
    {
        return $this->author_link;
    }

    public function setAuthorLink($author_link)
    {
        $this->author_link = $author_link;

        return $this;
    }

    public function getAuthorIcon()
    {
        return $this->author_icon;
    }

    public function setAuthorIcon($author_icon)
    {
        $this->author_icon = $author_icon;

        return $this;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields(array $fields)
    {
        $this->clearFields();

        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    public function addField($field)
    {
        if ($field instanceof AttachmentField) {
            $this->fields[] = $field;

            return $this;
        } elseif (is_array($field)) {
            $this->fields[] = new AttachmentField($field);

            return $this;
        }

        throw new InvalidArgumentException('The attachment field must be an instance of Maknz\Slack\AttachmentField or a keyed array');
    }

    public function clearFields()
    {
        $this->fields = [];

        return $this;
    }

    public function clearActions()
    {
        $this->actions = [];

        return $this;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setActions($actions)
    {
        $this->clearActions();

        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    public function addAction($action)
    {
        if ($action instanceof AttachmentAction) {
            $this->actions[] = $action;

            return $this;
        } elseif (is_array($action)) {
            $this->actions[] = new AttachmentAction($action);

            return $this;
        }

        throw new InvalidArgumentException('The attachment action must be an instance of Maknz\Slack\AttachmentAction or a keyed array');
    }

    public function toArray()
    {
        $data = [
            'fallback' => $this->getFallback(),
            'text' => $this->getText(),
            'pretext' => $this->getPretext(),
            'color' => $this->getColor(),
            'footer' => $this->getFooter(),
            'footer_icon' => $this->getFooterIcon(),
            'ts' => $this->getTimestamp() ? $this->getTimestamp()->getTimestamp() : null,
            'image_url' => $this->getImageUrl(),
            'thumb_url' => $this->getThumbUrl(),
            'title' => $this->getTitle(),
            'title_link' => $this->getTitleLink(),
            'author_name' => $this->getAuthorName(),
            'author_link' => $this->getAuthorLink(),
            'author_icon' => $this->getAuthorIcon(),
        ];

        $data['fields'] = $this->getFieldsAsArrays();
        $data['actions'] = $this->getActionsAsArrays();

        return $data;
    }

    protected function getFieldsAsArrays()
    {
        $fields = [];

        foreach ($this->getFields() as $field) {
            $fields[] = $field->toArray();
        }

        return $fields;
    }

    protected function getActionsAsArrays()
    {
        $actions = [];

        foreach ($this->getActions() as $action) {
            $actions[] = $action->toArray();
        }

        return $actions;
    }
}