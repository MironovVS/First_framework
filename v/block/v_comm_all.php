<?php foreach ($comm as $c):
  for ($i = 0 ; $i < count($c); $i++):?>
    <fieldset>
      <form>

        Имя <input type="text" name="comm_name" value="<?php echo $c['$i']['comm_name']?>"><br>
        Комментарий <textarea name="comm_text" style="width: 300px; height: 30px;;"><?php echo $c['$i']['comm_text']?></textarea>

      </form>
    </fieldset>
  <?php endfor?>
<?php endforeach;?>