<fieldset>

  <form>
    <?php foreach ($comm as $c):
      for ($i = 0 ; $i < count($c); $i++):?>
        <input type="hidden" name="name_art" value="<?php echo $c['$i']['name']?>">
Имя <input type="text" name="comm_name" "><br>
Комментарий <textarea name="comm_text" style="width: 300px; height: 30px;"></textarea>
    <input type="submit" name="submit">
    <?php endfor?>
    <?php endforeach?>
</form>
</fieldset>