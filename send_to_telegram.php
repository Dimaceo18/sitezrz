<?php
// Telegram бот настройки - ЗАМЕНИТЕ НА СВОИ!
$botToken = "8664967194:AAHlm5Gp1f3MYUc6wKP6yzD_XedQ5R4uWpQ";        // Токен от BotFather
$chatId = "5314321592";             // Ваш Chat ID

// Проверяем метод запроса
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die(json_encode(['error' => 'Метод не разрешен']));
}

// Получаем данные из формы
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : 'Не указано';
$phone = isset($_POST['phone']) ? strip_tags(trim($_POST['phone'])) : 'Не указано';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : 'Не указано';

// Получаем информацию о пользователе
$user_ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Формируем красивое сообщение
$text = "📩 **НОВАЯ ЗАЯВКА С САЙТА**\n\n";
$text .= "👤 **Имя:** $name\n";
$text .= "📞 **Телефон:** $phone\n";
$text .= "💬 **Сообщение:** $message\n\n";
$text .= "🌐 **IP:** $user_ip\n";
$text .= "🖥️ **Браузер:** $user_agent\n";
$text .= "🕒 **Время:** " . date("d.m.Y H:i:s");

// Отправляем в Telegram
$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $chatId,
    'text' => $text,
    'parse_mode' => 'HTML'
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Отправляем ответ
if ($httpCode == 200) {
    echo json_encode(['success' => true, 'message' => 'Заявка отправлена']);
} else {
    echo json_encode(['success' => false, 'message' => 'Ошибка отправки']);
}
?>
