<?php

namespace App\EventListener;


namespace App\EventListener;


use App\Entity\Product;
use Doctrine\Common\Collections\Criteria;
use EasyCorp\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class EasyAdminSubscriber implements EventSubscriberInterface
{

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {

        $this->authorizationChecker = $authorizationChecker;
    }

    public function onPostListQueryBuilder(GenericEvent $event)
    {
        $entity = $event->getSubject();
        $sortField = $event->getArgument('sort_field');


        if ($entity['name'] !== 'Product' || $sortField !== 'publishedAt') {
            return;
        }

        $queryBuilder = $event->getArgument('query_builder');
        $criteria = Criteria::create()->where(Criteria::expr()->neq('publishedAt', null));
        $queryBuilder->addCriteria($criteria);

//        return $queryBuilder;
    }

    public function onPreEdit(GenericEvent $event)
    {
        $entity = $event->getSubject();

        if ($entity['class'] == Product::class){
            $this->denyAccessUnlessSuperAdmin();
        }
    }

    private function denyAccessUnlessSuperAdmin()
    {
        if (!$this->authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            throw new AccessDeniedException();
        }
    }



    /**
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            EasyAdminEvents::PRE_EDIT => 'onPreEdit',
            EasyAdminEvents::POST_LIST_QUERY_BUILDER => 'onPostListQueryBuilder',
        ];
    }
}