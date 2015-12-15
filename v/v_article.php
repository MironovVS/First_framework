<table>
  <tbody>
  <tr>
    <td>Название статьи</td>
    <td>Дата создания</td>
    <td>Текст статьи</td>
  </tr>

  <?php foreach ($article as $art):
    for ($i = 0 ; $i < count($art); $i++):?>
      <tr>
        <td width="10%"><?php echo $art["$i"]['name']?></a></td>
        <td width="20%"><?php echo $art["$i"]['date']?></td>
        <td><div><?php echo $art["$i"]['content']?></div></td>
      </tr>
    <?php endfor?>
  <?php endforeach?>
  </tbody>

</table>

<?php echo $comm?>
<?php echo $comm_new?>

