<?php  if (count($errors) > 0) : ?>
  	<?php foreach ($errors as $error) : ?>
  	 <p><?php echo "<div class='error'>" . $error . "</div>"; ?></p>
  	<?php endforeach ?>
<?php  endif ?>