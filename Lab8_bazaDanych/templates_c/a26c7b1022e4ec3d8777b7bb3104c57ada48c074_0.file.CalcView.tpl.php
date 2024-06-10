<?php
/* Smarty version 4.5.3, created on 2024-06-11 01:24:36
  from 'C:\xampp\htdocs\Lab8_bazaDanych\app\views\CalcView.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66678b34b46c62_59146492',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a26c7b1022e4ec3d8777b7bb3104c57ada48c074' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Lab8_bazaDanych\\app\\views\\CalcView.tpl',
      1 => 1718060790,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66678b34b46c62_59146492 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_44618311966678b34a7cc43_98706479', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "main.tpl");
}
/* {block 'content'} */
class Block_44618311966678b34a7cc43_98706479 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_44618311966678b34a7cc43_98706479',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div id="main" class="alt">

<div class="inner">
	<header class="title">
		<h1>Kalkulator Kredytowy</h1>
	</header>



<!-- Form -->
<div class="">
	<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
CalcProcess" class="pure-form pure-form-aligned bottom-margin">
		<div class="pure-control-group">
			<label for="kwota">Kwota Kredytu</label>
			<input type="text" name="kwota" id="kwota" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->kwota;?>
" placeholder="Kwota Kredytu" />
		</div>
		<div class="pure-control-group">
			<label for="oprocentowanie">Oprocentowanie</label>
			<input type="text" name="oprocentowanie" id="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->oprocentowanie;?>
" placeholder="Oprocentowanie" />
		</div>
		<div class="pure-control-group">
			<label for="dlugosc">Długość Kredytu</label>
			<input type="text" name="dlugosc" id="dlugosc" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->dlugosc;?>
" placeholder="Długość" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
		</div>
	</form>
</div>


<div class="l-box-lrg pure-u-1 pure-u-med-3-5">
 <?php if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
	<h4>Wystąpiły błędy:</h4>
	<ol class="err">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getErrors(), 'err');
$_smarty_tpl->tpl_vars['err']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
$_smarty_tpl->tpl_vars['err']->do_else = false;
?> <li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ol>
<?php }?>  <?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
	<h4>Informacje:</h4>
	<ol class="inf">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'inf');
$_smarty_tpl->tpl_vars['inf']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['inf']->value) {
$_smarty_tpl->tpl_vars['inf']->do_else = false;
?> <li><?php echo $_smarty_tpl->tpl_vars['inf']->value;?>
</li>  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	</ol>
<?php }
if ((isset($_smarty_tpl->tpl_vars['res']->value->result))) {?>
	<h4>Wynik</h4>
	<p class="res"><?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>
</p>
<?php }?>

</div>

</div>

<?php
}
}
/* {/block 'content'} */
}
