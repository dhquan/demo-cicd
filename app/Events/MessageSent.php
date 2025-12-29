<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast; // <--- 1. Import cái này
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

// 2. Thêm 'implements ShouldBroadcast' vào class
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;

    // 3. Nhận dữ liệu truyền vào
    public function __construct($username, $message)
    {
        $this->username = $username;
        $this->message = $message;
    }

    // 4. Định nghĩa kênh (Channel) để phát
    public function broadcastOn()
    {
        // Channel: Kênh công khai (ai cũng nghe được)
        // PrivateChannel: Kênh riêng tư (cần auth)
        return new Channel('chat-room');
    }

    // (Tùy chọn) Đặt tên sự kiện cho Frontend dễ bắt
    public function broadcastAs()
    {
        return 'message.new';
    }
}
