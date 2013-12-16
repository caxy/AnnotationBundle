AnnotationBundle
================

Implementation of Annotator (http://okfnlabs.org/annotator/)

## Prerequisites

This version of the bundle requires Symfony 2.2, jQuery, and Doctrine.

## Installation

1. Download CaxyAnnotationBundle using composer
2. Enable the Bundle
3. Configure the CaxyAnnotationBundle
4. Import CaxyAnnotationBundle routing
5. Update your database schema
6. Initialize CaxyAnnotation on the pages needed

### Step 1: Download CaxyAnnotationBundle using composer

Add FOSUserBundle in your composer.json:

```js
{
    "require": {
        "caxy/caxyannotationbundle": "~1.0@dev"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update caxy/caxyannotationbundle
```

Composer will install the bundle to your project's `vendor/caxy` directory.

### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Caxy\AnnotationBundle\AnnotationBundle(),
    );
}
```

### Step 3: Configure the CaxyAnnotationBundle

# app/config/annotation/annotation.yml
annotation:
    selector: ".annotation"
    plugins: ['store']

* plugins is optional and currently only the store plugin is supported

### Step 4: Import CaxyAnnotationBundle routing files

Now that you have activated and configured the bundle, all that is left to do is
import the CaxyAnnotationBundle routing files.

In YAML:

``` yaml
# app/config/routing.yml

caxy_annotation:
    resource: "@AnnotationBundle/Resources/config/routing/routing.yml"
    type:     annotation
    prefix:   /

### Step 5: Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema.

For ORM run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```

### Step 6: Initialize CaxyAnnotation on the pages needed.

Now that the CaxyAnnotationBundle is activated and configured, you can use it by adding the following to any twig view:

``` twig
{{ annotation_init() }}

* If using the store plugin enabled in the config, custom metadata can be added and passed with the regular data
* ex: {{ annotation_init( {'metadata': {'productId': 11} }) }}

