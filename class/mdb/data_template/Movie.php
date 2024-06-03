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
        return "<div class='movie-present'>
                    <div class='movie-present-head'>
                        <div class = 'movie-present-poster'>
                            <img src='" . $GLOBALS['POSTER_DIR'] . $this->image_path . "' alt='Affiche de " . $this->title . "'>
                        </div>
                        <div class='movie-present-info'>
                            <h1>" . $this->title . "</h1>
                            <div class='movie-present-details'>
                                <p><strong>" . $GLOBALS['movie-release-date'] . ":</strong> " . $this->release_date . "</p>
                                <p><strong>" . $GLOBALS['movie-time-duration'] . ":</strong> " . $this->time_duration . "</p>
                                <p><strong>" . $GLOBALS['movie-rating'] . ":</strong> " . $this->rating . "</p>
                                <p><strong>" . $GLOBALS['movie-note'] . ":</strong> " . $this->note . "</p>    
                            </div>
                        </div>
                    </div>
                    <div class='movie-present-trailer'>
                        <!-- le trailer est un lien vers la vidéo youtube, viméo, etc. -->
                        <iframe width='560' height='315' src='" . $this->trailer_path . "' title='Trailer de " . $this->title . "'></iframe>
                    <div class='movie-present-synopsis'>
                        <h3>" . $GLOBALS['movie-synopsis'] . "</h3>
                        <p>" . $this->synopsis . "</p>
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

    public function get_json()
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