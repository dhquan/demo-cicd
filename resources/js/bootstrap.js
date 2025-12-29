import Echo from 'laravel-echo';
import io from 'socket.io-client';

window.io = io;

window.Echo = new Echo({
    broadcaster: 'socket.io',
    client: io,
    // THÊM http:// VÀO ĐÂY ĐỂ BẢN CŨ HIỂU
    host: 'http://' + window.location.hostname + ':6001',
    transports: ['websocket'],
    disableStats: true,
});
