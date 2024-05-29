<?php

namespace mdb\data_template;

class Person
{
    public function getHtml_Person()//pas encore fonctionnel
    {
        if($this->type===1){
            $this->getHtml_Actor();
        }
        elseif($this->type===2){
            $this->getHtml_Realisator();
        }
        else{
            return "<div class='person'>" .
                "<p>" . $this->first_name . " " . $this->last_name . " (" . $this->birth_date ." / still alive) </p>" .
                "</div>";
        }
    }
    public function getHtml_Actor()
    {

        if($this->death_date===null){
            return "<div class='movie_actor'>" .
                //"<h1> Actor :</h1>" .
                "<p>" .$this->first_name . " " . $this->last_name ." played : " . $this->played_name . " (" . $this->birth_date. " / still alive) </p>" .
                "</div>";
        }
        else{
            return "<div class='movie_actor'>" .
                //"<h1> Actor :</h1>" .
                "<p>" .$this->first_name . " " . $this->last_name ." played : " . $this->played_name . " (" . $this->birth_date ." / ".$this->death_date. ") </p>" .
                "</div>";
        }
    }

    public function getHtml_Director()
    {
        if($this->death_date===null){
            return "<div class='movie_director '>" .
                //"<h1> Actor :</h1>" .
                "<p>" . $this->first_name . " " . $this->last_name . " (" . $this->birth_date ." / still alive) </p>" .
                "</div>";
        }
        else{
            return "<div class='movie_director'>" .
                //"<h1> Actor :</h1>" .
                "<p>" .$this->first_name . " " . $this->last_name . " (" . $this->birth_date ." / ".$this->death_date. ") </p>" .
                "</div>";
        }
    }
}