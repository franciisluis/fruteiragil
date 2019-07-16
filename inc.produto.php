<form action = "acao.produto.php" method="POST" enctype="multipart/form-data">
	<div class="container">
		<table class="table table-condensed table-striped table-bordered table-hover">
		<input type="hidden" name="acao" value="insert">
		<?php
			if(isset($_GET['id_produto']) and !empty($_GET['id_produto'])){
				$id_produto =  $_GET['id_produto'];
				$query = 'SELECT * FROM produto WHERE id_produto='.$id_produto;
				$retorno = mysql_query($query,$link);
				if(mysql_num_rows($retorno)>0){
					$linha=mysql_fetch_assoc($retorno);
					$nome=$linha['nome_produto'];
					$categoria=$linha['id_categoria'];
					$quantidade=$linha['qtd_produto'];
					$valor=$linha['valor_produto'];
					$imagem_produto = $linha['imagem_produto'];
					$acao="update";
				}else{
					$nome="";
					$categoria="";
					$quantidade="";
					$valor="";
					$acao="insert";
				}
			}else{
					$nome="";
					$categoria="";
					$quantidade="";
					$valor="";
					$acao="insert";
			}
		?>

		<?php
			if ($acao == 'update') {
				echo '<input type="hidden" name="id_produto" value="'.$id_produto.'">';
				echo '<input type="hidden" name="acao" value="update">';
			} else {
				echo '<input type="hidden" name="acao" value="insert">';	
			}
		?>
		<title>PRODUTOS</title>
		<tr>
			<td align="center"> Nome Do Produto</td>
			<?php
				echo '<td align="center"><input type="text" name="nome_produto" value="'.$nome.'"</td>';
			?>
		</tr>
		<tr>
			<td align="center">Categoria:</td>
			<td align="center">
			<select name="categoria">
				<?php

					$query = 'SELECT id_categoria, nome_categoria FROM categoria ORDER BY nome_categoria';

					$res = mysql_query($query,$link);

					$qtd=mysql_num_rows($res); //numero de linhas

					if($qtd>0){
						while($linha=mysql_fetch_assoc($res)){
							if($linha['id_categoria']==$categoria){
								echo '<option selected="'.$categoria.'" value= "'.$linha['id_categoria'].'">'.$linha['nome_categoria'].'</option>';
							}else{
								echo '<option value= "'.$linha['id_categoria'].'">'.$linha['nome_categoria'].'</option>';
							}

						}

					}
				?>	
			</select>
			</td>
		</tr>
		<tr>
			<td align="center"> Quantidade </td>
			<?php
				echo '<td align="center"><input type="text" name="qtd_produto" value=" '.$quantidade.'"</td>';
			?>
		</tr>
		<tr>
			<td align="center"> Imagem </td>
			<td align="center"><input type="file" name="imagem_produto"></td>
			<?php
				if($acao == 'update') {
					echo '<img src="img/'.$imagem_produto.'" width="60" height="80">';
				}
			?>
		</tr>
		<tr>
			<td align="center"> Valor </td>
			<?php
				echo '<td align="center"><input type="text" name="valor_produto" value=" '.$valor.'"</td>';
			?>
		</tr>
		<td colspan="2" align="center">
			<input type="submit" value="Enviar Dados">
			<input type="reset" value="Limpar Dados">
		</td>
		</table>
	</div>
</form>


<div class="container">
	<h2> Lista Produtos</h2>
		<table class="table table-condensed table-striped table-bordered table-hover">

		<tr>

			<td align="center"> ID </td>
			<td align="center"> Nome </td>
			<td align="center"> Quantidade </td>
			<td align="center"> Valor </td>
			<td align="center"> Categoria </td>
			<td align="center"> Imagem </td>
			<td align="center"> Acao </td>
		</tr>

		<?php
			$query = 'SELECT id_produto, nome_produto,qtd_produto,valor_produto,nome_categoria,imagem_produto FROM produto INNER JOIN categoria ON produto.id_categoria= categoria.id_categoria  ORDER BY nome_produto';

			$res = mysql_query($query,$link);
			//echo $res;

			$qtd=mysql_num_rows($res); //numero de linhas
			//echo $qtd;

			if($qtd>0){
				while($linha=mysql_fetch_assoc($res)){
					echo '<tr>';
					//echo $linha['imagem_produto'];
					echo '<td align="center">'. $linha['id_produto'].'</td>';
					echo '<td align="center">'. $linha['nome_produto'].'</td>';
					echo '<td align="center">'. $linha['qtd_produto'].'</td>';
					echo '<td align="center">'. $linha['valor_produto'].'</td>';
					echo '<td align="center">'. $linha['nome_categoria'].'</td>';
					echo '<td align="center"><img src="img/'.$linha['imagem_produto'].'" width="60" height="60"></td>';

					echo '<td align="center">
							<a href="index.php?pg=produto&id_produto='.$linha['id_produto'].'"> Editar </a> ||
							<a href="acao.produto.php?acao=delete&id_produto='.$linha['id_produto'].'"> Excluir </a>
							</td>';
				}
			}else{

				echo '<tr>
						<td collspan="3" > Nenhum registro para listrar </td>
					</tr>';

			}	
		?>
	</table>
</div>