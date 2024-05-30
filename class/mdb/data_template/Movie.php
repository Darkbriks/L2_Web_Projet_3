<?php

namespace mdb\data_template;

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
                    <div class = 'poster'>
                        <img src='" . $this->image_path . "' alt='Affiche de " . $this->title . "'>
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
}