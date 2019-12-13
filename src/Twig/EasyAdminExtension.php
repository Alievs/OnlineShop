<?php
/**
 * Created by PhpStorm.
 * User: alibaba
 * Date: 03.12.19
 * Time: 3:26
 */

namespace App\Twig;


use App\Entity\Product;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class EasyAdminExtension extends AbstractExtension
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function getFilters()
    {
        return [new TwigFilter(
            'filter_admin_actions',
            [$this, 'filterActions']
            )
        ];
    }

    public function filterActions(array $itemActions, $item)
    {
        if ($item instanceof Product && $item->getPublishedAt()){
            unset($itemActions['delete']);
        }

        if ($item instanceof Product && !$this->authorizationChecker->isGranted('ROLE_SUPERADMIN')) {
            unset($itemActions['edit']);
        }
        // export action is rendered by us manually
        unset($itemActions['export']);

        return $itemActions;
    }

}