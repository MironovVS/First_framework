<?php/*
Шаблон постраничной навигации
============================
$n - переменная равная отношению кол-ва статей в БД к требуемому кол-ву статей на одной странице
*/?>
<?php if($n > 1): ?>
    <div class="page">
        <a <?php click(0, $_GET['page'], 'green')?> href="index.php">1</a>
        <?php $i = 1; while($i++ < $n): ?>
            <a <?php click($i, $_GET['page'], 'green');?> href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endwhile; ?>
    </div>
<?php endif; ?>