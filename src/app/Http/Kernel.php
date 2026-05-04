
protected $routeMiddleware = [
    // 追加
    'admin' => \App\Http\Middleware\IsAdmin::class,
];