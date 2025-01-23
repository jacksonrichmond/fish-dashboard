
<?php
$whitelist = ['106361627270674'];
$gameId = $_GET['game_id'] ?? '';

$webhookUrl = 'https://discord.com/api/webhooks/1323499591601225819/WHUjHeWXr4z8Ke6C8rgL568uhDsOP2yInUQK1Jfot17sgYQssYPEqQO00ZznqnTswOW-';

function sendDiscordEmbed($title, $description, $color, $url) {
    global $webhookUrl;
    $embed = [
        'title' => $title,
        'description' => $description,
        'url' => $url,
        'color' => $color,
        'timestamp' => date('c'),
        'footer' => ['text' => 'Made by crumies']
    ];
    $data = json_encode(['embeds' => [$embed]]);
    $options = [
        'http' => [
            'header' => "Content-type: application/json\r\n",
            'method' => 'POST',
            'content' => $data
        ]
    ];
    $context = stream_context_create($options);
    @$result = file_get_contents($webhookUrl, false, $context);
    if ($result === false) {
        $error = error_get_last();
        trigger_error("Failed to send webhook: " . $error['message']);
    }
}

if (!empty($gameId) && in_array($gameId, $whitelist)) {
    sendDiscordEmbed(
        'Game Whitelisted',
        'Game ID: ' . $gameId,
        hexdec('32CD32'),
        'https://www.roblox.com/games/' . $gameId
    );
    echo "game whitelisted";
} else {
    sendDiscordEmbed(
        'Game NOT Whitelisted',
        'Game ID: ' . ($gameId ?: 'Not Provided'),
        hexdec('FF0000'),
        ($gameId ? 'https://www.roblox.com/games/' . $gameId : null)
    );
    echo "game not whitelisted";
}
