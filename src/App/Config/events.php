<?php declare(strict_types=1);

use Lalaz\Event\EventHub;
use App\Events\UserRegisteredEvent;

/**
 * Defines the events of the app
 *
 * This function allows you to configure all the events
 * that will be used by the application.
 *
 */
function onEventHubInitialized(EventHub $eventHub): void
{
    $eventHub->register('hello', function ($e) {
        // handle your event here
    });
}
