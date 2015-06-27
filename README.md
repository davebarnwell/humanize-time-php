humanize-time-php
=================

  [![Build Status](https://scrutinizer-ci.com/g/freshsauce/humanize-time-php/badges/build.png?b=master)](https://scrutinizer-ci.com/g/freshsauce/humanize-time-php/build-status/master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/freshsauce/humanize-time-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/freshsauce/humanize-time-php/?branch=master)

  given a time express it as relative to now a bit like twitter. in x minutes OR x hours ago.
  handles future as well as past times


    $dt = new HumanizeTime('2014-12-01 15:30:32');
    echo $dt->humanize().PHP_EOL;
    // produces respsonses such as
    // "in 1 hour, 2 minutes" or
    // "2 hours, 10 minutes ago"
    // depending on the current time
    // relative to the orginal time given
