<?php
/**
 * User: boshurik
 * Date: 24.06.18
 * Time: 0:14
 */

namespace App\Username\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class UsernameSubscriber implements EventSubscriberInterface
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $session = $event->getRequest()->getSession();
        if ($username = $session->get('username')) {
            return;
        }

        $session->set('username', sprintf('Username %d', mt_rand(0, 100)));
    }
}