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

    public function getHtml($isAdmin = false): string
    {
        $html = "<div class='movie-present'>
                    <div class='movie-present-head'>
                        <div class = 'movie-present-poster'>
                            <img class='editable' data-type='img' data-attribute='image_path' src='" . $GLOBALS['POSTER_DIR'] . $this->image_path . "' alt='Affiche de " . $this->title . "'>
                        </div>
                        <div class='movie-present-info'>
                            <h1 class='editable' data-type='text' data-attribute='title'>" . $this->title . "</h1>
                            <div class='movie-present-details'>
                                <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['movie-release-date'] . ":</strong></p><p class='editable' data-type='date' data-attribute='release_date'>" . $this->release_date . "</p></div>
                                <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['movie-time-duration'] . ":</strong></p><p class='editable' data-type='number' data-attribute='time_duration'>" . $this->time_duration . " " . $GLOBALS['movie-minutes'] . "</p></div>
                                <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['movie-rating'] . ":</strong></p><p class='editable' data-type='select' data-attribute='rating'>" . ($this->rating <= 1 ? $GLOBALS['movie-rating-1'] : $this->rating . " " . $GLOBALS['movie-rating-2']) . "</p></div>
                                <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['movie-note'] . ":</strong></p><p class='editable' data-type='number' data-attribute='note'>" . $this->note . "</p><p>" . $GLOBALS['movie-max-note'] . "</p></div>
                                <div class='movie-present-checkbox'>
                                    <label class='form-check-label' for='seen'><strong>" . $GLOBALS['movie-vu'] . ": </strong></label>
                                    <input class='form-check-input' type='checkbox' name='seen' id='seen' " . ($this->vu ? 'checked' : '') . " disabled>
                                    <button class='btn btn-outline-secondary btn-sm' id='edit-vu'>" . $GLOBALS['movie-edit-vu'] . "</button>
                                </div>
                                <div class='movie-present-checkbox'>
                                    <label class='form-check-label' for='favorite'><strong>" . $GLOBALS['movie-favorite'] . ": </strong></label>
                                    <input class='form-check-input' type='checkbox' name='favorite' id='favorite' " . ($this->favorite ? 'checked' : '') . " disabled>
                                    <button class='btn btn-outline-secondary btn-sm' id='edit-favorite'>" . $GLOBALS['movie-edit-vu'] . "</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='movie-present-trailer'>
                        <iframe src='" . $this->trailer_path . "' title='YouTube video player' allow='clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                    </div>
                    <div class='movie-present-synopsis'>
                        <h3>" . $GLOBALS['movie-synopsis'] . "</h3>
                        <p class='editable' data-type='textarea' data-attribute='synopsis'>" . $this->synopsis . "</p>
                    </div>
                </div>
            
                <script>
                    //TODO: duplicate code
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
                    
                    document.getElementById('edit-favorite').addEventListener('click', function() 
                    {
                        if (document.getElementById('favorite').disabled === false) {
                            document.getElementById('favorite').disabled = true;
                            document.getElementById('edit-favorite').innerText = '" . $GLOBALS['movie-edit-vu'] . "';
                            saveFavorite();
                        } else {
                            document.getElementById('favorite').disabled = false;
                            document.getElementById('edit-favorite').innerText = '" . $GLOBALS['movie-save-vu'] . "';
                        }
                    });
                    
                    function saveVu()
                    {
                        fetch('../api/set-seen-favorite.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: new URLSearchParams({ 'id': '" . $this->id . "', 'seen': document.getElementById('seen').checked.toString() }) })
                            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                            .then(data => { if (data.success) { set_user_msg(data.data, 'success', document.querySelector('movie-present')); } else { set_user_msg(data.error, 'danger', document.querySelector('movie-present')); } })
                            .catch(error => { set_user_msg(error, 'danger', document.querySelector('movie-present')); });
                    }
                    
                    function saveFavorite()
                    {
                        fetch('../api/set-seen-favorite.php', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' },  body: new URLSearchParams({ 'id': '" . $this->id . "', 'favorite': document.getElementById('favorite').checked.toString() }) })
                        .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                        .then(data => { if (data.success) { set_user_msg(data.data, 'success', document.querySelector('movie-present')); } else { set_user_msg(data.error, 'danger', document.querySelector('movie-present')); } })
                        .catch(error => { set_user_msg(error, 'danger', document.querySelector('movie-present')); });
                    }
                </script>";

        if ($isAdmin) { $html .= EditableObject::getHtml($this->id, 'movie'); }
        return $html;
    }

    public function getHtml_list(): string
    {
        return "<li class = 'card' style='cursor: pointer;' id='" . $this->id . "'>" . $this->title . " (" . $this->release_date . ") : " . substr($this->synopsis, 0, 75) . "...</li>" .
            "<script>
                document.getElementById('" . $this->id . "').addEventListener('click', function() { window.location.href = 'movie.php?id=" . $this->id . "&title=" . $this->title . "'; });
            </script>";
    }

    public function get_json(): array
    {
        try {$personDB = new PersonDB();}
        catch (\Exception $e) {return ['error' => $e->getMessage()];}
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
            'release_date' => $this->release_date,
            'time_duration' => $this->time_duration,
            'note' => $this->note,
            'rating' => $this->rating,
            'trailer_path' => $this->trailer_path,
            'image_path' => $GLOBALS['POSTER_DIR'] . $this->image_path,
            'synopsis' => $this->synopsis,
            'directors' => $json_directors,
            'actors' => $json_actors,
            'composers' => $json_composers,
            'tags' => $tags,
            'vu' => $this->vu
        ];
    }
}