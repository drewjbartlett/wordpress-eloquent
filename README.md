<h2>Wordpress Laravel Eloquent Models</h2>

<p align="center">
<img src="http://drewjbartlett.com/images/github/logo-laravel.svg">
<img src="http://drewjbartlett.com/images/github/wordpress-logo.png">
</p>

A library that converts converts wordpress tables into [Laravel Eloquent Models](https://laravel.com/docs/5.3/eloquent). This is helpful for dropping into any wordpress project where maybe you'd rather use the awesome features of Laravel's Eloquent Models. Or maybe you're writing an API with something like [Slim](https://www.slimframework.com/) or better yet [Lumen](https://lumen.laravel.com/) don't want to increase your load time by loading the entire WP core. This is a great boiler plate based off [Eloquent](https://laravel.com/docs/5.3/eloquent) by Laravel to get you going.

** This is documentation for additional functionality on top of Eloquent. For documentation on all of Eloquent's features you visit the [documentation](https://laravel.com/docs/5.3/eloquent).

## Overview
 - [Installation](#installation)
 - [Setup](#setup)
 - [Posts](#posts)
 - [Comments](#comments)
 - [Terms](#terms)
 - [Users](#users)
 - [Meta](#meta)
 - [Options](#options)
 - [Links](#links)
 - [Extending your own models](#extending-your-own-models)
 - [Query Logs](#query-logs)

### Installation

    composer require drewjbartlett/wordpress-eloquent

### Setup

```php
require_once('vendor/autoload.php');

\WPEloquent\Core\Laravel::connect([
    'global' => true,
    'multiple_connections' => false,
    'config' => [

        'database' => [
            'user'     => 'user',
            'password' => 'password',
            'name'     => 'database',
            'host'     => '127.0.0.1',
            'port'     => '3306'
        ],

        // your wpdb prefix
        'prefix' => 'wp_', 
        
    ],

    // enable events
    'events' => false,

    // enable query log
    'log'    => true
]);

```

If you would like to create multiple database connections set the multiple_connections value to true, and replace the config element as follows: 
```php
'config' => [

    'database' => [
        'default' => [  
            'user'     => 'user',
            'password' => 'password',
            'name'     => 'database',
            'host'     => '127.0.0.1',
            'port'     => '3306',
            'prefix' => 'wp_',
        ],
        // Define your extra connections here
        
        //    'extra_connection' => [  
        //    'user'     => 'user2',
        //    'password' => 'password2',
        //    'name'     => 'database2',
        //    'host'     => '127.0.0.2',
        //    'port'     => '3306',
        //    'prefix' => 'wp_',
        //],
    ]   
    
], 
```

If you wanted to enable this on your entire WP install you could create a file with the above code to drop in the `mu-plugins` folder.

### Posts

```php

use \WPEloquent\Model\Post;

// getting a post
$post = Post::find(1);

// available relationships
$post->author;
$post->comments;
$post->terms;
$post->tags;
$post->categories;
$post->meta;

```

***Statuses***

By default, the `Post` returns posts with all statuses. You can however override this with the [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes) `published` to return only published posts.

```php
Post::published()->get();
```

Or if you need a specific status you can override with defined status via [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes).

```php
Post::status('draft')->get();
```

***Post Types***

By default, the `Post` returns posts with all post types. You can however override this by defining a post type via [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes).

```php
Post::type('page')->get();
```

### Comments

```php

use \WPEloquent\Model\Comment;

// getting a comment
$comment = Comment::find(12345);

// available relationships
$comment->post;
$comment->author;
$comment->meta

```

### Terms

In this version `Term` is still accesible as a model but is only leveraged through posts.

```php
$post->terms()->where('taxonomy', 'country');
```

### Users

```php

use \WPEloquent\Model\User;

// getting a comment
$user = User::find(123);

// available relationships
$user->posts;
$user->meta;
$user->comments

```

### Meta

The models `Post`, `User`, `Comment`, `Term`, all implement the `HasMeta`. Therefore they meta can easily be retrieved by the `getMeta` and set by the `setMeta` helper functions:

```php
$post = Post::find(1);
$post->setMeta('featured_image', 'my-image.jpg');
$post->setMeta('breakfast', ['waffles' => 'blueberry', 'pancakes' => 'banana']);

// or all in one call
$featured_image = Post::find(1)->getMeta('featured_image');
Post::find(1)->setMeta('featured_image', 'image.jpg');

// same applies for all other models

$user = User::find(1)
$facebook = $user->getMeta('facebook');
$user->setMeta('social', ['facebook' => 'facebook.com/me', 'instagram' => 'instagram.com/me']);

$comment = Comment::find(1);
$meta = $comment->getMeta('some_comment_meta');

$term = Term::find(123);
$meta = $term->getMeta('some_term_meta');

// delete meta
$post = Post::find(123)->deleteMeta('some_term_meta');
```

### Options

In wordpress you can use `get_option`. Alternatively, if you don't want to load the wordpress core you can use helper function `getValue`.

```php
use \WPEloquent\Model\Post;

$siteurl = Option::getValue('siteurl');
```

Or of course, the long form:

```php
use \WPEloquent\Model\Options;

$siteurl = Option::where('option_name', 'siteurl')->value('option_value');
```


### Links

```php
use \WPEloquent\Model\Link;

$siteurl = Link::find(1);
```

### Extending your own models

If you want to add your own functionality to a model, for instance a `User` you can do so like this:

```php
namespace App\Model;

class User extends \WPEloquent\Model\User {

    public function orders() {
        return $this->hasMany('\App\Model\User\Orders');
    }

    public function current() {
        // some functionality to get current user
    }

    public function favorites() {
        return $this->hasMany('Favorites');
    }

}
```

Another example would be for custom taxonomies on a post, say `country`

```php
namespace App\Model;

class Post extends \WPEloquent\Model\Post {

    public function countries() {
        return $this->terms()->where('taxonomy', 'country');
    }

}

Post::with(['categories', 'countries'])->find(1);
```

### Query Logs

Sometimes it's helpful to see the query logs for debugging. You can enable the logs by passing `log` is set to `true` (see [setup](#setup)) on the `Laravel::connect` method. Logs are retrieved by running.

```php
use \WPEloquent\Core\Laravel;

print_r(Laravel::queryLog());

```
