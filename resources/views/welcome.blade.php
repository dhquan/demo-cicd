<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Realtime Chat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: sans-serif; padding: 20px; background: #f0f2f5; }
        .chat-container { max-width: 600px; margin: 0 auto; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .chat-header { background: #0084ff; color: white; padding: 15px; font-weight: bold; }

        #chat-box {
            height: 400px;
            overflow-y: auto;
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .message { padding: 8px 12px; border-radius: 15px; max-width: 70%; line-height: 1.4; font-size: 14px; }
        .message.received { background: #e4e6eb; align-self: flex-start; color: black; }
        .message.sent { background: #0084ff; color: white; align-self: flex-end; }
        .message strong { display: block; font-size: 11px; margin-bottom: 4px; opacity: 0.7; }

        .input-area { padding: 15px; display: flex; gap: 10px; background: #fff; }
        input { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 20px; outline: none; }
        button { padding: 10px 20px; background: #0084ff; color: white; border: none; border-radius: 20px; cursor: pointer; font-weight: bold; }
        button:hover { background: #0073e6; }
    </style>
</head>
<body>

<div class="chat-container">
    <div class="chat-header">Phòng Chat Realtime 🚀</div>

    <div id="chat-box">
        <div class="message received">
            <strong>System</strong>
            Chào mừng bạn đến với Chat Room!
        </div>
    </div>

    <div class="input-area">
        <input type="text" id="message-input" placeholder="Nhập tin nhắn..." autocomplete="off">
        <button id="send-btn">Gửi</button>
    </div>
</div>

</body>
</html>
