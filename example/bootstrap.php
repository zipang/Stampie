<?php

require __DIR__ . '/../vendor/autoload.php';

function get_adapter() {
    return new Stampie\Adapter\BuzzAdapter(new Buzz\Browser);
}

function get_mailer($key) {
    return new Stampie\Mailer(get_handler(get_adapter(), $key));
}

function get_message($from) {
    return new Stampie\Message\DefaultMessage(get_from($from), 'Stampie Example', '<p>Hello</p>', 'Hello');
}

function get_to($to) {
    return new Stampie\Identity($to);
}

function get_from($from) {
    return new Stampie\Identity($from);
}

function main($argv) {
    if (!isset($argv[3])) {
        echo 'php ./example_file.php "api-key" "to@domain.tld" "from@domain.tld"';
        die(1);
    }

    list(, $key, $to, $from) = $argv;

    var_dump(get_mailer($key)->send(get_to($to), get_message($from)));
}

main($_SERVER['argv']);
