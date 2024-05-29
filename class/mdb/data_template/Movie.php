<?php

namespace mdb\data_template;

class Movie
{
    public $title;
    public $release_date;
    public $synopsis;
    public $poster_link;
    public $producer;
    public $actors;
    public $tags;

    public function getHtml()
    {
        $actorsList = implode(', ', $this->actors);
        $tagsList = implode(', ', $this->tags);
        $vu = $this->vu ? "Vu" : "Non vu";

        return "<div class = 'card'>
                    <dic class = 'poster'>
                        <img src='{$this->poster_link}' alt='Affiche de {$this->title}'>
                    </div>
                    <div class='movie-info'>
                        <h3>{$this->title} ({$this->release_date})</h3>
                        <p class='movie-synopsis'>{$this->synopsis}</p>
                        <p class='movie-producer'><strong>Réalisateur :</strong> {$this->producer}</p>
                        <p class='movie-actors'><strong>Acteurs :</strong> {$actorsList}</p>
                        <p class='movie-tags'><strong>Tags :</strong> {$tagsList}</p>
                        <p class='movie-status'><strong>Status :</strong> {$vu}</p>
                    </div>
                </div>
               ";
    }
}