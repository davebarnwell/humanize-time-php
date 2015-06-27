<?php

/**
 * given a time express it as relative to now a bit like twitter.
 * in x minutes OR x hours ago.
 * handles future as well as past times
 *
 * @author Dave Barnwell <dave@freshsauce.co.uk>
 */
class HumanizeTime {

  private $time = null;

  private $PERIODS = array(
      'decade' => 315360000,
      'year'   => 31536000,
      'month'  => 2628000,
      'week'   => 604800,
      'day'    => 86400,
      'hour'   => 3600,
      'minute' => 60,
      'second' => 1
  );

  /**
   * Initialise with a time string, anthing that can be parsed with strtotime() is ok
   *
   * @param string $timeStr 
   */
  public function __construct($timeStr) {
    $this->time = strtotime($timeStr);
  }


  /**
   * Return a nicely formatted time relative to now
   * e.g.
   *  in 1 hour, 2 minutes
   *  2 hours, 10 minutes ago
   *
   * @param integer $granularity default 2, specifies max how many time parts should be returned.
   * @return string
   */
  public function humanize($granularity = 2) {
    $date       = $this->time;
    $difference = time() - $date;
    $prefix = '';
    $suffix = '';

    if ($difference < 0) {
      $prefix = 'in ';
      $difference = abs($difference); // need a positive difference
    } else if ($difference > 0) {
      $suffix = ' ago';
    }

    $parts = array();
    foreach ($this->PERIODS as $key => $value) {
      if ($difference >= $value) {
        $time = floor($difference / $value);
        $difference %= $value;
        if ($time > 0) {
          $parts[] = $time.' '.$key.(($time > 1) ? 's' : '');
        }
        $granularity--;
      }
      if ($granularity == '0') {
        break;
      }
    }
    if ( ! $parts) {
      $parts[] = 'now';
    }
    $final = $prefix.implode(', ', $parts).$suffix;
    return $final;
  }
  
  /**
   * Return humanized date for yesterday, today, and tomorrow, else return date.
   *
   * @param        $date
   * @param string $format
   * @return string
   */
  public function naturalday($date, $format = 'Y-m-d')
  {
      $date = date($format, strtotime($date));
      if ($date == $this->yesterday($format)) {
        return 'yesterday';
      }
      if ($date == $this->tomorrow($format)) {
        return 'tomorrow';
      }
      if ($date == $this->today($format)) {
        return 'today';
      }
      return $date;
  }

  /**
   * Get yesterdays date
   *
   * @param string $format
   * @return string
   */
  public function yesterday($format = 'Y-m-d')
  {
      return date($format, strtotime('-1 day'));
  }

  /**
   * Get tomorrows date
   *
   * @param string $format
   * @return string
   */
  public function tomorrow($format = 'Y-m-d')
  {
      return date($format, strtotime('+1 day'));
  }

  /**
   * Get todays date
   *
   * @param string $format
   * @return string
   */
  public function today($format = 'Y-m-d')
  {
      return date($format);
  }

  /**
   * Check if a date is on the weekend.
   *
   * @param $date
   * @return bool
   */
  public function isWeekend($date) {
      return (date('N', strtotime($date)) >= 6);
  }

  /**
   * Check if a date is a weekday, utilizes the isWeekend function.
   *
   * @param $date
   * @return bool
   */
  public function isWeekday($date) {
      return ! $this->isWeekend($date);
  }
}

