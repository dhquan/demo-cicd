import './bootstrap';
import axios from "axios";

// 1. Khai báo các biến DOM
const chatBox = document.getElementById('chat-box');
const messageInput = document.getElementById('message-input');
const sendBtn = document.getElementById('send-btn');

// Hàm hỗ trợ thêm tin nhắn vào giao diện
function appendMessage(user, text, type = 'received') {
    const msgDiv = document.createElement('div');
    msgDiv.classList.add('message', type);

    msgDiv.innerHTML = `
        <strong>${user}</strong>
        ${text}
    `;

    chatBox.appendChild(msgDiv);
    // Tự động cuộn xuống cuối cùng
    chatBox.scrollTop = chatBox.scrollHeight;
}

// 2. Lắng nghe WebSocket (QUAN TRỌNG)
setTimeout(() => {
    if (window.Echo) {
        console.log('Echo đã sẵn sàng...');

        window.Echo.channel('chat-room')
            .listen('.message.new', (e) => {
                console.log('Tin về:', e);
                // Gọi hàm hiển thị tin nhắn
                appendMessage(e.username, e.message, 'received');
            });
    }
}, 500);

// 3. Xử lý Gửi tin nhắn (Gọi API)
sendBtn.addEventListener('click', () => {
    const message = messageInput.value;
    const user = "Tôi"; // Tạm thời hardcode tên user hiện tại

    if (message.trim() === '') return;

    // Hiển thị tin của chính mình lên màn hình ngay lập tức
    appendMessage(user, message, 'sent');

    // Xóa ô nhập liệu
    messageInput.value = '';

    // Gọi API gửi tin lên Server (Backend sẽ bắn sự kiện cho người khác)
    axios.get('/send-message', {
        params: {
            user: user,
            text: message
        }
    }).catch(error => console.error(error));
});

// Xử lý ấn Enter để gửi
messageInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendBtn.click();
});
