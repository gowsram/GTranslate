GTranslate
==========

#### Google Translate - ZF2  Module 

A Zend Framework 2 Module for Google Translate


Installation
------------

### Main Setup

#### By cloning project

1. This module is available on [Packagist](https://packagist.org/packages/gowsram/g-translate).
In your project's `composer.json` use:
	```json
    {   
        "require": {
			"php": ">=5.3.3",
			"zendframework/zendframework": "*",
            "gowsram/g-translate": "dev-master"
    }
	```
2. Or clone this project into your `./vendor/` directory.

#### Post installation

1. Enabling this module in your `application.config.php` file.

    ```php
    return array(
        'modules' => array(
            // ...
            'GTranslate',
    		// ...
        ),
        // ...
    );
    ```
    
#### Usage

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
	
