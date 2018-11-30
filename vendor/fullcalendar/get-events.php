<?php

//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timeZone" GET parameter will force all ISO8601 date stings to a given timeZone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timeZone, like "2013-12-29".
// Since no timeZone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timeZone parameter if it is present.
$timeZone = null;
if (isset($_GET['timeZone'])) {
  $timeZone = new DateTimeZone($_GET['timeZone']);
}

// Read and parse our events JSON file into an array of event data arrays.
$json = file_get_contents(dirname(__FILE__) . '/demos/json/events.json');
$input_arrays = json_decode($json, true);

//print_r($input_arrays);
// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

  // Convert the input array into a useful Event object
  $event = new Event($array, $timeZone);

  // If the event is in-bounds, add it to the output
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}

// Send JSON to the client.
echo '[{"title":"qweqwe","start":"2018-10-01","id":"1","url":"calendarios.php?opcion=1&dia=1"},{"title":"asf","start":"2018-10-10","id":"2","url":"calendarios.php?opcion=1&dia=2"},{"title":"aaaaaaaaaaaaaaaaaaaaaaaaaaaaa","start":"2018-10-15","id":"3","url":"calendarios.php?opcion=1&dia=3"},{"title":"12413","start":"2018-10-05","id":"4","url":"calendarios.php?opcion=1&dia=4"},{"title":"1241334","start":"2018-10-23","id":"5","url":"calendarios.php?opcion=1&dia=5"},{"title":"asdasda","start":"2018-10-29","id":"6","url":"calendarios.php?opcion=1&dia=6"},{"title":"asda","start":"2018-10-19","id":"7","url":"calendarios.php?opcion=1&dia=7"},{"title":"dwqdasd","start":"2018-10-08","id":"8","url":"calendarios.php?opcion=1&dia=8"},{"title":"aaa","start":"2018-10-02","id":"9","url":"calendarios.php?opcion=1&dia=9"},{"title":"333","start":"2018-10-08","id":"10","url":"calendarios.php?opcion=1&dia=10"},{"title":"eqweqwe","start":"2018-10-17","id":"11","url":"calendarios.php?opcion=1&dia=11"},{"title":"AL FIN MOTHERFUCKER!","start":"2018-11-03","id":"12","url":"calendarios.php?opcion=1&dia=12"},{"title":"a","start":"2018-11-02","id":"13","url":"calendarios.php?opcion=1&dia=13"},{"title":"a2","start":"2018-11-02","id":"14","url":"calendarios.php?opcion=1&dia=14"},{"title":"a3","start":"2018-11-02","id":"15","url":"calendarios.php?opcion=1&dia=15"},{"title":"849616516","start":"2018-11-08","id":"16","url":"calendarios.php?opcion=1&dia=16"}]';
//echo json_encode($output_arrays);
