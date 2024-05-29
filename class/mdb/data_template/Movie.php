<?php

namespace mdb\data_template;

class Movie
{
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