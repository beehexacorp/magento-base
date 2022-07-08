# Beehexa Magento 2 base module

#### Website: https://www.beehexa.com/

``beehexa/magento-base``

This is core modules for Beehexa's modules. Which adding Menu, Configuration section. 

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 
## Main Functionalities
 This is core modules for Beehexa's modules. 
 - Which adding Menu,
 - Configuration section. 
 - Fetching Beehexa News form Beehex
 
## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file
 - Unzip the zip file in `app/code/Beehexa`
 - Enable the module by running `php bin/magento module:enable Beehexa_Base`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer
 - Install the module composer by running `composer require beehexa/magento-base`
 - enable the module by running `php bin/magento module:enable Beehexa_Base`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration
Store -> Configuration -> Beehexa Corp

## Specifications
 - Cronjob
	- beehexa_base_fetching_news
