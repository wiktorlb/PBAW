<?php
/* Smarty version 3.1.30, created on 2024-04-22 18:30:08
  from "E:\xampp\htdocs\Lab7_routing\app\views\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_66269090ddb597_42585265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eafc4cae7c0004d2e94759848f37a18798c9ddb9' => 
    array (
      0 => 'E:\\xampp\\htdocs\\Lab7_routing\\app\\views\\CalcView.tpl',
      1 => 1713803333,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:main.tpl' => 1,
    'file:messages.tpl' => 1,
  ),
),false)) {
function content_66269090ddb597_42585265 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_120126249066269090ddaeb0_36447429', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'content'} */
class Block_120126249066269090ddaeb0_36447429 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: <?php echo $_smarty_tpl->tpl_vars['user']->value->login;?>
, rola: <?php echo $_smarty_tpl->tpl_vars['user']->value->role;?>
</span>
</div>

<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcCompute" method="post">
<legend> Kalkulator Kredytowy - role </legend>
	<fieldset>
		<label for="price">Kwota kredytu</label>
		<input id="price" type="text" placeholder="Kwota kredytu" name="price" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->price;?>
">

		<label for="perc">Oprocentowanie</label>
		<input id="perc" type="text" placeholder="Oprocentowanie" name="perc" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->perc;?>
">

		<label for="len">Długość kredytu</label>
		<input id="len" type="text" placeholder="Długość kredytu" name="len" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->len;?>
">
	</fieldset>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->role == "admin") {?>
	<button type="submit" class="pure-button pure-button-primary">Oblicz miesięczną ratę</button>
	<?php }?>
</form>

<?php $_smarty_tpl->_subTemplateRender("file:messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
<div class="messages info">
	Wynik: <?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>

</div>
<?php }?>

<?php
}
}
/* {/block 'content'} */
}
