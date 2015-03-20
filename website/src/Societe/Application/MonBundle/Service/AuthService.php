<?php
/**
 * Created by PhpStorm.
 * User: dsi
 * Date: 20/03/15
 * Time: 10:09
 */

namespace Societe\Application\MonBundle\Service;


use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthAwareUserProviderInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;

class AuthService extends OAuthUserProvider implements OAuthAwareUserProviderInterface {

}