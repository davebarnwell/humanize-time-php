humanize-time-php
=================

given a time express it as relative to now in


    $dt = new HumanizeTime('2014-12-01 15:30:32');
    echo $dt->humanize().PHP_EOL;     // produceds respsonses such as
                                      // "in 1 hour, 2 minutes" or
                                      // "2 hours, 10 minutes ago"
                                      // depending on the current time relative to the orginal time given
                                      
    
