<?php

namespace mdb\data_template;

class Person
{
    public function getHtml_Person()//pas encore fonctionnel
    {
        if($this->type===1) { return $this->getHtml_Actor(); }
        else if($this->type===2) { return $this->getHtml_Realisator(); }
        else{
            return "<div class='person'>" .
                "<p>" . $this->first_name . " " . $this->last_name . " (" . $this->birth_date ." / still alive) </p>" .
                "</div>";
        }
    }
    public function getHtml_Actor()
    {
        $html = "<div class='movie_actor'><p>" . $this->first_name . " " . $this->last_name . " played : " . $this->played_name . " (" . $this->birth_date ." / ";
        if($this->death_date===null) { $html .= "still alive"; } else { $html .= $this->death_date; } $html .= ")</p></div>";
        return $html;
    }

    public function getHtml_Director()
    {
        $html = "<div class='movie_director'><p>" . $this->first_name . " " . $this->last_name . " (" . $this->birth_date ." / ";
        if($this->death_date===null) { $html .= "still alive"; } else { $html .= $this->death_date; } $html .= ")</p></div>";
        return $html;
    }

    public function getHtml_list(bool $played_name = false)
    {
        $html = "<li class = 'card' style='cursor: pointer;' id='" . $this->id . "'>" . $this->first_name . " " . $this->last_name . " (" . $this->birth_date . " / ";
        if($this->death_date===null) { $html .= "still alive)"; } else { $html .= $this->death_date . ")"; }
        if($played_name && $this->played_name !== null) { $html .= " : " . $this->played_name; } $html .= "</li>
        <script>document.getElementById('" . $this->id . "').addEventListener('click', function() { window.location.href = 'person.php?id=" . $this->id . "&fullName=" . $this->first_name . " " . $this->last_name . "'; });</script>";
        return $html;
    }
}