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
                                <p><strong>" . $GLOBALS['movie-time-duration'] . ":</strong> " . $this->time_duration . " " . $GLOBALS['movie-minutes'] . "</p>
                                <p><strong>" . $GLOBALS['movie-rating'] . ":</strong> " . ($this->rating === 1 ? $GLOBALS['movie-rating-1'] : $this->rating . " " . $GLOBALS['movie-rating-2']) . "</p>
                                <p><strong>" . $GLOBALS['movie-note'] . ":</strong> " . $this->note . $GLOBALS['movie-max-note'] . "</p>
                                <div class='movie-present-checkbox'>
                                    <label class='form-check-label' for='seen'><strong>" . $GLOBALS['movie-vu'] . ": </strong></label>
                                    <input class='form-check-input' type='checkbox' name='seen' id='seen' " . ($this->vu ? 'checked' : '') . " disabled>
                                    <button class='btn btn-outline-secondary btn-sm' id='edit-vu'>" . $GLOBALS['movie-edit-vu'] . "</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='movie-present-trailer'>
                        <iframe src='" . $this->trailer_path . "' title='YouTube video player' allow='clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                    </div>
                    <div class='movie-present-synopsis'>
                        <h3>" . $GLOBALS['movie-synopsis'] . "</h3>
                        <p>" . $this->synopsis . "</p>
                    </div>
                </div>
                <script>
                    document.getElementById('edit-vu').addEventListener('click', function()
                    {
                        if (document.getElementById('seen').disabled === false)
                        {
                            document.getElementById('seen').disabled = true;
                            document.getElementById('edit-vu').innerText = '" . $GLOBALS['movie-edit-vu'] . "';
                            saveVu();
                        }
                        else
                        {
                            document.getElementById('seen').disabled = false;
                            document.getElementById('edit-vu').innerText = '" . $GLOBALS['movie-save-vu'] . "';
                        }
                    });
                    
                    function saveVu()
                    {
                        fetch('../api/set-seen.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'id': '" . $this->id . "', 'seen': document.getElementById('seen').checked.toString() }) })
                            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                            .then(data => { if (data.success) { set_msg(data.data, 'success'); } else { set_msg(data.error, 'danger'); } })
                            .catch(error => { set_msg(error, 'danger'); });
                    }
                    
                    function set_msg(msg, type)
                    {
                        let movieContainer = document.querySelector('.movie-container');
                        let userMsg = document.createElement('div');
                        userMsg.classList.add('alert', 'alert-' + type);
                        userMsg.innerText = msg;
                        movieContainer.prepend(userMsg);
                        setTimeout(() => { userMsg.remove(); }, 5000);
                    }
                </script>
                ";
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

        $json_directors = json_encode(array_map(function($director) { return $director->get_json(); }, $directors));
        $json_actors = json_encode(array_map(function($actor) { return $actor->get_json(); }, $actors));
        $json_composers = json_encode(array_map(function($composer) { return $composer->get_json(); }, $composers));

        $tags = (new TagDB())->getTagsOfMovie($this->id);
        $tags = array_map(function($tag) { return $tag->getName(); }, $tags);

        //Return an array with the movie's details
        return [
            'id' => $this->id,
            'title' => $this->title,
            'image_path' => $GLOBALS['POSTER_DIR'] . $this->image_path,
            'release_date' => $this->release_date,
            'synopsis' => $this->synopsis,
            'directors' => $json_directors,
            'actors' => $json_actors,
            'composers' => $json_composers,
            'tags' => $tags,
            'vu' => $this->vu
        ];
    }
}