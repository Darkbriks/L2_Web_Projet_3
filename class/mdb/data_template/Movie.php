<?php

namespace mdb\data_template;

use mdb\PersonDB;
use mdb\TagDB;

class Movie
{
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getReleaseDate() { return $this->release_date; }
    public function getSynopsis() { return $this->synopsis; }
    public function getVu() { return $this->vu; }
    public function getImagePath() { return $this->image_path; }
    public function getTimeDuration() { return $this->time_duration; }
    public function getNote() { return $this->note; }
    public function getTrailerPath() { return $this->trailer_path; }
    public function getRating() { return $this->rating; }

    public function getHtml()
    {
        return "<div class = 'card'>
                    <div class = 'posters'>
                        <img src='" . $GLOBALS['POSTER_DIR'] . $this->image_path . "' alt='Affiche de " . $this->title . "'>
                    </div>
                    <div class='movie-info'>
                        <h3>" . $this->title . " (" . $this->release_date . ")</h3>
                        <p class='movie-synopsis'>" . $this->synopsis . "</p>
                        <p class='movie-status'><strong>Status :</strong>" . $this->vu . "</p>
                    </div>
                </div>";
    }

    public function getHtml_list()
    {
        return "<li class = 'card' style='cursor: pointer;' id='" . $this->id . "'>" . $this->title . " (" . $this->release_date . ") : " . substr($this->synopsis, 0, 75) . "...</li>" .
            "<script>
                document.getElementById('" . $this->id . "').addEventListener('click', function() { window.location.href = 'movie.php?id=" . $this->id . "&title=" . $this->title . "'; });
            </script>";
    }

    public function get_movieCard()
    {
        $personDB = new PersonDB();
        $directors = $personDB->getDirectorsOfMovie($this->id);
        $actors = $personDB->getActorsOfMovie($this->id);
        $composers = $personDB->getComposersOfMovie($this->id);

        $tags = (new TagDB())->getTagsOfMovie($this->id);
        $tags = array_map(function($tag) { return $tag->getName(); }, $tags);

        //Return an array with the movie's details
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_path' => $GLOBALS['POSTER_DIR'] . $this->image_path,
            'release_date' => $this->release_date,
            'synopsis' => $this->synopsis,
            'directors' => $directors,
            'actors' => $actors,
            'composers' => $composers,
            'tags' => $tags,
            'vu' => $this->vu
        ];
    }
}