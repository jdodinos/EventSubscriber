<?php

namespace Drupal\test_events\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Entity\EntityTypeEvents;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;

/**
 * TestEventSubscriber class.
 */
class TestEventSubscriber implements EventSubscriberInterface {
  /**
   * Logger Factory.
   *
   * @var \Drupal\Core\Logger\LoggerChannelFactoryInterface
   */
  protected $loggerFactory;

  /**
   * TestEventSubscriber constructor.
   *
   * @param Drupal\Core\Logger\LoggerChannelFactoryInterface $logger_factory
   *   The logger factory.
   */
  public function __construct(LoggerChannelFactoryInterface $logger_factory) {
    $this->loggerFactory = $logger_factory->get('Test Events');
  }

  /**
   * {@inheritdoc}.
   */
  public static function getSubscribedEvents() {
    // $events[AccountEvents::SET_USER][] = ['testNewEvent'];
    $events[EntityTypeEvents::CREATE][] = ['testNewEvent'];

    return $events;
  }

  /**
   * Undocumented function.
   */
  public function testNewEvent() {
    $this->loggerFactory->notice('Message in testNewEvent');
  }

}
