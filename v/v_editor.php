<?php
?>
<b><a href="index.php?c=editor&act=new">Новая статья</a></b>
<table>
		<?php for($i=0; $i<count($articles_all); $i++): ?>
			<tr>
				<td width="40%">
					<?php echo $articles_all["$i"]['name'] ?>
				</td>
				<td>
					<a href="index.php?c=editor&act=show&id=<?php echo $articles_all["$i"]['id']?>">Просмотр</a>
				</td>
				<td>
					<a href="index.php?c=editor&act=del&id=<?php echo $articles_all["$i"]['id']?>">Удалить</a>
				</td>
				<td>
					<a href="index.php?c=editor&act=edit&id=<?php echo $articles_all["$i"]['id'] ?>">Редактировать</a>
				</td>
			</tr>
		<?php endfor ?>

</table>
