# BinLocator
[![Latest Stable Version](https://poser.pugx.org/jackal/bin-locator/v/stable)](https://packagist.org/packages/jackal/bin-locator)
[![Total Downloads](https://poser.pugx.org/jackal/bin-locator/downloads)](https://packagist.org/packages/jackal/bin-locator)
[![Latest Unstable Version](https://poser.pugx.org/jackal/bin-locator/v/unstable)](https://packagist.org/packages/jackal/bin-locator)
[![License](https://poser.pugx.org/jackal/bin-locator/license)](https://packagist.org/packages/jackal/bin-locator)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lucajackal85/BinLocator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lucajackal85/BinLocator/?branch=master)
[![Build Status](https://travis-ci.org/lucajackal85/BinLocator.svg?branch=master)](https://travis-ci.org/lucajackal85/BinLocator)
## Installation
```
composer require jackal/bin-locator
```
##Usage

### Get executable path in your local system
```
require_once __DIR__ . '/vendor/autoload.php';

$locator = new \Jackal\BinLocator\BinLocator('php');

var_dump($locator->locate()); 

```
### Get [Process](https://symfony.com/doc/current/components/process.html) instance
```
require_once __DIR__ . '/vendor/autoload.php';

$locator = new \Jackal\BinLocator\BinLocator('ls');

$process = $locator->getProcess(['-la']);

$process->run();

var_dump($process->getOutput());

```
