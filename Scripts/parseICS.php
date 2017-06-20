<?php
include 'ICal.php';
include 'Event.php';
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
define('DATE_TIME_FORMAT', 'Y-m-d H:i:s T');

use ICal\ICal;

try {
    $ical = new ICal('KursKurt.ics', array(
        'defaultSpan'           => 2,     // Default value
        'defaultTimeZone'       => 'UTC',
        'defaultWeekStart'      => 'MO',  // Default value
        'skipRecurrence'        => false, // Default value
        'useTimeZoneWithRRules' => false, // Default value
    ));
    // $ical->initFile('ICal.ics');
    // $ical->initUrl('https://raw.githubusercontent.com/u01jmg3/ics-parser/master/examples/ICal.ics');
} catch (\Exception $e) {
    die($e);
}

$forceTimeZone = false;

//All events in file
$events = $ical->events();
//Get all end times and titles
$eventEndTimes = [];
$eventTitles = [];
$eventTimeAndTitle = [];

foreach ($events as $event) :
  $eventEndTimes[] = $ical->iCalDateToDateTime($event->dtend_array[3], $forceTimeZone)->format(DATE_TIME_FORMAT);
  $eventTitles[] = $event->summary;
endforeach;

foreach (array_combine($eventTitles, $eventEndTimes) as $title => $endTime){
  $eventTimeAndTitle[] = array('title' => $title, 'endTime' => $endTime);
}
echo json_encode($eventTimeAndTitle);


?>
