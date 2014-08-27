<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $serviceLocator = $this->getServiceLocator();
        $config = $serviceLocator->get('config');
        return array(
                    'version'=> $config['application']['vr'],
                    'applicationName' => $config['application']['name'],
                    'appMsg' => 'Ovo je poruka iz indexController.php',
                    'zdravo' => $config['poruke']['welcome'],
                );
    }

    public function aboutAction()
    {
        return array(
            'zdravo' => 'Ovo je pozdravna poruka',
            'kakosi' => 'Sta radis sta ima novo',

            );
    }
}
