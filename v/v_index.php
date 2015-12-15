<table>
    <tbody>
  <tr>
    <td>Номер</td>
    <td>Название статьи</td>
    <td>Дата создания</td>
    <td>Краткое онисание статьи</td>
  </tr>

  <?php
  echo $sort;
    foreach ($articles_all as $article):
    for ($i = 0 ; $i < count($article); $i++):?>
      <tr>
        <td width="10%"><?php echo $article["$i"]['id']?></td>
        <td width="20%"><?php echo $article["$i"]['name']?></a></td>
        <td width="10%"><?php echo $article["$i"]['date']?></td>
        <td><?php echo $article["$i"]['content']?><a href="index.php?c=editor&act=show&id=<?php echo $article["$i"]['id']?>">...</a></td>
      </tr>
    <?php endfor; ?>
  <?php endforeach;?>

  </tbody>
</table>
