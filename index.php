<?php
declare(strict_types=1);

$config = require __DIR__ . '/config.php';

function h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

$from = trim((string) ($config['from_name'] ?? 'Jonathan'));
$to = trim((string) ($config['to_name'] ?? ''));
$years = (int) ($config['years'] ?? 4);
$dateLine = trim((string) ($config['date_line'] ?? ''));
$forLine = $to !== '' ? 'For ' . $to : 'For you';

$photoDir = __DIR__ . '/assets/img/photos';
$photos = [];
if (is_dir($photoDir)) {
    $files = scandir($photoDir) ?: [];
    foreach ($files as $file) {
        if (preg_match('/\.(jpe?g|png|webp|gif)$/i', $file)) {
            $photos[] = 'assets/img/photos/' . rawurlencode($file);
        }
    }
}

$title = $years . ' years';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?= h($title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Outfit:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="gate" data-gate>
        <div class="gate-inner">
            <p class="gate-kicker"><?= h($forLine) ?></p>
            <div class="meander"></div>
            <h1 class="gate-title"><?= h((string) $years) ?></h1>
            <p class="gate-sub">A letter, not a card.</p>
            <button type="button" data-open>Open</button>
        </div>
    </div>

    <main class="letter">
        <header class="hero">
            <div class="hero-frame" data-reveal>
                <p class="eyebrow"><?= h($forLine) ?></p>
                <div class="meander"></div>
                <h1><?= h($title) ?></h1>
                <?php if ($dateLine !== ''): ?>
                    <p class="date-line"><?= h($dateLine) ?></p>
                <?php endif; ?>
            </div>
        </header>

        <section class="chapter">
            <p class="chapter-num" data-reveal>I</p>
            <h2 data-reveal>Luck, in person</h2>
            <p class="lede" data-reveal>I did not go looking for a favourite person. I met a stranger, and the world quietly rearranged itself.</p>
            <p data-reveal>There was a time when you were a random person in it. No plot. No guarantee. Just a day that could have gone any other way, and did not.</p>
            <p class="quiet" data-reveal>I still think about that. How thin the chance was. How complete it feels now.</p>
        </section>

        <hr class="gold-rule">

        <section class="chapter">
            <p class="chapter-num" data-reveal>II</p>
            <h2 data-reveal>Then you were not random</h2>
            <p data-reveal>Favourite is too small a word, and still it is the true one. You are the person I look for. The voice I trust. The ordinary evening I would not trade.</p>
            <p data-reveal>Four years of turning toward each other — not only on the nights that look like a celebration, but on the ones that look like dishes and tiredness and coming home.</p>
            <p class="quiet" data-reveal>That is the luck I mean. Not the meeting only. The staying. The becoming.</p>
        </section>

        <?php if ($photos): ?>
            <hr class="gold-rule">
            <section class="chapter">
                <p class="chapter-num" data-reveal>III</p>
                <h2 data-reveal>Us</h2>
                <div class="photos">
                    <?php foreach ($photos as $src): ?>
                        <figure data-reveal>
                            <img src="<?= h($src) ?>" alt="">
                        </figure>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <hr class="gold-rule">

        <section class="chapter">
            <p class="chapter-num" data-reveal><?= $photos ? 'IV' : 'III' ?></p>
            <h2 data-reveal>Still</h2>
            <p class="lede" data-reveal>I am luckier than I knew how to ask for.</p>
            <div class="sign-off" data-reveal>
                <p>Thank you for four years of being my favourite person — the one the random day was for.</p>
                <p class="from">— <?= h($from) ?></p>
            </div>
        </section>
    </main>

    <script src="assets/js/main.js"></script>
</body>
</html>
