<?php
    use \WPLaravel\Core\Laravel;
    use \WPLaravel\Model\Post;
    use \WPLaravel\Model\User;
    use \WPLaravel\Model\Options;

    require_once('./../vendor/autoload.php');

    \WPLaravel\Core\Laravel::bootEloquent([
        'config' => [
            'database' => [
                'user'     => 'root',
                'password' => 'password',
                'name'     => 'trek',
                'host'     => '127.0.0.1'
            ],

            'prefix' => 'wp_'
        ],
    ]);
?>

<?php


    $user = User::find(2);

    echo '<pre>';

    echo '<h1>Users</h1>';

    print_r($user->getMeta('facebook'));

    echo '<hr />';

    print_r($user->toArray());

    echo '<hr />';

    echo '<h1>Posts</h1>';

    $post = Post::find(73106);

    print_r($post->toArray());

    print_r($post->getMeta('post_background'));

    echo '<hr />';

    echo '<h1>Options</h1>';

    print_r(Options::getValue('siteurl'));


    echo '</pre>';

?>
