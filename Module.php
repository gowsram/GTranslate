<?php
namespace GTranslate;

class Module
{
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'GTranslate\Service\Translate' => function ($sm) {
                    $config = $sm->get('config');
                    return new \GTranslate\Service\Translate();
                },
            ),
        );
    }
}
