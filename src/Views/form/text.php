<?php echo $this->name; ?> <br>
<input type = "text" name="<?=$this->name?>" value="<?=$this->getValue(); ?>"><?php echo $this->errors[$this->name]?><br>