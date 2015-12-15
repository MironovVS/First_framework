<?php/*
Шаблон выбора кол-ва статей на одной странице
============================
*/?>
<div class="page">
    Выводить статьи: <br>
    <a <?php click(3, $_SESSION['num'], 'black') ;?> href="?num=3"> по 3</a>
    <a <?php click(5, $_SESSION['num'], 'black') ;?> href="?num=5"> по 5</a>
    <a <?php click(10, $_SESSION['num'], 'black') ;?> href="?num=10"> по 10</a>
</div>