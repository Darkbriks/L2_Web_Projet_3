<?php

namespace mdb\data_template;

class Person
{
    // Getters
    public function getId() { return $this->id; }
    public function getFirstName() { return $this->first_name; }
    public function getLastName() { return $this->last_name; }
    public function getBirthDate() { return $this->birth_date; }
    public function getDeathDate() { return $this->death_date; }
    public function getImagePath() { return $this->image_path; }
    public function getPlayedName() { return $this->played_name; }
    public function getType() { return $this->type; }

    // Méthode pour générer le HTML en fonction du type
    public function getHtml_Person()
    {
        switch ($this->type) {
            case 1:
                return $this->getHtml_Actor();
            case 2:
                return $this->getHtml_Director();
            case 3:
                return $this->getHtml_Composer();
            default:
                return "<div class='person'>
                    <p>{$this->first_name} {$this->last_name} ({$this->birth_date} / " . ($this->death_date ?? 'still alive') . ")</p>
                </div>";
        }
    }

    public function getHtml_Actor()
    {
        return "<div class='actor'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>{$this->first_name} {$this->last_name} as {$this->played_name}</h3>
                </div>";
    }

    public function getHtml_Director()
    {
        return "<div class='director'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>Directed by: {$this->first_name} {$this->last_name}</h3>
                </div>";
    }

    public function getHtml_Composer()
    {
        return "<div class='composer'>
                    <img src='{$this->image_path}' alt='{$this->first_name} {$this->last_name}'>
                    <h3>Music by: {$this->first_name} {$this->last_name}</h3>
                </div>";
    }

    public function getHtml_list(bool $played_name = false)
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

    public function get_json()
    {
        return [
            'id' => $this->id,
            'full_name' => $this->first_name . ' ' . $this->last_name,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'birth_date' => $this->birth_date,
            'death_date' => $this->death_date,
            'image_path' => $this->image_path,
            'played_name' => $this->played_name,
            'type' => $this->type
        ];
    }
}

