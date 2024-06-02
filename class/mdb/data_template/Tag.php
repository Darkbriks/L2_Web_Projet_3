<?php

namespace mdb\data_template;

class Tag
{
    public function getId() { return $this->id; }
    public function getName() { return $this->name; }

    public function getHtml_li(): string
    {
        return "<li><a class='dropdown-item tag' href='#' data-tag=" . $this->getId() . ">" . $this->getName() . "</a></li>";
    }

    public function get_json()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}