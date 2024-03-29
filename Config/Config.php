<?php



$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => App\Models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ],
    'model' => \Core\Model::class,
    'modelClasses' => [
        'email' => \App\Models\ChangeEmailModel::class,
        'shots' => \App\Models\PostEntry::class,
        'users' => \App\Models\UserEntry::class,
        'restore' => \App\Models\RestoreEntry::class,
        'invites' => \App\Models\InvitationEntry::class,
        'confirmations' => \App\Models\ConfirmationEntry::class,
        'comments' => \App\Models\CommentEntry::class
    ],
    'templateClasses' => [
        'comments' => \app\core\grid\CommentGrid::class,
        'commentsSearch' => \app\core\grid\CommentSearchGrid::class,
        'browse' => \app\core\grid\BrowseGrid::class,
        'users' => \app\core\grid\UsersGrid::class,
        'form' => \app\core\form\Form::class,
        'shot' => \app\core\shot\Shot::class,
        'currentImage' => \app\core\shot\CurrentImage::class
    ]
];