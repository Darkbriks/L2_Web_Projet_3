<?php

namespace mdb\form;

class GenerateFormInput
{
    public static function generateAdvancedSearchInput($fieldName, $fieldOperatorValues): string
    {
        $html = '<div class="input-group mb-3">';
        $html .= '<label class="input-group-text" for="filter-' . $fieldName . '">' . $fieldName . '</label>';
        $html .= '<select class="form-select" id="operator-' . $fieldName . '" name="operator-' . $fieldName . '">';
        $html .= '<option value="null">--</option>';
        foreach ($fieldOperatorValues as $key => $value) { $html .= '<option value="' . $key . '">' . $value . '</option>'; }
        $html .= '</select>';
        $html .= '<input type="text" class="form-control" id="filter-' . $fieldName . '" name="filter-' . $fieldName . '">';
        $html .= '</div>';
        return $html;
    }

    private static function generateAdvancedSearchPersonInput($fieldName): string
    {
        $html = '<div class="mb-3">';
        $html .= '<p>' . $fieldName . '</p>';
        $html .= '<div class="input-group mb-3">';
        $html .= '<label class="input-group-text" for="filter-' . $fieldName . '">Name</label>';
        $html .= '<select class="form-select" id="operator-' . $fieldName . '" name="operator-' . $fieldName . '">';
        $html .= '<option value="AND">AND</option>';
        $html .= '<option value="OR">OR</option>';
        $html .= '</select>';
        $html .= '</div>';
        $html .= '<div id="' . $fieldName . 'List"></div>';
        $html .= '<div class="form-floating mb-3">';
        $html .= '<input class="form-control" list="datalist-' . $fieldName . '" id="' . $fieldName . 'DataList" name="' . $fieldName . 'DataList" placeholder="Type to search...">';
        $html .= '<label class="form-label" for="filter-' . $fieldName . '">Type to search...</label>';
        $html .= '</div>';
        $html .= '<div class="list-group" id="' . $fieldName . 'DatalistOptions"></div>';
        $html .= "<script>";
        $html .= "document.getElementById('" . $fieldName . "DataList').addEventListener('input', function() {";
        $html .= "let input = document.getElementById('" . $fieldName . "DataList').value;";
        $html .= "if (input.length > 0) { updateOptionList('" . $fieldName . "', input); }";
        $html .= "else { clearDatalistOptions('" . $fieldName . "'); }";
        $html .= "});";
        $html .= "</script>";
        return $html;
    }

    public static function generateAdvancedSearchPersonFields(): string
    {
        $html = self::generateAdvancedSearchPersonInput('director');
        $html .= self::generateAdvancedSearchPersonInput('actor');
        $html .= self::generateAdvancedSearchPersonInput('composer');
        return $html;
    }
}