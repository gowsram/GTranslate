GTranslate
==========

#### Google Translate - ZF2  Module 

A Zend Framework 2 Module for Google Translate


Installation
------------

### Main Setup

#### By cloning project

1. Clone this project into your `./vendor/` directory.


Examples:

1. In the controller 

	```php
		$gtranslate = $this->getServiceLocator()->get('GTranslate\Service\Translate');
        
        $config = array(
            'from' => 'en',   //english
            'to' => 'de',     //deutsch
        );
        
        $gtranslate->__initialize($config);
        
        $resultString = $gtranslate->translate('Hello World');
        
        return new ViewModel(array('translatedString' => $resultString));                  //passing it to the view
    ```

2. In the View 

	```php
	<?php echo $this->translatedString; ?>
	```
	
