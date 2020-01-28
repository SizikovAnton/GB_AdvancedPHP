<h2>Каталог</h2>

<? foreach($catalog as $item): ?>

    <div>
        <h3><?= $item['name'] ?></h3>
        <p><?= $item['description'] ?></p>
        <p>Цена: <?= $item['price'] ?></p>
        <a href="?c=product&a=card&id=<?= $item['id'] ?>">Подробнее...</a>
        <hr>
    </div>

<? endforeach; ?>