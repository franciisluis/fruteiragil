<form action="acao.requisicao_venda.php" method="POST">

	<div class="container">
		<table class="table table-condensed table-striped table-bordered table-hover">
		<input type="hidden" name="acao" value="insert">

		<?php
			if(isset($_GET['id_requisicao']) and !empty($_GET['id_requisicao'])){
				$id_requisicao = $_GET['id_requisicao'];
				$query = 'SELECT * FROM requisicao_venda WHERE id_requisicao='.$id_requisicao;
				$retorno = mysql_query($query,$link);
				if(mysql_num_rows($retorno)>0){
					$linha=mysql_fetch_assoc($retorno);
					$id_produto=$linha['id_produto'];
					$id_venda=$linha['id_venda'];
					$quantidade=$linha['qtd'];
					$valor=$linha['valor'];
					$acao="update";
				}else{
					$id_produto="";
					$id_venda="";
					$quantidade="";
					$valor="";
					$acao="insert";
				}
			}else{
					$id_produto="";
					$id_venda="";
					$quantidade="";
					$valor="";
					$acao="insert";
			}
		?>
		<?php
			if ($acao == 'update') {
				echo '<input type="hidden" name="id_requisicao" value="'.$id_requisicao.'">';
				echo '<input type="hidden" name="acao" value="update">';
			} else {
				echo '<input type="hidden" name="acao" value="insert">';	
			}
		?>
			<tr>
				<td colspan="2" align="center">CADASTRAR ITENS DA VENDA</td>
			</tr>
		
		<tr>
			<td align="center">produto</td>
			<td align="center">
			<select name="id_produto">
				<?php

					$query = 'SELECT id_produto, nome_produto FROM produto ORDER BY nome_produto';

					$res = mysql_query($query,$link);

					$qtd=mysql_num_rows($res); //numero de linhas

					if($qtd>0){
						while($linha=mysql_fetch_assoc($res)){
							if($linha['id_produto']==$id_produto){
								echo '<option selected="'.$id_produto.'" value= "'.$linha['id_produto'].'">'.$linha['nome_produto'].'</option>';
							}else{
								echo '<option value= "'.$linha['id_produto'].'">'.$linha['nome_produto'].'</option>';		
							}
						}
					}
				?>
				
			</select>
			</td>
		</tr>
		<tr>	
			<td align="center">QUANTIDADE</td>
			<?php
				echo '<td align="center"><input type="text" name="qtd" value="'.$quantidade.'"</td>';
			?>
		</tr>
		<tr>
			<td align="center">VALOR UNITARIO</td>
		<?php
			echo '<td align="center"><input type="text" name="valor" value=" '.$valor.'"</td>';
		?>
		</tr>
		<tr>
			<td align="center">VENDA</td>
		<td align="center">
		<select name="id_venda">
			<?php

				$query = 'SELECT nome_cliente,id_venda FROM venda INNER JOIN cliente ON cliente.id_cliente=venda.id_cliente ORDER BY nome_cliente';

				$res = mysql_query($query,$link);

				$qtd=mysql_num_rows($res); //numero de linhas

				if($qtd>0){
					while($linha=mysql_fetch_assoc($res)){
				
						if($linha['id_venda']==$id_venda){
							echo '<option selected="'.$linha['id_venda'].'">'.$linha['id_venda'].' - '.$linha['nome_cliente'].'</option>';
						}else{
							echo '<option value= "'.$linha['id_venda'].'">'.$linha['id_venda'].' - '.$linha['nome_cliente'].'</option>';	
						}
					}
				}
			?>
				
		</select>
		</td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="botao" value="ENVIAR"></td>
		</tr>
	</table>

</form>
<div class="container">
	<h2> Lista Requisição vendas</h2>
	<table class="table table-condensed table-striped table-bordered table-hover">

		<tr>

			<td align="center"> ID </td>
			<td align="center"> Produto </td>
			<td align="center"> Valor </td>
			<td align="center"> Venda </td>
			<td align="center"> qtd </td>
			<td align="center"> Ação </td>
		</tr>

		<?php
			$query = 'SELECT id_requisicao,valor,id_venda,qtd,nome_produto FROM requisicao_venda INNER JOIN produto ON requisicao_venda.id_produto=produto.id_produto';

			$res = mysql_query($query,$link);
			//echo $res;

			$qtd=mysql_num_rows($res); //numero de linhas
			//echo $qtd;

			if($qtd>0){
				while($linha=mysql_fetch_assoc($res)){
					echo '<tr>';
					echo '<td align="center">'. $linha['id_requisicao'].'</td>';
					echo '<td align="center">'. $linha['nome_produto'].'</td>';
					echo '<td align="center">'. $linha['valor'].'</td>';
					echo '<td align="center">'. $linha['id_venda'].'</td>'; 
					echo '<td align="center">'. $linha['qtd'].'</td>';

					echo '<td align="center">
							<a href="index.php?pg=requisicao_venda&id_requisicao='.$linha['id_requisicao'].'"> Editar </a> ||
							<a href="acao.requisicao_venda.php?acao=delete&id_requisicao='.$linha['id_requisicao'].'"> Excluir </a>
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