<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Events\MessageSent;


Route::get('/debug-redis', function () {
    try {
        // Test 1: Kết nối trực tiếp
        Redis::set('test_key', 'Redis đang chạy ngon lành!');
        $value = Redis::get('test_key');

        // Test 2: Thử Cache của Laravel
        Cache::put('laravel_cache', 'Dữ liệu này nằm trong Redis', 60); // Lưu 60s
        $cacheVal = Cache::get('laravel_cache');

        return response()->json([
            'status' => 'OK',
            'redis_direct' => $value,
            'laravel_cache' => $cacheVal,
            'session_driver' => config('session.driver'), // Phải hiện là 'redis'
            'cache_store' => config('cache.default')      // Phải hiện là 'redis'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'ERROR',
            'message' => $e->getMessage()
        ], 500);
    }
});

    Route::get('/send-message', function (Request $request) {
    // Giả sử lấy dữ liệu từ Input
    $user = $request->input('user', 'quank54');
    $text = $request->input('text', 'Hello Hoang!');

    // --- LỆNH QUAN TRỌNG NHẤT ---
    // Bắn sự kiện này vào Redis
    broadcast(new MessageSent($user, $text));

    return response()->json([
        'status' => 'Message Sent!',
        'data' => [
            'user' => $user,
            'message' => $text
        ]
    ]);
});

Route::get('/', function () {
    return view('welcome');
});
