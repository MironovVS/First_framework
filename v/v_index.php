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

    for ($i = 0 ; $i < count($articles_all); $i++):?>
      <tr>
        <td width="10%"><?php echo $articles_all["$i"]['id']?></td>
        <td width="20%"><?php echo $articles_all["$i"]['name']?></a></td>
        <td width="10%"><?php echo $articles_all["$i"]['date']?></td>
        <td><?php echo $articles_all["$i"]['content']?><a href="index.php?c=editor&act=show&id=<?php echo $articles_all["$i"]['id']?>">...</a></td>
      </tr>
    <?php endfor; ?>


  </tbody>
</table>
