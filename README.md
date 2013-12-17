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

Add CaxyAnnotationBundle in your composer.json:

```js
{
    "require": {
        "caxy/annotation-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update caxy/caxy-annotation
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
        new Caxy\AnnotationBundle\CaxyAnnotationBundle(),
    );
}
```

### Step 3: Configure the CaxyAnnotationBundle

app/config/caxy/annotation.yml

``` yaml
caxy_annotation:
    selector: ".annotation"
    plugins: ['store']
```

* plugins is optional and currently only the store plugin is supported

### Step 4: Import CaxyAnnotationBundle routing files

Import the config file for the annotation

``` yaml
# app/config/config.yml

- { resource: caxy/annotation.yml }
```

Next import the CaxyAnnotationBundle routing files.

In YAML:

``` yaml
# app/config/routing.yml

caxy_annotation:
    resource: "@CaxyAnnotationBundle/Resources/config/routing/routing.yml"
```

### Step 5: Update your database schema

* Updating your schema is only needed if you are using the store plugin. If you aren't, skip to Step 6.

Now that the bundle is configured, the last thing you need to do is update your
database schema.

For ORM run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```

### Step 6: Initialize CaxyAnnotation on the pages needed.

Now that the CaxyAnnotationBundle is activated and configured, you can use it by adding the following to any twig view:

``` php
{{ annotation_init() }}
```

And add an html container with the selector added to the config in Step 3
ex: <div class="annotation"></div>

* If using the store plugin enabled in the config, custom metadata can be added and passed with the regular data
* ex: {{ annotation_init({'metadata': {'productId': 11}}) }}


