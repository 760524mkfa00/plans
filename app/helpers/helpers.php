<?php

use Illuminate\Support\HtmlString;


function sort_parts_by($column, $body)
{

    $direction = (\Request::get('direction') == 'asc') ? 'desc' : 'asc';
    $search = \Request::get('search');
    return link_to_route('parts', $body, ['sortBy' => $column, 'direction' => $direction, 'search' => $search]);

}

function display_button($status)
{
    return ($status == 'completed') ? 'display:inline-block' : 'display:none';
}

/**
 * @param $name
 * @param array $list
 * @param $data
 * @param array $options
 * @return HtmlString
 *
 * Form helper that builds a drop down list of items, stops the need for the for each loop within the form.
 *
 * I could potentially use the form builder to check for an old value.
 */

function dropDownHelper($name, $list = [], $data, $options = [])
{

    foreach ($list as $value => $display) {

        if($data == $value && ! is_null($data)) {
            $html[] = "<option value='{$value}' selected>" . $display . "</option>";
        } else {
            $html[] = "<option value='{$value}'>" . $display . "</option>";
        }

    }

    $options = attributes($options);

    $list = implode('', $html);

    return new HtmlString("<select name='{$name}' {$options}>{$list}</select>");

}

/**
 * @param $options
 * @return string
 *
 * Take an array of data and converts it into a string, useful for drop down options
 *
 */

function attributes($options)
{
    $options = implode(', ', array_map(
        function ($v, $k) { return sprintf("%s='%s'", $k, $v); },
        $options,
        array_keys($options)
    ));

    $options = strtr($options, array(',' => ''));

    return urldecode($options);
}

/**
 * @return array
 *
 * Creates a list of mondays starting with the current week
 */

function mondays()
{
    $format = '%Y-%m-%d';
    $mondays = [];
    $time = strtotime('monday last week');

    for($i = 1; $i <= 12; $i++) {
        $mondays[strftime($format, strtotime("+7 day", $time))] = strftime($format, strtotime("+7 day", $time));
        $time = strtotime("+7 day", $time);
    }

    return $mondays;
}