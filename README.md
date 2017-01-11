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

If you want to add your own functionality to a model, for instance a `User` you can do so like this:

```php
    namespace App\Model;

    class User extends \WPLaravel\Model\User {
        public function orders() {
            return $this->hasMany('\App\Model\User\Orders');
        }
    }
```

Another example would be for custom taxonomies on a post, say `country`

```php
    namespace App\Model;

    class Post extends \WPLaravel\Model\Post {
        public function country() {
            return $this->terms()->where('taxonomy', 'country');
        }
    }
```
