Drupal uses events to allow modules and various subsystems to communicate with one another.

# How can we create an Event Subscriber?
To subcribe an event, in our module we will need to declare our "Event subscriber" class in the mymodule.services.yml file
The first thing you need to do is define a new service tagged with the "event_subscriber" tag
services:
  example_event_subscriber:
    class: \Drupal\mymodule\EventSubscriber\ExampleEventSubscriber
    tags:
      - { name: event_subscriber }

So, we have to create the ExampleEventSubscriber class in the folder mymodule\src\EventSubscriber
and in this file we add all the functionalities that we need.

This class should implement the EventSubscriberInterface interface.
Use use Symfony\Component\EventDispatcher\EventSubscriberInterface;

In the class we have to define the getSubscribedEvents method that returns a list of events we're interested in subscribing to.
This is an example for this file

namespace Drupal\test_events\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Entity\EntityTypeEvents;

/**
 * TestEventSubscriber class.
 */
class TestEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}.
   */
  public static function getSubscribedEvents() {
    $events[EntityTypeEvents::CREATE][] = ['testNewEvent'];

    return $events;
  }

  /**
   * Undocumented function.
   */
  public function testNewEvent() {
    // Code for testNewEvent method.
  }

}

# How can we discover existing events?
To list the "event subscribers", We can search on the base code all instances in the @Event docblock tag.
By convention, the @Event tag is used to indicate that the thing being documented is the name of an event triggered by the event dispatcher. 

Another option to list the events is using Drupal Console. Drupal Console has in its commands a command to list the events.
We can use "drupal debug:event" to get the list.

And finally we can use Devel/WebProfiler, Devel contains a submodule named WebProfiler.
With WebProfiler module we can activate to see a toolbar when there are events in the current page.
1. Active Devel and WebProfiler modules.
2. Go to admin/config/development/devel/webprofiler and activate the "Events" checkbox.




