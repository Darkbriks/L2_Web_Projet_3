<?php
namespace mdb\data_template;
use mdb\PersonDB;

class Person
{
    // Getters
    public function getId() { return $this->id; }
    public function getFirstName() { return $this->first_name; }
    public function getLastName() { return $this->last_name; }
    public function getBirthDate() { return $this->birth_date; }
    public function getDeathDate() { return $this->death_date; }
    public function getImagePath() { return $this->image_path; }


    // Méthode pour générer le HTML en fonction du type
    public function getHtml($lang): string
    {
        $deathDate = $this->death_date ? $this->death_date : 'Still Alive';
        return "<div class='person'>
             <img src='" . $GLOBALS['PEOPLES_DIR'] . $this->image_path . "' alt='{$this->first_name} {$this->last_name}'>
             <div class = person-details>
             <h3>{$this->first_name} {$this->last_name}</h3>
             <p><strong>First Name:</strong> {$this->first_name}</p>
             <p><strong>Last Name:</strong> {$this->last_name}</p>
             <p><strong>Birth Date:</strong> {$this->birth_date}</p>
             <p><strong>Death Date:</strong> {$deathDate}</p></div></div>";
    }



    /*public function getHtml_Actor(): string
    {
        return "<div class='actor'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>{$this->first_name} {$this->last_name} as {$this->played_name}</h3>
                </div>";
    }

    public function getHtml_Director(): string
    {
        return "<div class='director'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>Directed by: {$this->first_name} {$this->last_name}</h3>
                </div>";
    }

    public function getHtml_Composer(): string
    {
        return "<div class='composer'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>Music by: {$this->first_name} {$this->last_name}</h3>
                </div>";
    }*/

    public function getHtml_list(bool $played_name = false): string
    {
        $html = "<li class='card' style='cursor: pointer;' id='{$this->id}'>
                    {$this->first_name} {$this->last_name} ({$this->birth_date} / " . ($this->death_date ?? 'still alive') . ")";
        if ($played_name && $this->played_name !== null) {
            $html .= " : {$this->played_name}";
        }
        $html .= "</li>
        <script>
            document.getElementById('{$this->id}').addEventListener('click', function() {
                window.location.href = 'person.php?id={$this->id}&fullName={$this->first_name} {$this->last_name}';
            });
        </script>";
        return $html;
    }

    public function getHtml_card(bool $played_name, bool $canEdit, int $movieId): string
    {
        $html = "<div class='person-card' id='card-{$this->id}'>
                    <img id='{$this->id}' src='" . $GLOBALS['PEOPLES_DIR'] . $this->image_path . "' alt='{$this->first_name} {$this->last_name}' style='cursor: pointer;'>
                    <h3>{$this->first_name} {$this->last_name}</h3>
                    " . ($played_name && $this->played_name !== null ? "<p>{$this->played_name}</p>" : '');
        if ($canEdit)
        {
            $html .= "<button class='btn btn-primary' id='remove-{$this->id}'>Remove</button>";
        }
        $html .= "</div>
                <script>document.getElementById('{$this->id}').addEventListener('click', function() { window.location.href = 'person.php?id={$this->id}'; });</script>";
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
                            .then(data => { if (data.success) { document.getElementById('card-{$this->id}').remove(); } else { alert(data.error); } })
                            .catch(error => { alert(error); });
                        });
                    </script>";
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

