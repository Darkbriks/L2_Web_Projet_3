<?php

namespace mdb\form;

use Exception;
use mdb\TagDB;

class GenerateFormInput
{
    public static function generateAdvancedSearchInput($fieldName, $fieldOperatorValues, $useInput = true): string
    {
        $html = '<div class="input-group mb-3">';
        $html .= '<label class="input-group-text" for="filter-' . $fieldName . '">' . $fieldName . '</label>';
        $html .= '<select class="form-select" id="operator-' . $fieldName . '" name="operator-' . $fieldName . '">';
        $html .= '<option value="null">--</option>';
        foreach ($fieldOperatorValues as $key => $value) { $html .= '<option value="' . $key . '">' . $value . '</option>'; }
        $html .= '</select>';
        if ($useInput) { $html .= '<input type="text" class="form-control" id="filter-' . $fieldName . '" name="filter-' . $fieldName . '" placeholder="Type to search...">'; }
        $html .= '</div>';
        return $html;
    }

    public static function generateAdvancedSearchPersonInput($fieldName): string
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
        $html .= '</div>';
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

    public static function generateCategoryList($categories = null): string
    {
        if ($categories === null)
        {
            try { $tagDB = new TagDB(); $categories = $tagDB->getTags(); }
            catch (Exception $e) { return $e->getMessage(); }
        }
        $html = "<div id='category'>";
        foreach ($categories as $category)
        {
            $html .= "<div class='form-check'>";
            $html .= "<input class='form-check-input' type='checkbox' name='category[]' id='category_" . $category->getId() . "' value='" . $category->getId() . "'>";
            $html .= "<label class='form-check-label' for='category_" . $category->getId() . "'>" . $category->getName() . "</label>";
            $html .= "</div>";
        }
        $html .= "</div>";
        return $html;
    }

    public static function generateTextInput($fieldName, $fieldLabel, $fieldValue = null, $required = false, $fieldDisabled = false): string
    {
        $html = '<div class="form-floating mb-3">';
        $html .= '<input type="text" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $fieldValue . '" placeholder="' . $fieldLabel . '" ' . ($fieldDisabled ? 'disabled' : '') . ($required ? 'required' : '') . '>';
        $html .= '<label for="' . $fieldName . '" class="form-label">' . $fieldLabel . '</label>';
        $html .= '</div>';
        return $html;
    }

    public static function generateTextareaInput($fieldName, $fieldLabel, $fieldValue = null, $fieldPlaceholder = null, $fieldDisabled = false): string
    {
        $html = '<div class="mb-3">';
        $html .= '<label for="' . $fieldName . '" class="form-label">' . $fieldLabel . '</label>';
        $html .= '<textarea class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" placeholder="' . $fieldPlaceholder . '" ' . ($fieldDisabled ? 'disabled' : '') . '>' . $fieldValue . '</textarea>';
        $html .= '</div>';
        return $html;
    }

    public static function generateDateInput($fieldName, $fieldLabel, $fieldValue = null, $required = false, $fieldDisabled = false): string
    {
        $html = '<div class="form-floating mb-3">';
        $html .= '<input type="date" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $fieldValue . '" ' . ($fieldDisabled ? 'disabled' : '') . ($required ? 'required' : '') . '>';
        $html .= '<label for="' . $fieldName . '" class="form-label">' . $fieldLabel . '</label>';
        $html .= '</div>';
        return $html;
    }

    public static function generateNumberInput($fieldName, $fieldLabel, $fieldValue = null, $fieldPlaceholder = null, $fieldDisabled = false): string
    {
        $html = '<div class="mb-3">';
        $html .= '<label for="' . $fieldName . '" class="form-label">' . $fieldLabel . '</label>';
        $html .= '<input type="number" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $fieldValue . '" placeholder="' . $fieldPlaceholder . '" ' . ($fieldDisabled ? 'disabled' : '') . '>';
        $html .= '</div>';
        return $html;
    }

    public static function generateSelectInput($fieldName, $fieldLabel, $fieldOptions, $fieldSelected = null, $fieldDisabled = false): string
    {
        $html = '<div class="mb-3">';
        $html .= '<label for="' . $fieldName . '" class="form-label">' . $fieldLabel . '</label>';
        $html .= '<select class="form-select" id="' . $fieldName . '" name="' . $fieldName . '" ' . ($fieldDisabled ? 'disabled' : '') . '>';
        foreach ($fieldOptions as $key => $value) { $html .= '<option value="' . $key . '" ' . ($fieldSelected == $key ? 'selected' : '') . '>' . $value . '</option>'; }
        $html .= '</select>';
        $html .= '</div>';
        return $html;
    }

    public static function generateFileInput($fieldName, $fieldLabel, $fieldDisabled = false): string
    {
        $html = '<div class="mb-3">';
        $html .= '<label for="' . $fieldName . '" class="form-label">' . $fieldLabel . '</label>';
        $html .= '<input type="file" class="form-control" id="' . $fieldName . '" name="' . $fieldName . '" ' . ($fieldDisabled ? 'disabled' : '') . '>';
        $html .= '</div>';
        return $html;
    }

    public static function generateAddPersonCard($name): string
    {
        return "<div class='add-person-card' id='add-card-{$name}'>
                    <i class='bi bi-plus-square' id='{$name}' style='cursor: pointer;'></i>
                </div>";
    }
}