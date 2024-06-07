<?php
namespace mdb\data_template;
use mdb\PersonDB;

class Person
{
    public function getId() { return $this->id; }
    public function getFirstName() { return $this->first_name; }
    public function getLastName() { return $this->last_name; }
    public function getBirthDate() { return $this->birth_date; }
    public function getDeathDate() { return $this->death_date; }
    public function getImagePath() { return $this->image_path; }

    // TODO: localization
    public function getHtml($isAdmin = false): string
    {
        $deathDate = ($this->death_date ?? $GLOBALS['still-alive']);
        $html = "<div class='person'>
                    <img class='editable' data-type='img' data-attribute='image_path' src='" . $GLOBALS['PEOPLES_DIR'] . $this->image_path . "' alt='{$this->first_name} {$this->last_name}'>
                     <div class = person-details>
                         <h3 id='full_name'>{$this->first_name} {$this->last_name}</h3>
                         <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['person-first-name'] . ":</strong></p><p class='editable' data-type='text' data-attribute='first_name'>" . $this->first_name . "</p></div>
                         <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['person-last-name'] . ":</strong></p><p class='editable' data-type='text' data-attribute='last_name'>" . $this->last_name . "</p></div>
                         <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['person-birth-date'] . ":</strong></p><p class='editable' data-type='date' data-attribute='birth_date'>" . $this->birth_date . "</p></div>
                         <div style='display: flex; gap: 10px'><p><strong>" . $GLOBALS['person-death-date'] . ":</strong></p><p class='editable' data-type='date' data-attribute='death_date'>" . $deathDate . "</p></div>
                    </div>
                </div>";
        if ($isAdmin) { $html .= EditableObject::getHtml($this->id, 'person'); }
        return $html;
    }

    public function getHtml_list(bool $played_name = false): string
    {
        $html = "<li class='card' style='cursor: pointer;' id='{$this->id}'>{$this->first_name} {$this->last_name} ({$this->birth_date} / " . ($this->death_date ?? $GLOBALS['still-alive']) . ")";
        if ($played_name && $this->played_name !== null) { $html .= " : {$this->played_name}"; }
        $html .= "</li>
        <script> document.getElementById('{$this->id}').addEventListener('click', function() { window.location.href = 'person.php?id={$this->id}&fullName={$this->first_name} {$this->last_name}'; }); </script>";
        return $html;
    }

    public function getHtml_card(bool $canEdit, int $movieId): string
    {
        $html = "<div class='person-card' id='card-{$this->id}'>
                    <img id='{$this->id}' src='" . $GLOBALS['PEOPLES_DIR'] . $this->image_path . "' alt='{$this->first_name} {$this->last_name}' style='cursor: pointer;'>
                    <h3>{$this->first_name} {$this->last_name}</h3>";
        if (!$canEdit && isset($this->played_name)) { $html .= "<p>{$this->played_name}</p>"; }
        if ($canEdit)
        {
            if (isset($this->played_name))
            {
                $html .= '<div class="input-group input-group-sm mb-3">';
                $html .= "<input type='text' id='role-{$this->id}' placeholder='Role' class='form-control' style='margin-bottom: 5px;' value='{$this->played_name}'>";
                $html .= "<button type='button' class='btn btn-outline-secondary' id='update-{$this->id}'>Update</button>";
                $html .= '</div>';
            }
            $html .= "<button class='btn btn-primary  btn-sm' id='remove-{$this->id}'>Remove</button>";
        }
        $html .= "</div><script>document.getElementById('{$this->id}').addEventListener('click', function() { window.location.href = 'person.php?id={$this->id}'; });</script>";
        if ($canEdit)
        {
            $html .= "<script>
                        document.getElementById('remove-{$this->id}').addEventListener('click', function()
                        {
                            fetch('../api/set-movie-person-link.php', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                body: 'removeLink=true&movieId={$movieId}&personId={$this->id}'
                            })
                            .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                            .then(data => { if (data.success) { document.getElementById('card-{$this->id}').remove(); } else { set_msg(data.error, 'warning'); } })
                            .catch(error => { set_msg(error, 'danger'); });
                        });
                    </script>";
            if (isset($this->played_name))
            {
                $html .= "<script>
                            document.getElementById('update-{$this->id}').addEventListener('click', function()
                            {
                                let role = document.getElementById('role-{$this->id}').value;
                                fetch('../api/set-movie-person-link.php', {
                                    method: 'POST',
                                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                                    body: 'updateLink=true&movieId={$movieId}&personId={$this->id}&role=' + role
                                })
                                .then(response => { if (!response.ok) { throw new Error('Erreur HTTP ! statut: ' + response.status); } return response.json(); })
                                .then(data => { if (data.success) { set_msg('Role updated', 'success'); } else { set_msg(data.error, 'warning'); } })
                                .catch(error => { set_msg(error, 'danger'); });
                            });
                        </script>";
            }
        }
        return $html;
    }

    public function get_json()
    {
        return [
            'id' => $this->id,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'image_path' => $GLOBALS['PEOPLES_DIR'] . $this->image_path
        ];
    }
}