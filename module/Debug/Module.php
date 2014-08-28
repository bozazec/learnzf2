<?php
/**
 * Module Bootstrap
 *
 * @package Debug
 */
namespace Debug;

use Zend\ModuleManager\Feature\AtoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\Event;

/**
 * Module Bootstrap
 *
 * @package Debug
 */
class Module implements AutoloaderProviderInterface
{
    public function init(ModuleManager $moduleManager)
    {
        $eventManager = $moduleManager->getEventManager();
        $eventManager->attach('loadModules.post',array($this,'loadedModulesInfo'));
    }

    public function loadedModulesInfo(Event $event)
    {
        $moduleManager=$event->getTarget();
        $loadedModules = $moduleManager->getLoadedModules();
        errpr_log(ver_export($loadedModules, true));
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'db-adapter' => function($sm) {
                    return $sm->get('db');
                },
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getAplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR,array($this, 'handleError'));
    }

    public function handleError(MvcEvent $event)
    {
        $controller = $event->getController();
        $error = $event->getParam('error');
        $exception = $event->getParam('exception');
        $message = 'Error: '.$error;
        if($exception instanceof \Exception)
        {
            $message .= ', Exception('.$exception->getMessage().'):'.$exception->getTraceAsString();
        }

        error_log($message);
    }

    
}