<?php

/**
 * Return a nicely formatted time
 * e.g.
 *  in 1 hour, 2 minutes
 *  2 hours, 10 minutes ago
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

  function __construct( $timeStr ) {
    $this->time = strtotime( $timeStr );
  }

  function humanize( $granularity = 2 ) {
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
    foreach ( $this->PERIODS as $key => $value ) {
      if ( $difference >= $value ) {
        $time = floor( $difference / $value );
        $difference %= $value;
        if ($time > 0) {
          $parts[] = $time . ' ' . $key . ( ( $time > 1 ) ? 's' : '' );
        }
        $granularity --;
      }
      if ( $granularity == '0' ) {
        break;
      }
    }
    if (!$parts) {
      $parts[] = 'now';
    }
    $final = $prefix . implode(', ',$parts) . $suffix;
    return $final;
  }
}

?>