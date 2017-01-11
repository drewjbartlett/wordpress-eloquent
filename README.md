# Wordpress Laravel
A library that converts converts wordpress tables into Laravel Eloquent models.

## Overview
 - [Installation](#installation)
 - [Setup](#setup)
 - [Posts](#posts)
   - [Meta](#post-meta)
 - [Comments](#comments)
   - [Meta](#comment-meta)
 - [Terms](#terms)
   - [Meta](#term-meta)
   - [Relationships](#term-relationships)
   - [Taxonomy](#term-taxonomy)
 - [Users](#users)
   - [Meta](#user-meta)
 - [Options](#options)
 - [Links](#links)

[Extending your own models](#extending-your-own-models)

### Installation

    `composer require drewjbartlett/wp-laravel`

### Setup

### Posts

### Post Meta

### Comments

### Comment Meta

### Terms

### Term Meta

### Term Relationships

### Term Taxonomy

### Users

### User Meta

### Options

```php
    use \WPLaravel\Model\Options;
    $siteurl = Options::where('option_name', 'siteurl')->value('option_value');
```

Or use the helper function `getValue`

```php
    $siteurl = Options::getValue('siteurl');
```

### Links

### Extending your own models
