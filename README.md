# Wordpress Laravel Eloquent Models
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
 - [Query Logs](#query-logs)

[Extending your own models](#extending-your-own-models)

### Installation

    `composer require drewjbartlett/wp-eloquent`

### Setup

```php
    require_once('vendor/autoload.php');

    \WPLaravel\Core\Laravel::connect([
        'config' => [

            'database' => [
                'user'     => 'user',
                'password' => 'password',
                'name'     => 'database',
                'host'     => '127.0.0.1'
            ],

            // your wpdb prefix
            'prefix' => 'wp_',

            // enable events
            'events' => false,

            // enable query log
            'log'    => true
        ],
    ]);

```

If you wanted to enable this on your entire WP install you could create a file to drop in the `mu-plugins` folder.

### Posts

```php
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

By default, the `Post` returns posts with all statuses. You can however override this with a [local scope](https://laravel.com/docs/5.3/eloquent#query-scopes) to return only published posts.

```php
    Post::published()->get();
```

### Comments

```php
    // getting a comment
    $comment = Comment::find(12345);

    // available relationships
    $comment->post;
    $comment->author;
    $comment->meta

```

### Terms

### Users

### Options

### Meta

The models `Post`, `User`, `Comment`, `Term`, all implement the `MetaTrait`. Therefore they meta can easily be retrieved by the `getMeta` helper function:

```php
    Post::getMeta('featured_image');

    User::getMeta('facebook');

    Comment::getMeta('some_comment_meta');

    Term::getMeta('some_term_meta');
```

In wordpress we'd normally use `get_option`. Alternatively, if you don't want to load the wordpress core you can use helper function `getValue`.

```php
    $siteurl = Options::getValue('siteurl');
```
Or of course, the long form:
```php
    use \WPLaravel\Model\Options;

    $siteurl = Options::where('option_name', 'siteurl')->value('option_value');
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

        public function countries() {
            return $this->terms()->where('taxonomy', 'country');
        }

    }

    Post::with(['categories', 'countries'])->find(1);
```
