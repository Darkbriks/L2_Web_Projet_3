<?php

namespace mdb\data_template;

class Movie
{
    public function getHtml()
    {
        return "<div class='movie'>" .
                    "<h3>" . $this->title . " (" . $this->release_date . ")</h3>" .
                    "<p>" . $this->synopsis . "</p>" .
                    "<p>" . $this->vu . "</p>" .
                "</div>";
    }
}