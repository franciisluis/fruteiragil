<?php
	require_once('inc.funcao.php');
?>

<form action = "acao.categoria.php" method="POST">
	<div class="container">
	<table class="table table-condensed table-striped table-bordered table-hover">
		<input type="hidden" name="acao" value="insert">
		<?php
			if((isset($_GET['id_categoria'])) and !empty($_GET['id_categoria'])){
				$id_categoria =  $_GET['id_categoria'];
				$query = 'SELECT * FROM categoria WHERE id_categoria='.$id_categoria;
				$retorno = mysql_query($query,$link);
				if(mysql_num_rows($retorno)>0){
					$linha=mysql_fetch_assoc($retorno);
					$nome=$linha['nome_categoria'];
					$acao="update";
				}else{
					$nome="";
					$acao="insert";
				}
			}else{
				$nome="";
				$acao="insert";
			}
		?>
		<!--<form action="acao.cadastrarcategoria.php" method="POST">-->
	
		<?php
			if ($acao == 'update') {
				echo '<input type="hidden" name="id_categoria" value="'.$id_categoria.'">';
				echo '<input type="hidden" name="acao" value="update">';
			} else {
				echo '<input type="hidden" name="acao" value="insert">';	
			}
		?>
	
		<tr>
			<td colspan="2" align="center">CADASTRAR CATEGORIA</td>
		</tr>
		<tr>
			<td align="center">NOME</td>
			<?php
				echo '<td align="center"><input type="text" name="nome_categoria" value=" '.$nome.'"</td>';
			?>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="botao" value="ENVIAR"></td>
		</tr>
	</table>
	</div>
</form>
<div class="container">
	<h2> Lista Categoria</h2>
	<table class="table table-condensed table-striped table-bordered table-hover">

		<tr>

			<td align="center"> ID </td>
			<td align="center"> Nome </td>
			<td align="center"> Acao </td>
		</tr>
	<?php
		
		$itens=busca($link);

		imprime($itens);
	?>
	</table> 
</div>
