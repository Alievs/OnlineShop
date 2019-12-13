<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 09.11.19
 * Time: 22:09
 */

namespace App\EventListener;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class RedirectRegistrationSuccess implements EventSubscriberInterface
{

    use TargetPathTrait;

    /**
     * @var RouterInterface
     */
    private $router;

    public function __construct(RouterInterface $router)
    {

        $this->router = $router;
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $form = $event->getForm();
        $user = $event->getForm()->getData();

        if (true === $form['agreeTerms']->getData()) {
            $user->agreeTerms();
        }

        $url = $this->getTargetPath($event->getRequest()->getSession(), 'main');

        if(!$url){
            $url = $this->router->generate('app_homepage');
        }
        $response = new RedirectResponse($url);
        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => ['onRegistrationSuccess']
        ];
    }
}