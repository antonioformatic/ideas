
<?php
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Gdata');
Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_HttpClient');
Zend_Loader::loadClass('Zend_Gdata_Calendar');
Zend_Loader::loadClass('Zend_Gdata_Photos');
Zend_Loader::loadClass('Zend_Gdata_Photos_UserQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_AlbumQuery');
Zend_Loader::loadClass('Zend_Gdata_Photos_PhotoQuery');
Zend_Loader::loadClass('Zend_Gdata_App_Extension_Category');

/**
 * @var string Location of AuthSub key file.  include_path is used to find this
 */
$_authSubKeyFile = null; // Example value for secure use: 'mykey.pem'

/**
 * @var string Passphrase for AuthSub key file.
 */
$_authSubKeyFilePassphrase = null;

/**
 * Returns the full URL of the current page, based upon env variables
 *
 * Env variables used:
 * $_SERVER['HTTPS'] = (on|off|)
 * $_SERVER['HTTP_HOST'] = value of the Host: header
 * $_SERVER['SERVER_PORT'] = port number (only used if not http/80,https/443)
 * $_SERVER['REQUEST_URI'] = the URI after the method of the HTTP request
 *
 * @return string Current URL
 */
function getCurrentUrl()
{
  global $_SERVER;

  /**
   * Filter php_self to avoid a security vulnerability.
   */
  $php_request_uri = htmlentities(substr($_SERVER['REQUEST_URI'], 0, strcspn($_SERVER['REQUEST_URI'], "\n\r")), ENT_QUOTES);

  if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
    $protocol = 'https://';
  } else {
    $protocol = 'http://';
  }
  $host = $_SERVER['HTTP_HOST'];
  if ($_SERVER['SERVER_PORT'] != '' &&
     (($protocol == 'http://' && $_SERVER['SERVER_PORT'] != '80') ||
     ($protocol == 'https://' && $_SERVER['SERVER_PORT'] != '443'))) {
    $port = ':' . $_SERVER['SERVER_PORT'];
  } else {
    $port = '';
  }
  return $protocol . $host . $port . $php_request_uri;
}

/**
 * Returns the AuthSub URL which the user must visit to authenticate requests
 * from this application.
 *
 * Uses getCurrentUrl() to get the next URL which the user will be redirected
 * to after successfully authenticating with the Google service.
 *
 * @return string AuthSub URL
 */
function getAuthSubUrlCalendar()
{
  global $_authSubKeyFile;
  $next = getCurrentUrl();
  $scope = 'http://www.google.com/calendar/feeds/';
  $session = true;
  if ($_authSubKeyFile != null) {
    $secure = true;
  } else {
    $secure = false;
  }
  return Zend_Gdata_AuthSub::getAuthSubTokenUri($next, $scope, $secure,
      $session);
}

/**
 * Outputs a request to the user to login to their Google account, including
 * a link to the AuthSub URL.
 *
 * Uses getAuthSubUrlCalendar() to get the URL which the user must visit to authenticate
 *
 * @return void
 */
function requestUserLogin($linkText)
{
  $authSubUrl = getAuthSubUrlCalendar();
  echo "<a href=\"{$authSubUrl}\">{$linkText}</a>";
}

/**
 * Returns a HTTP client object with the appropriate headers for communicating
 * with Google using AuthSub authentication.
 *
 * Uses the $_SESSION['sessionToken'] to store the AuthSub session token after
 * it is obtained.  The single use token supplied in the URL when redirected
 * after the user succesfully authenticated to Google is retrieved from the
 * $_GET['token'] variable.
 *
 * @return Zend_Http_Client
 */
function getAuthSubHttpClientData()
{
    global $_SESSION, $_GET;
    if (!isset($_SESSION['sessionToken']) && isset($_GET['token'])) {
        $_SESSION['sessionToken'] =
            Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token']);
    }
    $client = Zend_Gdata_AuthSub::getHttpClient($_SESSION['sessionToken']);
    return $client;
}
/**
 * Returns a HTTP client object with the appropriate headers for communicating
 * with Google using AuthSub authentication.
 *
 * Uses the $_SESSION['sessionToken'] to store the AuthSub session token after
 * it is obtained.  The single use token supplied in the URL when redirected
 * after the user succesfully authenticated to Google is retrieved from the
 * $_GET['token'] variable.
 *
 * @return Zend_Http_Client
 */
function getAuthSubHttpClientCalendar()
{
  global $_SESSION, $_GET, $_authSubKeyFile, $_authSubKeyFilePassphrase;
  $client = new Zend_Gdata_HttpClient();
  if ($_authSubKeyFile != null) {
    // set the AuthSub key
    $client->setAuthSubPrivateKeyFile($_authSubKeyFile, $_authSubKeyFilePassphrase, true);
  }
  if (!isset($_SESSION['sessionToken']) && isset($_GET['token'])) {
    $_SESSION['sessionToken'] =
        Zend_Gdata_AuthSub::getAuthSubSessionToken($_GET['token'], $client);
  }
  $client->setAuthSubToken($_SESSION['sessionToken']);
  return $client;
}

/**
 * Processes loading of this sample code through a web browser.  Uses AuthSub
 * authentication and outputs a list of a user's calendars if succesfully
 * authenticated.
 *
 * @return void
 */
//function processPageLoad()
//{
//  global $_SESSION, $_GET;
//  if (!isset($_SESSION['sessionToken']) && !isset($_GET['token'])) {
//    requestUserLogin('Please login to your Google Account.');
//  } else {
//    $client = getAuthSubHttpClientCalendar();
//    outputCalendarList($client);
//  }
//}

/**
 * Returns a HTTP client object with the appropriate headers for communicating
 * with Google using the ClientLogin credentials supplied.
 *
 * @param  string $user The username, in e-mail address format, to authenticate
 * @param  string $pass The password for the user specified
 * @return Zend_Http_Client
 */
function getClientLoginHttpClient($user, $pass)
{
  $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;

  $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
  return $client;
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing an event
 * in the user's calendar.  The calendar is retrieved using the magic cookie
 * which allows read-only access to private calendar data using a special token
 * available from within the Calendar UI.
 *
 * @param  string $user        The username or address of the calendar to be retrieved.
 * @param  string $magicCookie The magic cookie token
 * @return void
 */
function outputCalendarMagicCookie($user, $magicCookie)
{
  $gdataCal = new Zend_Gdata_Calendar();
  $query = $gdataCal->newEventQuery();
  $query->setUser($user);
  $query->setVisibility('private-' . $magicCookie);
  $query->setProjection('full');
  $eventFeed = $gdataCal->getCalendarEventFeed($query);
  echo "<ul>\n";
  foreach ($eventFeed as $event) {
    echo "\t<li>" . $event->title->text . "</li>\n";
    $sl = $event->getLink('self')->href;
  }
  echo "</ul>\n";
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing a
 * calendar in the authenticated user's calendar list.
 *
 * @param  Zend_Http_Client $client The authenticated client object
 * @return void
 */
function outputCalendarList($client)
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  $calFeed = $gdataCal->getCalendarListFeed();
  echo "<h1>" . $calFeed->title->text . "</h1>\n";
  echo "<ul>\n";
  foreach ($calFeed as $calendar) {
    echo "\t<li>" . $calendar->title->text . "</li>\n";
  }
  echo "</ul>\n";
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing an
 * event on the authenticated user's calendar.  Includes the start time and
 * event ID in the output.  Events are ordered by starttime and include only
 * events occurring in the future.
 *
 * @param  Zend_Http_Client $client The authenticated client object
 * @return void
 */
function outputCalendar($client)
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setOrderby('starttime');
  $query->setFutureevents(true);
  $eventFeed = $gdataCal->getCalendarEventFeed($query);
  // option 2
  // $eventFeed = $gdataCal->getCalendarEventFeed($query->getQueryUrl());
  echo "<ul>\n";
  foreach ($eventFeed as $event) {
    echo "\t<li>" . $event->title->text .  " (" . $event->id->text . ")\n";
    // Zend_Gdata_App_Extensions_Title->__toString() is defined, so the
    // following will also work on PHP >= 5.2.0
    //echo "\t<li>" . $event->title .  " (" . $event->id . ")\n";
    echo "\t\t<ul>\n";
    foreach ($event->when as $when) {
      echo "\t\t\t<li>Starts: " . $when->startTime . "</li>\n";
    }
    echo "\t\t</ul>\n";
    echo "\t</li>\n";
  }
  echo "</ul>\n";
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing an
 * event on the authenticated user's calendar which occurs during the
 * specified date range.
 *
 * To query for all events occurring on 2006-12-24, you would query for
 * a startDate of '2006-12-24' and an endDate of '2006-12-25' as the upper
 * bound for date queries is exclusive.  See the 'query parameters reference':
 * http://code.google.com/apis/gdata/calendar.html#Parameters
 *
 * @param  Zend_Http_Client $client    The authenticated client object
 * @param  string           $startDate The start date in YYYY-MM-DD format
 * @param  string           $endDate   The end date in YYYY-MM-DD format
 * @return void
 */
function outputCalendarByDateRange($client, $startDate='2007-05-01',
                                   $endDate='2007-08-01')
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setOrderby('starttime');
  $query->setStartMin($startDate);
  $query->setStartMax($endDate);
  $eventFeed = $gdataCal->getCalendarEventFeed($query);
  echo "<ul>\n";
  foreach ($eventFeed as $event) {
    echo "\t<li>" . $event->title->text .  " (" . $event->id->text . ")\n";
    echo "\t\t<ul>\n";
    foreach ($event->when as $when) {
      echo "\t\t\t<li>Starts: " . $when->startTime . "</li>\n";
    }
    echo "\t\t</ul>\n";
    echo "\t</li>\n";
  }
  echo "</ul>\n";
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing an
 * event on the authenticated user's calendar which matches the search string
 * specified as the $fullTextQuery parameter
 *
 * @param  Zend_Http_Client $client        The authenticated client object
 * @param  string           $fullTextQuery The string for which you are searching
 * @return void
 */
function outputCalendarByFullTextQuery($client, $fullTextQuery='tennis')
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setQuery($fullTextQuery);
  $eventFeed = $gdataCal->getCalendarEventFeed($query);
  echo "<ul>\n";
  foreach ($eventFeed as $event) {
    echo "\t<li>" . $event->title->text .  " (" . $event->id->text . ")\n";
    echo "\t\t<ul>\n";
    foreach ($event->when as $when) {
      echo "\t\t\t<li>Starts: " . $when->startTime . "</li>\n";
      echo "\t\t</ul>\n";
      echo "\t</li>\n";
    }
  }
  echo "</ul>\n";
}

/**
 * Creates an event on the authenticated user's default calendar with the
 * specified event details.
 *
 * @param  Zend_Http_Client $client    The authenticated client object
 * @param  string           $title     The event title
 * @param  string           $desc      The detailed description of the event
 * @param  string           $where
 * @param  string           $startDate The start date of the event in YYYY-MM-DD format
 * @param  string           $startTime The start time of the event in HH:MM 24hr format
 * @param  string           $endDate   The end date of the event in YYYY-MM-DD format
 * @param  string           $endTime   The end time of the event in HH:MM 24hr format
 * @param  string           $tzOffset  The offset from GMT/UTC in [+-]DD format (eg -08)
 * @return string The ID URL for the event.
 */
function createEvent ($client, $title = 'Tennis with Beth',
    $desc='Meet for a quick lesson', $where = 'On the courts',
    $startDate = '2008-01-20', $startTime = '10:00',
    $endDate = '2008-01-20', $endTime = '11:00', $tzOffset = '-08')
{
  $gc = new Zend_Gdata_Calendar($client);
  $newEntry = $gc->newEventEntry();
  $newEntry->title = $gc->newTitle(trim($title));
  $newEntry->where  = array($gc->newWhere($where));

  $newEntry->content = $gc->newContent($desc);
  $newEntry->content->type = 'text';

  $when = $gc->newWhen();
  $when->startTime = "{$startDate}T{$startTime}:00.000{$tzOffset}:00";
  $when->endTime = "{$endDate}T{$endTime}:00.000{$tzOffset}:00";
  $newEntry->when = array($when);

  $createdEntry = $gc->insertEvent($newEntry);
  return $createdEntry->id->text;
}

/**
 * Creates an event on the authenticated user's default calendar using
 * the specified QuickAdd string.
 *
 * @param  Zend_Http_Client $client       The authenticated client object
 * @param  string           $quickAddText The QuickAdd text for the event
 * @return string The ID URL for the event
 */
function createQuickAddEvent ($client, $quickAddText) {
  $gdataCal = new Zend_Gdata_Calendar($client);
  $event = $gdataCal->newEventEntry();
  $event->content = $gdataCal->newContent($quickAddText);
  $event->quickAdd = $gdataCal->newQuickAdd(true);

  $newEvent = $gdataCal->insertEvent($event);
  return $newEvent->id->text;
}

/**
 * Creates a new web content event on the authenticated user's default
 * calendar with the specified event details. For simplicity, the event
 * is created as an all day event and does not include a description.
 *
 * @param  Zend_Http_Client $client    The authenticated client object
 * @param  string           $title     The event title
 * @param  string           $startDate The start date of the event in YYYY-MM-DD format
 * @param  string           $endDate   The end time of the event in HH:MM 24hr format
 * @param  string           $icon      URL pointing to a 16x16 px icon representing the event.
 * @param  string           $url       The URL containing the web content for the event.
 * @param  string           $height    The desired height of the web content pane.
 * @param  string           $width     The desired width of the web content pane.
 * @param  string           $type      The MIME type of the web content.
 * @return string The ID URL for the event.
 */
function createWebContentEvent ($client, $title = 'World Cup 2006',
    $startDate = '2006-06-09', $endDate = '2006-06-09',
    $icon = 'http://www.google.com/calendar/images/google-holiday.gif',
    $url = 'http://www.google.com/logos/worldcup06.gif',
    $height  = '120', $width = '276', $type = 'image/gif'
    )
{
  $gc = new Zend_Gdata_Calendar($client);
  $newEntry = $gc->newEventEntry();
  $newEntry->title = $gc->newTitle(trim($title));

  $when = $gc->newWhen();
  $when->startTime = $startDate;
  $when->endTime = $endDate;
  $newEntry->when = array($when);

  $wc = $gc->newWebContent();
  $wc->url = $url;
  $wc->height = $height;
  $wc->width = $width;

  $wcLink = $gc->newLink();
  $wcLink->rel = "http://schemas.google.com/gCal/2005/webContent";
  $wcLink->title = $title;
  $wcLink->type = $type;
  $wcLink->href = $icon;

  $wcLink->webContent = $wc;
  $newEntry->link = array($wcLink);

  $createdEntry = $gc->insertEvent($newEntry);
  return $createdEntry->id->text;
}

/**
 * Creates a recurring event on the authenticated user's default calendar with
 * the specified event details.
 *
 * @param  Zend_Http_Client $client    The authenticated client object
 * @param  string           $title     The event title
 * @param  string           $desc      The detailed description of the event
 * @param  string           $where
 * @param  string           $recurData The iCalendar recurring event syntax (RFC2445)
 * @return void
 */
function createRecurringEvent ($client, $title = 'Tennis with Beth',
    $desc='Meet for a quick lesson', $where = 'On the courts',
    $recurData = null)
{
  $gc = new Zend_Gdata_Calendar($client);
  $newEntry = $gc->newEventEntry();
  $newEntry->title = $gc->newTitle(trim($title));
  $newEntry->where = array($gc->newWhere($where));

  $newEntry->content = $gc->newContent($desc);
  $newEntry->content->type = 'text';

  /**
   * Due to the length of this recurrence syntax, we did not specify
   * it as a default parameter value directly
   */
  if ($recurData == null) {
    $recurData =
        "DTSTART;VALUE=DATE:20070501\r\n" .
        "DTEND;VALUE=DATE:20070502\r\n" .
        "RRULE:FREQ=WEEKLY;BYDAY=Tu;UNTIL=20070904\r\n";
  }

  $newEntry->recurrence = $gc->newRecurrence($recurData);

  $gc->post($newEntry->saveXML());
}

/**
 * Returns an entry object representing the event with the specified ID.
 *
 * @param  Zend_Http_Client $client  The authenticated client object
 * @param  string           $eventId The event ID string
 * @return Zend_Gdata_Calendar_EventEntry|null if the event is found, null if it's not
 */
function getEvent($client, $eventId)
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  $query = $gdataCal->newEventQuery();
  $query->setUser('default');
  $query->setVisibility('private');
  $query->setProjection('full');
  $query->setEvent($eventId);

  try {
    $eventEntry = $gdataCal->getCalendarEventEntry($query);
    return $eventEntry;
  } catch (Zend_Gdata_App_Exception $e) {
    var_dump($e);
    return null;
  }
}

/**
 * Updates the title of the event with the specified ID to be
 * the title specified.  Also outputs the new and old title
 * with HTML br elements separating the lines
 *
 * @param  Zend_Http_Client $client   The authenticated client object
 * @param  string           $eventId  The event ID string
 * @param  string           $newTitle The new title to set on this event
 * @return Zend_Gdata_Calendar_EventEntry|null The updated entry
 */
function updateEvent ($client, $eventId, $newTitle)
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  if ($eventOld = getEvent($client, $eventId)) {
    echo "Old title: " . $eventOld->title->text . "<br />\n";
    $eventOld->title = $gdataCal->newTitle($newTitle);
    try {
        $eventOld->save();
    } catch (Zend_Gdata_App_Exception $e) {
        var_dump($e);
        return null;
    }
    $eventNew = getEvent($client, $eventId);
    echo "New title: " . $eventNew->title->text . "<br />\n";
    return $eventNew;
  } else {
    return null;
  }
}

/**
 * Adds an extended property to the event specified as a parameter.
 * An extended property is an arbitrary name/value pair that can be added
 * to an event and retrieved via the API.  It is not accessible from the
 * calendar web interface.
 *
 * @param  Zend_Http_Client $client  The authenticated client object
 * @param  string           $eventId The event ID string
 * @param  string           $name    The name of the extended property
 * @param  string           $value   The value of the extended property
 * @return Zend_Gdata_Calendar_EventEntry|null The updated entry
 */
function addExtendedProperty ($client, $eventId,
    $name='http://www.example.com/schemas/2005#mycal.id', $value='1234')
{
  $gc = new Zend_Gdata_Calendar($client);
  if ($event = getEvent($client, $eventId)) {
    $extProp = $gc->newExtendedProperty($name, $value);
    $extProps = array_merge($event->extendedProperty, array($extProp));
    $event->extendedProperty = $extProps;
    $eventNew = $event->save();
    return $eventNew;
  } else {
    return null;
  }
}


/**
 * Adds a reminder to the event specified as a parameter.
 *
 * @param  Zend_Http_Client $client  The authenticated client object
 * @param  string           $eventId The event ID string
 * @param  integer          $minutes Minutes before event to set reminder
 * @return Zend_Gdata_Calendar_EventEntry|null The updated entry
 */
function setReminder($client, $eventId, $minutes=15)
{
  $gc = new Zend_Gdata_Calendar($client);
  $method = "alert";
  if ($event = getEvent($client, $eventId)) {
    $times = $event->when;
    foreach ($times as $when) {
        $reminder = $gc->newReminder();
        $reminder->setMinutes($minutes);
        $reminder->setMethod($method);
        $when->reminders = array($reminder);
    }
    $eventNew = $event->save();
    return $eventNew;
  } else {
    return null;
  }
}

/**
 * Deletes the event specified by retrieving the atom entry object
 * and calling Zend_Feed_EntryAtom::delete() method.  This is for
 * example purposes only, as it is inefficient to retrieve the entire
 * atom entry only for the purposes of deleting it.
 *
 * @param  Zend_Http_Client $client  The authenticated client object
 * @param  string           $eventId The event ID string
 * @return void
 */
function deleteEventById ($client, $eventId)
{
  $event = getEvent($client, $eventId);
  $event->delete();
}

/**
 * Deletes the event specified by calling the Zend_Gdata::delete()
 * method.  The URL is typically in the format of:
 * http://www.google.com/calendar/feeds/default/private/full/<eventId>
 *
 * @param  Zend_Http_Client $client The authenticated client object
 * @param  string           $url    The url for the event to be deleted
 * @return void
 */
function deleteEventByUrl ($client, $url)
{
  $gdataCal = new Zend_Gdata_Calendar($client);
  $gdataCal->delete($url);
}

/**
 * Main logic for running this sample code via the command line or,
 * for AuthSub functionality only, via a web browser.  The output of
 * many of the functions is in HTML format for demonstration purposes,
 * so you may wish to pipe the output to Tidy when running from the
 * command-line for clearer results.
 *
 * Run without any arguments to get usage information
 */
/*
if (isset($argc) && $argc >= 2) {
  switch ($argv[1]) {
    case 'outputCalendar':
      if ($argc == 4) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        outputCalendar($client);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} " .
             "<username> <password>\n";
      }
      break;
    case 'outputCalendarMagicCookie':
      if ($argc == 4) {
        outputCalendarMagicCookie($argv[2], $argv[3]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} " .
             "<username> <magicCookie>\n";
      }
      break;
    case 'outputCalendarByDateRange':
      if ($argc == 6) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        outputCalendarByDateRange($client, $argv[4], $argv[5]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} " .
             "<username> <password> <startDate> <endDate>\n";
      }
      break;
    case 'outputCalendarByFullTextQuery':
      if ($argc == 5) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        outputCalendarByFullTextQuery($client, $argv[4]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} " .
             "<username> <password> <fullTextQuery>\n";
      }
      break;
    case 'outputCalendarList':
      if ($argc == 4) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        outputCalendarList($client);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} " .
             "<username> <password>\n";
      }
      break;
    case 'updateEvent':
      if ($argc == 6) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        updateEvent($client, $argv[4], $argv[5]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<eventId> <newTitle>\n";
      }
      break;
    case 'setReminder':
      if ($argc == 6) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        setReminder($client, $argv[4], $argv[5]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<eventId> <minutes>\n";
      }
      break;
    case 'addExtendedProperty':
      if ($argc == 7) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        addExtendedProperty($client, $argv[4], $argv[5], $argv[6]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<eventId> <name> <value>\n";
      }
      break;
    case 'deleteEventById':
      if ($argc == 5) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        deleteEventById($client, $argv[4]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<eventId>\n";
      }
      break;
    case 'deleteEventByUrl':
      if ($argc == 5) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        deleteEventByUrl($client, $argv[4]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<eventUrl>\n";
      }
      break;
    case 'createEvent':
      if ($argc == 12) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        $id = createEvent($client, $argv[4], $argv[5], $argv[6], $argv[7],
            $argv[8], $argv[9], $argv[10], $argv[11]);
        print "Event created with ID: $id\n";
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<title> <description> <where> " .
             "<startDate> <startTime> <endDate> <endTime> <tzOffset>\n";
        echo "EXAMPLE: php {$argv[0]} {$argv[1]} <username> <password> " .
             "'Tennis with Beth' 'Meet for a quick lesson' 'On the courts' " .
             "'2008-01-01' '10:00' '2008-01-01' '11:00' '-08'\n";
      }
      break;
    case 'createQuickAddEvent':
      if ($argc == 5) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        $id = createQuickAddEvent($client, $argv[4]);
        print "Event created with ID: $id\n";
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<quickAddText>\n";
        echo "EXAMPLE: php {$argv[0]} {$argv[1]} <username> <password> " .
             "'Dinner at the beach on Thursday 8 PM'\n";
      }
      break;
    case 'createWebContentEvent':
        if ($argc == 12) {
          $client = getClientLoginHttpClient($argv[2], $argv[3]);
          $id = createWebContentEvent($client, $argv[4], $argv[5], $argv[6],
              $argv[7], $argv[8], $argv[9], $argv[10], $argv[11]);
          print "Event created with ID: $id\n";
        } else {
          echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
               "<title> <startDate> <endDate> <icon> <url> <height> <width> <type>\n\n";
          echo "This creates a web content event on 2007/06/09.\n";
          echo "EXAMPLE: php {$argv[0]} {$argv[1]} <username> <password> " .
               "'World Cup 2006' '2007-06-09' '2007-06-10' " .
               "'http://www.google.com/calendar/images/google-holiday.gif' " .
               "'http://www.google.com/logos/worldcup06.gif' " .
               "'120' '276' 'image/gif'\n";
        }
        break;
    case 'createRecurringEvent':
      if ($argc == 7) {
        $client = getClientLoginHttpClient($argv[2], $argv[3]);
        createRecurringEvent($client, $argv[4], $argv[5], $argv[6]);
      } else {
        echo "Usage: php {$argv[0]} {$argv[1]} <username> <password> " .
             "<title> <description> <where>\n\n";
        echo "This creates an all-day event which occurs first on 2007/05/01" .
             "and repeats weekly on Tuesdays until 2007/09/04\n";
        echo "EXAMPLE: php {$argv[0]} {$argv[1]} <username> <password> " .
             "'Tennis with Beth' 'Meet for a quick lesson' 'On the courts'\n";
      }
      break;
  }
} else if (!isset($_SERVER["HTTP_HOST"]))  {
  // running from command line, but action left unspecified
  echo "Usage: php {$argv[0]} <action> [<username>] [<password>] " .
      "[<arg1> <arg2> ...]\n\n";
  echo "Possible action values include:\n" .
       "outputCalendar\n" .
       "outputCalendarMagicCookie\n" .
       "outputCalendarByDateRange\n" .
       "outputCalendarByFullTextQuery\n" .
       "outputCalendarList\n" .
       "updateEvent\n" .
       "deleteEventById\n" .
       "deleteEventByUrl\n" .
       "createEvent\n" .
       "createQuickAddEvent\n" .
       "createWebContentEvent\n" .
       "createRecurringEvent\n" .
       "setReminder\n" .
       "addExtendedProperty\n";
} else {
  // running through web server - demonstrate AuthSub
  processPageLoad();
}
*/
?>
<?php



/**
 * Adds a new photo to the specified album
 *
 * @param  Zend_Http_Client $client  The authenticated client
 * @param  string           $user    The user's account name
 * @param  integer          $albumId The album's id
 * @param  array            $photo   The uploaded photo
 * @return void
 */
function addPhoto($client, $user, $albumId, $photo)
{
    $photos = new Zend_Gdata_Photos($client);

    $fd = $photos->newMediaFileSource($photo["tmp_name"]);
    $fd->setContentType($photo["type"]);

    $entry = new Zend_Gdata_Photos_PhotoEntry();
    $entry->setMediaSource($fd);
    $entry->setTitle($photos->newTitle($photo["name"]));

    $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
    $albumQuery->setUser($user);
    $albumQuery->setAlbumId($albumId);

    $albumEntry = $photos->getAlbumEntry($albumQuery);

    $result = $photos->insertPhotoEntry($entry, $albumEntry);
    if ($result) {
        outputAlbumFeed($client, $user, $albumId);
    } else {
        echo "There was an issue with the file upload.";
    }
}

/**
 * Deletes the specified photo
 *
 * @param  Zend_Http_Client $client  The authenticated client
 * @param  string           $user    The user's account name
 * @param  integer          $albumId The album's id
 * @param  integer          $photoId The photo's id
 * @return void
 */
function deletePhoto($client, $user, $albumId, $photoId)
{
    $photos = new Zend_Gdata_Photos($client);

    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
    $photoQuery->setUser($user);
    $photoQuery->setAlbumId($albumId);
    $photoQuery->setPhotoId($photoId);
    $photoQuery->setType('entry');

    $entry = $photos->getPhotoEntry($photoQuery);

    $photos->deletePhotoEntry($entry, true);

    outputAlbumFeed($client, $user, $albumId);
}

/**
 * Adds a new album to the specified user's album
 *
 * @param  Zend_Http_Client $client The authenticated client
 * @param  string           $user   The user's account name
 * @param  string           $name   The name of the new album
 * @return void
 */
function addAlbum($client, $user, $name)
{
    $photos = new Zend_Gdata_Photos($client);

    $entry = new Zend_Gdata_Photos_AlbumEntry();
    $entry->setTitle($photos->newTitle($name));

    $result = $photos->insertAlbumEntry($entry);
    if ($result) {
        outputUserFeed($client, $user);
    } else {
        echo "There was an issue with the album creation.";
    }
}

/**
 * Deletes the specified album
 *
 * @param  Zend_Http_Client $client  The authenticated client
 * @param  string           $user    The user's account name
 * @param  integer          $albumId The album's id
 * @return void
 */
function deleteAlbum($client, $user, $albumId)
{
    $photos = new Zend_Gdata_Photos($client);

    $albumQuery = new Zend_Gdata_Photos_AlbumQuery;
    $albumQuery->setUser($user);
    $albumQuery->setAlbumId($albumId);
    $albumQuery->setType('entry');

    $entry = $photos->getAlbumEntry($albumQuery);

    $photos->deleteAlbumEntry($entry, true);

    outputUserFeed($client, $user);
}

/**
 * Adds a new comment to the specified photo
 *
 * @param  Zend_Http_Client $client  The authenticated client
 * @param  string           $user    The user's account name
 * @param  integer          $albumId The album's id
 * @param  integer          $photoId The photo's id
 * @param  string           $comment The comment to add
 * @return void
 */
function addComment($client, $user, $album, $photo, $comment)
{
    $photos = new Zend_Gdata_Photos($client);

    $entry = new Zend_Gdata_Photos_CommentEntry();
    $entry->setTitle($photos->newTitle($comment));
    $entry->setContent($photos->newContent($comment));

    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
    $photoQuery->setUser($user);
    $photoQuery->setAlbumId($album);
    $photoQuery->setPhotoId($photo);
    $photoQuery->setType('entry');

    $photoEntry = $photos->getPhotoEntry($photoQuery);

    $result = $photos->insertCommentEntry($entry, $photoEntry);
    if ($result) {
        outputPhotoFeed($client, $user, $album, $photo);
    } else {
        echo "There was an issue with the comment creation.";
    }
}

/**
 * Deletes the specified comment
 *
 * @param  Zend_Http_Client $client    The authenticated client
 * @param  string           $user      The user's account name
 * @param  integer          $albumId   The album's id
 * @param  integer          $photoId   The photo's id
 * @param  integer          $commentId The comment's id
 * @return void
 */
function deleteComment($client, $user, $albumId, $photoId, $commentId)
{
    $photos = new Zend_Gdata_Photos($client);

    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
    $photoQuery->setUser($user);
    $photoQuery->setAlbumId($albumId);
    $photoQuery->setPhotoId($photoId);
    $photoQuery->setType('entry');

    $path = $photoQuery->getQueryUrl() . '/commentid/' . $commentId;

    $entry = $photos->getCommentEntry($path);

    $photos->deleteCommentEntry($entry, true);

    outputPhotoFeed($client, $user, $albumId, $photoId);
}

/**
 * Adds a new tag to the specified photo
 *
 * @param  Zend_Http_Client $client The authenticated client
 * @param  string           $user   The user's account name
 * @param  integer          $album  The album's id
 * @param  integer          $photo  The photo's id
 * @param  string           $tag    The tag to add to the photo
 * @return void
 */
function addTag($client, $user, $album, $photo, $tag)
{
    $photos = new Zend_Gdata_Photos($client);

    $entry = new Zend_Gdata_Photos_TagEntry();
    $entry->setTitle($photos->newTitle($tag));

    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
    $photoQuery->setUser($user);
    $photoQuery->setAlbumId($album);
    $photoQuery->setPhotoId($photo);
    $photoQuery->setType('entry');

    $photoEntry = $photos->getPhotoEntry($photoQuery);

    $result = $photos->insertTagEntry($entry, $photoEntry);
    if ($result) {
        outputPhotoFeed($client, $user, $album, $photo);
    } else {
        echo "There was an issue with the tag creation.";
    }
}

/**
 * Deletes the specified tag
 *
 * @param  Zend_Http_Client $client     The authenticated client
 * @param  string           $user       The user's account name
 * @param  integer          $albumId    The album's id
 * @param  integer          $photoId    The photo's id
 * @param  string           $tagContent The name of the tag to be deleted
 * @return void
 */
function deleteTag($client, $user, $albumId, $photoId, $tagContent)
{
    $photos = new Zend_Gdata_Photos($client);

    $photoQuery = new Zend_Gdata_Photos_PhotoQuery;
    $photoQuery->setUser($user);
    $photoQuery->setAlbumId($albumId);
    $photoQuery->setPhotoId($photoId);
    $query = $photoQuery->getQueryUrl() . "?kind=tag";

    $photoFeed = $photos->getPhotoFeed($query);

    foreach ($photoFeed as $entry) {
        if ($entry instanceof Zend_Gdata_Photos_TagEntry) {
            if ($entry->getContent() == $tagContent) {
                $tagEntry = $entry;
            }
        }
    }

    $photos->deleteTagEntry($tagEntry, true);

    outputPhotoFeed($client, $user, $albumId, $photoId);
}

/**
 * Returns the path to the current script, without any query params
 *
 * Env variables used:
 * $_SERVER['PHP_SELF']
 *
 * @return string Current script path
 */
function getCurrentScript()
{
    global $_SERVER;
    return $_SERVER["PHP_SELF"];
}


/**
 * Returns the AuthSub URL which the user must visit to authenticate requests
 * from this application.
 *
 * Uses getCurrentUrl() to get the next URL which the user will be redirected
 * to after successfully authenticating with the Google service.
 *
 * @return string AuthSub URL
 */
function getAuthSubUrlData()
{
    $next = getCurrentUrl();
    $scope = 'http://picasaweb.google.com/data';
    $secure = false;
    $session = true;
    return Zend_Gdata_AuthSub::getAuthSubTokenUri($next, $scope, $secure,
        $session);
}



/**
 * Processes loading of this sample code through a web browser.  Uses AuthSub
 * authentication and outputs a list of a user's albums if succesfully
 * authenticated.
 *
 * @return void
 */
//function processPageLoad()
//{
//    global $_SESSION, $_GET;
//    if (!isset($_SESSION['sessionToken']) && !isset($_GET['token'])) {
//        requestUserLogin('Please login to your Google Account.');
//    } else {
//        $client = getAuthSubHttpClientData();
//        if (!empty($_REQUEST['command'])) {
//            switch ($_REQUEST['command']) {
//                case 'retrieveSelf':
//                    outputUserFeed($client, "default");
//                    break;
//                case 'retrieveUser':
//                outputUserFeed($client, $_REQUEST['user']);
//                    break;
//                case 'retrieveAlbumFeed':
//                    outputAlbumFeed($client, $_REQUEST['user'], $_REQUEST['album']);
//                    break;
//                case 'retrievePhotoFeed':
//                    outputPhotoFeed($client, $_REQUEST['user'], $_REQUEST['album'],
//                        $_REQUEST['photo']);
//                    break;
//            }
//        }
//
//        // Now we handle the potentially destructive commands, which have to
//        // be submitted by POST only.
//        if (!empty($_POST['command'])) {
//            switch ($_POST['command']) {
//                case 'addPhoto':
//                    addPhoto($client, $_POST['user'], $_POST['album'], $_FILES['photo']);
//                    break;
//                case 'deletePhoto':
//                    deletePhoto($client, $_POST['user'], $_POST['album'],
//                        $_POST['photo']);
//                    break;
//                case 'addAlbum':
//                    addAlbum($client, $_POST['user'], $_POST['name']);
//                    break;
//                case 'deleteAlbum':
//                    deleteAlbum($client, $_POST['user'], $_POST['album']);
//                    break;
//                case 'addComment':
//                    addComment($client, $_POST['user'], $_POST['album'], $_POST['photo'],
//                        $_POST['comment']);
//                    break;
//                case 'addTag':
//                    addTag($client, $_POST['user'], $_POST['album'], $_POST['photo'],
//                        $_POST['tag']);
//                    break;
//                case 'deleteComment':
//                    deleteComment($client, $_POST['user'], $_POST['album'],
//                        $_POST['photo'], $_POST['comment']);
//                    break;
//                case 'deleteTag':
//                    deleteTag($client, $_POST['user'], $_POST['album'], $_POST['photo'],
//                        $_POST['tag']);
//                    break;
//              default:
//                    break;
//          }
//        }
//
//        // If a menu parameter is available, display a submenu.
//        if (!empty($_REQUEST['menu'])) {
//            switch ($_REQUEST['menu']) {
//              case 'user':
//                displayUserMenu();
//                    break;
//                case 'photo':
//                    displayPhotoMenu();
//                    break;
//            case 'album':
//              displayAlbumMenu();
//                    break;
//            case 'logout':
//              logout();
//                    break;
//            default:
//                header('HTTP/1.1 400 Bad Request');
//                echo "<h2>Invalid menu selection.</h2>\n";
//                echo "<p>Please check your request and try again.</p>";
//          }
//        }
//
//        if (empty($_REQUEST['menu']) && empty($_REQUEST['command'])) {
//            displayMenu();
//        }
//    }
//}

/**
 * Displays the main menu, allowing the user to select from a list of actions.
 *
 * @return void
 */
function displayMenu()
{
?>
<h2>Main Menu</h2>

<p>Welcome to the Photos API demo page. Please select
    from one of the following four options to fetch information.</p>

    <ul>
        <li><a href="?command=retrieveSelf">Your Feed</a></li>
        <li><a href="?menu=user">User Menu</a></li>
        <li><a href="?menu=photo">Photos Menu</a></li>
        <li><a href="?menu=album">Albums Menu</a></li>
    </ul>
<?php
}

/**
 * Outputs an HTML link to return to the previous page.
 *
 * @return void
 */
function displayBackLink()
{
    echo "<br><br>";
    echo "<a href='javascript: history.go(-1);'><< Back</a>";
}

/**
 * Displays the user menu, allowing the user to request a specific user's feed.
 *
 * @return void
 */
function displayUserMenu()
{
?>
<h2>User Menu</h2>

<div class="menuForm">
    <form method="get" accept-charset="utf-8">
        <h3 class='nopad'>Retrieve User Feed</h3>
        <p>Retrieve the feed for an existing user.</p>
        <p>
            <input type="hidden" name="command" value="retrieveUser" />
            <label for="user">Username: </label>
            <input type="text" name="user" value="" /><br />
        </p>

        <p><input type="submit" value="Retrieve User &rarr;"></p>
    </form>
</div>
<?php

    displayBackLink();
}

/**
 * Displays the photo menu, allowing the user to request a specific photo's feed.
 *
 * @return void
 */
function displayPhotoMenu()
{
?>
<h2>Photo Menu</h2>

<div class="menuForm">
    <form method="get" accept-charset="utf-8">
        <h3 class='nopad'>Retrieve Photo Feed</h3>
        <p>Retrieve the feed for an existing photo.</p>
        <p>
            <input type="hidden" name="command" value="retrievePhotoFeed" />
            <label for="user">User: </label>
            <input type="text" name="user" value="" /><br />
            <label for="album">Album ID: </label>
            <input type="text" name="album" value="" /><br />
            <label for="photoid">Photo ID: </label>
            <input type="text" name="photo" value="" /><br />
        </p>

        <p><input type="submit" value="Retrieve Photo Feed &rarr;"></p>
    </form>
</div>
<?php

    displayBackLink();
}

/**
 * Displays the album menu, allowing the user to request a specific album's feed.
 *
 * @return void
 */
function displayAlbumMenu()
{
?>
<h2>Album Menu</h2>

<div class="menuForm">
    <form method="get" accept-charset="utf-8">
        <h3 class='nopad'>Retrieve Album Feed</h3>
        <p>Retrieve the feed for an existing album.</p>
        <p>
            <input type="hidden" name="command" value="retrieveAlbumFeed" />
            <label for="user">User: </label>
                    <input type="text" name="user" value="" /><br />
                    <label for="album">Album ID: </label>
                    <input type="text" name="album" value="" /><br />
        </p>

        <p><input type="submit" value="Retrieve Album Feed &rarr;"></p>
    </form>
</div>
<?php

    displayBackLink();
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing an
 * album in the user's feed.
 *
 * @param  Zend_Http_Client $client The authenticated client object
 * @param  string           $user   The user's account name
 * @return void
 */
function outputUserFeed($client, $user)
{
    $photos = new Zend_Gdata_Photos($client);

    $query = new Zend_Gdata_Photos_UserQuery();
    $query->setUser($user);

    $userFeed = $photos->getUserFeed(null, $query);
    echo "<h2>User Feed for: " . $userFeed->getTitle() . "</h2>";
    echo "<ul class='user'>\n";
    foreach ($userFeed as $entry) {
        if ($entry instanceof Zend_Gdata_Photos_AlbumEntry) {
            echo "\t<li class='user'>";
            echo "<a href='?command=retrieveAlbumFeed&user=";
            echo $userFeed->getTitle() . "&album=" . $entry->getGphotoId();
            echo "'>";
            $thumb = $entry->getMediaGroup()->getThumbnail();
            echo "<img class='thumb' src='" . $thumb[0]->getUrl() . "' /><br />";
            echo $entry->getTitle() . "</a>";
            echo "<form action='" . getCurrentScript() . "'' method='post' class='deleteForm'>";
            echo "<input type='hidden' name='user' value='" . $user . "' />";
            echo "<input type='hidden' name='album' value='" . $entry->getGphotoId();
            echo "' />";
            echo "<input type='hidden' name='command' value='deleteAlbum' />";
            echo "<input type='submit' value='Delete' /></form>";
            echo "</li>\n";
        }
    }
    echo "</ul><br />\n";

    echo "<h3>Add an Album</h3>";
?>
    <form method="POST" action="<?php echo getCurrentScript(); ?>">
        <input type="hidden" name="command" value="addAlbum" />
        <input type="hidden" name="user" value="<?php echo $user; ?>" />
        <input type="text" name="name" />
        <input type="submit" name="Add Album" />
    </form>
<?php

    displayBackLink();
}

/**
 * Outputs an HTML unordered list (ul), with each list item representing a
 * photo in the user's album feed.
 *
 * @param  Zend_Http_Client $client  The authenticated client object
 * @param  string           $user    The user's account name
 * @param  integer          $albumId The album's id
 * @return void
 */
function outputAlbumFeed($client, $user, $albumId)
{
    $photos = new Zend_Gdata_Photos($client);

    $query = new Zend_Gdata_Photos_AlbumQuery();
    $query->setUser($user);
    $query->setAlbumId($albumId);

    $albumFeed = $photos->getAlbumFeed($query);
    echo "<h2>Album Feed for: " . $albumFeed->getTitle() . "</h2>";
    echo "<ul class='albums'>\n";
    foreach ($albumFeed as $entry) {
        if ($entry instanceof Zend_Gdata_Photos_PhotoEntry) {
            echo "\t<li class='albums'>";
            echo "<a href='" . getCurrentScript() . "?command=retrievePhotoFeed&user=" . $user;
            echo "&album=" . $albumId . "&photo=" . $entry->getGphotoId() . "'>";
            $thumb = $entry->getMediaGroup()->getThumbnail();
            echo "<img class='thumb' src='" . $thumb[1]->getUrl() . "' /><br />";
            echo $entry->getTitle() . "</a>";
            echo "<form action='" . getCurrentScript() . "' method='post' class='deleteForm'>";
            echo "<input type='hidden' name='user' value='" . $user . "' />";
            echo "<input type='hidden' name='album' value='" . $albumId . "' />";
            echo "<input type='hidden' name='photo' value='" . $entry->getGphotoId();
            echo "' /><input type='hidden' name='command' value='deletePhoto' />";
            echo "<input type='submit' value='Delete' /></form>";
            echo "</li>\n";
        }
    }
    echo "</ul><br />\n";

    echo "<h3>Add a Photo</h3>";
?>
    <form enctype="multipart/form-data" method="POST" action="<?php echo getCurrentScript(); ?>">
        <input type="hidden" name="MAX_FILE_SIZE" value="20971520" />
        <input type="hidden" name="command" value="addPhoto" />
        <input type="hidden" name="user" value="<?php echo $user; ?>" />
        <input type="hidden" name="album" value="<?php echo $albumId; ?>" />
        Please select a photo to upload: <input name="photo" type="file" /><br />
        <input type="submit" name="Upload" />
    </form>
<?php

    displayBackLink();
}

/**
 * Outputs the feed of the specified photo
 *
 * @param  Zend_Http_Client $client  The authenticated client object
 * @param  string           $user    The user's account name
 * @param  integer          $albumId The album's id
 * @param  integer          $photoId The photo's id
 * @return void
 */
function outputPhotoFeed($client, $user, $albumId, $photoId)
{
    $photos = new Zend_Gdata_Photos($client);

    $query = new Zend_Gdata_Photos_PhotoQuery();
    $query->setUser($user);
    $query->setAlbumId($albumId);
    $query->setPhotoId($photoId);
    $query = $query->getQueryUrl() . "?kind=comment,tag";

    $photoFeed = $photos->getPhotoFeed($query);
    echo "<h2>Photo Feed for: " . $photoFeed->getTitle() . "</h2>";
    $thumbs = $photoFeed->getMediaGroup()->getThumbnail();
    echo "<img src='" . $thumbs[2]->url . "' />";

    echo "<h3 class='nopad'>Comments:</h3>";
    echo "<ul>\n";
    foreach ($photoFeed as $entry) {
        if ($entry instanceof Zend_Gdata_Photos_CommentEntry) {
            echo "\t<li>" . $entry->getContent();
            echo "<form action='" . getCurrentScript() . "' method='post' class='deleteForm'>";
            echo "<input type='hidden' name='user' value='" . $user . "' />";
            echo "<input type='hidden' name='album' value='" . $albumId . "' />";
            echo "<input type='hidden' name='photo' value='" . $photoId . "' />";
            echo "<input type='hidden' name='comment' value='" . $entry->getGphotoId();
            echo "' />";
            echo "<input type='hidden' name='command' value='deleteComment' />";
            echo "<input type='submit' value='Delete' /></form>";
            echo "</li>\n";
        }
    }
    echo "</ul>\n";
    echo "<h4>Add a Comment</h4>";
?>
    <form method="POST" action="<?php echo getCurrentScript(); ?>">
        <input type="hidden" name="command" value="addComment" />
        <input type="hidden" name="user" value="<?php echo $user; ?>" />
        <input type="hidden" name="album" value="<?php echo $albumId; ?>" />
        <input type="hidden" name="photo" value="<?php echo $photoId; ?>" />
        <input type="text" name="comment" />
        <input type="submit" name="Comment" value="Comment" />
    </form>
<?php
    echo "<br />";
    echo "<h3 class='nopad'>Tags:</h3>";
    echo "<ul>\n";
    foreach ($photoFeed as $entry) {
        if ($entry instanceof Zend_Gdata_Photos_TagEntry) {
            echo "\t<li>" . $entry->getTitle();
            echo "<form action='" . getCurrentScript() . "' method='post' class='deleteForm'>";
            echo "<input type='hidden' name='user' value='" . $user . "' />";
            echo "<input type='hidden' name='album' value='" . $albumId . "' />";
            echo "<input type='hidden' name='photo' value='" . $photoId . "' />";
            echo "<input type='hidden' name='tag' value='" . $entry->getContent();
            echo "' />";
            echo "<input type='hidden' name='command' value='deleteTag' />";
            echo "<input type='submit' value='Delete' /></form>";
            echo "</li>\n";
        }
    }
    echo "</ul>\n";
    echo "<h4>Add a Tag</h4>";
?>
    <form method="POST" action="<?php echo getCurrentScript(); ?>">
        <input type="hidden" name="command" value="addTag" />
        <input type="hidden" name="user" value="<?php echo $user; ?>" />
        <input type="hidden" name="album" value="<?php echo $albumId; ?>" />
        <input type="hidden" name="photo" value="<?php echo $photoId; ?>" />
        <input type="text" name="tag" />
        <input type="submit" name="Tag" value="Tag" />
    </form>
<?php

    displayBackLink();
}

/**
 * Output the CSS for the page
 */

?>
<style type="text/css">
    h2 {
        color: #0056FF;
    }
    h3 {
        color: #0056FF;
        padding-top: 15px;
        clear: left;
    }
    h3.nopad {
        padding: 0px;
    }
    ul {
        background-color: #E0EAFF;
        color: #191D1D;
        margin: 10px;
        padding: 10px 10px 10px 25px;
        border: 1px solid #515B5C;
    }
    ul.user, ul.albums {
        background-color: #FFFFFF;
        border: 0px;
        padding: 0px;
    }
    li.user, li.albums {
        display: block;
        float: left;
        margin: 5px;
        padding: 5px;
        text-align: center;
        background-color: #E0EAFF;
        border: 1px solid #515B5C;
    }
    a {
        color: #0056FF;
        font-weight: bold;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
        color: #E00000;
    }
    div.menuForm {
        margin: 10px;
        padding: 0px 10px;
        background-color: #E0EAFF;
        border: 1px solid #515B5C;
    }
    form.deleteForm {
        padding-left: 10px;
        display: inline;
    }
    img.thumb {
        margin: 5px;
        border: 0px;
    }
</style>
<?php

/**
 * Calls the main processing function for running in a browser
 */

//processPageLoad();
