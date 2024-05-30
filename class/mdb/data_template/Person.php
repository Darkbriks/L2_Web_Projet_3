<?php

namespace mdb\data_template;

class Person
{
    public function getHtml_Actor()
    {
        return "<div class='actor'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>{$this->first_name} {$this->last_name} as {$this->played_name}</h3>
                </div>";
    }

    public function getHtml_Director()
    {
        return "<div class='director'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>Directed by: {$this->first_name} {$this->last_name}</h3>
                </div>";
    }

    public function getHtml_Composer()
    {
        return "<div class='composer'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>Music by: {$this->first_name} {$this->last_name}</h3>
                </div>";
    }
}
