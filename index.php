<?php
/*
Plugin Name: Online Zakaat Calculator
Plugin URI: http://vomu.org/blog
Description: Add Beautiful Zakaat Calculator in Sidebar Powered By First Online Islamic Publishing Platform : Voice Of Muslim Ummah
Version: 1.0
Author: Haseeb Ahmad Ayazi
Author URI: http://techooid.com/
*/
 
 
class ZakaatCalculator extends WP_Widget
{
  function ZakaatCalculator()
  {
    $widget_ops = array('classname' => 'ZakaatCalculator', 'description' => 'Add Beautiful Zakaat Calculator in Sidebar' );
    $this->WP_Widget('ZakaatCalculator', 'Zakaat Calculator', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
echo <<<_HTML

<script language="JavaScript">
	function check_empty(empty){
	 if (empty.value == ""){
	empty.value = 0;}
	 if (empty.value< 0) {
	alert("The value must be equal or greater than 0 !");
	empty.focus(); }
	calculate();
	}
	
	function lostfocus(current_field){
	 	calculate();
	}
	
	function blankfield(field_name){
	 if (field_name.value == "0"){
	field_name.value = ""; }
	} 
	
	function calculate(){
	 with(document.zakatcalc){
	total_amount.value=eval(bank_saving.value)+eval(gold_silver.value)+
	 eval(money_owed.value)+eval(other.value); 
	 if(eval(total_amount.value)< 0){ 
	alert("The total cannot be less than Zero");
	 }
	 else {
	zakah.value=formated(Math.round(eval(total_amount.value)*0.025*100)/100);}
	 }
	}
	
	function formated(source){
	 var temp1=new String(source);
	 if(temp1.indexOf(".")!=-1){
	 var position=temp1.indexOf(".");
	 if(temp1.charAt(position+3)!="" && temp1.charAt(position+3)>4){
	 a=temp1.substring(0,position+3);
	 a=eval(a)*100;
	 a=eval(a)+1;
	 a=eval(a)/100;
	 return a;}
	 else {
	 return temp1.substring(0,position+3); }
	 }
	 else {
	 return temp1.valueOf(); }
	}
	</script>

<form action="" name="zakatcalc">
<center>
<div align="center">
<table width="200" border="0" align="left" cellpadding="0" cellspacing="0">
<tr> 
<td height="20" bgcolor="#EDEDED"> 
<div align="center"><strong>Zakat Caculator</strong></div></td>
</tr>
<tr>
<td bgcolor="#DEDEDE"> 
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="arial2">
<tr align valign="top" bgcolor="#FFFFFF""left"> 
<td width="260"><p><b>Bank Saving</b><br>

 U<span class="ten">se lowest amount held for 1 year</span></td>
<td width="79" align=""><div align="center"><span class="thirteen"><b> 
</b></span> 
<input type="text" name="bank_saving" value="0" onFocus="blankfield(bank_saving)" 
	onBlur=check_empty(bank_saving) size="7">
</div></td>
</tr>
<tr align valign="top" bgcolor="#FFFFFF""left"> 
<td><p><b>+ Gold & Silver</b><br>

 M<span class="ten">onetary value</span></td>
<td width="79" align=""><div align="center"><span class="thirteen"><b> 
</b></span> 
<input type="text" name="gold_silver" value="0" onFocus="blankfield(gold_silver)" 
	onBlur=check_empty(gold_silver) size="7">
</div></td>
</tr>
<tr align valign="top" bgcolor="#FFFFFF""left"> 
<td><p><b>+ Money owed to you<br>

</b><span class="ten">Deposits, loans you made</span> 
</td>
<td width="79" align=""><div align="center"><span class="thirteen"><b> 
</b></span> 
<input type="text" name="money_owed" value="0" onFocus="blankfield(money_owed)" 
	onBlur=check_empty(money_owed) size="7">
</div></td>
</tr>
<tr align valign="top" bgcolor="#FFFFFF""left"> 
<td><p><b>+ Resale value of shares, stocks, bonds, 
 etc.</b></td>

<td width="79" align=""><div align="center"><span class="thirteen"><b> 
</b></span> 
<input type="text" name="other" value="0" onFocus="blankfield(other)" 
	onBlur=check_empty(other) size="7">
</div></td>
</tr>
<tr align valign="top" bgcolor="#FFFFFF""left"> 
<td><p><b>Total</b></td>
<td width="79" align=""><div align="center"><span class="thirteen"><b> 
</b></span> 
<input type="text" name="total_amount" onFocus ="lostfocus(total_amount)" size="7">

</div></td>
</tr>
<tr align valign="top" bgcolor="#FFFFFF""left"> 
<td><p><b><font color="#4d73b4"> 2.5 % of zakat</font></b> 
</td>
<td width="79" align=""><div align="center"><span class="thirteen"><b> 
</b></span> 
<input type="text" name="zakah" onFocus="lostfocus(zakah)" size="7">
</div></td>

</tr>
<tr valign="top" bgcolor="#FFFFFF"> 
<td><div align="right"> 
<input type="reset" name="Reset" value="Reset" >
</div></td>
<td width="79" align="center"><div align="left"> 
<input name="Calculate" type="button" id="Calculate" value="Calculate" >
</div></td>
</tr>

</table></td>
</tr>
</table>
</form></div>
	</td>
</tr>
<a href="http://techooid.com/">Helping Education</a>
</table>	

</td>
</tr>

_HTML;


    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ZakaatCalculator");') );?>