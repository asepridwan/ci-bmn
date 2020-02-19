<P>
  <?php
    echo "Nomor terakhir di SP Service yaitu = ".$max->nosps;
  ?>
</p>
<form method=post action=''>
  <input type=text maxlength=4 name=nosps placeholder='Nomor SPS nya' value="<?php echo $max->nosps+1; ?>" required autofocus>
  <input type=submit name=submit value=submit>
</form>
