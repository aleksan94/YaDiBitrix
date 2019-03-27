<?
if(!function_exists('token_list')) {
	function token_list_html() {
		\Bitrix\Main\Loader::includeModule('yadi');
		$yadi_db = new \YaDi\DataBase();

		$arTokenList = $yadi_db->GetTokenList();

		ob_start();
		?>
		<tr>
			<th width="45%"><center>Название</center></th>
			<th width="45%"><center>Токен</center></th>
			<th><center></center></th>
		</tr>
		<?foreach ($arTokenList as $value):?>
			<tr>
				<td><center><?=$value['name']?></center></td>
				<td><center><?=$value['token']?></center></td>
				<td><span class="bx-core-popup-menu-item-icon adm-menu-delete" name="delete_token" token-id="<?=$value['id']?>" style="margin-top: -16px; cursor: pointer;"></span></td>
			</tr>
		<?endforeach;
		$token_list_html = ob_get_contents();
		ob_end_clean();
		return $token_list_html;
	}
}
?>

<script type="text/javascript">
	$(document).ready(function() {
		$('[name="delete_token"]').on('click', function() {
			let obj = $(this);
			let tokenID = obj.attr('token-id');
			if(tokenID.length > 0) {
				if(confirm('Удалить токен?')) {
					$.post('/local/modules/YaDi/admin/ajax/delete_token.php', {id: tokenID}, function(response) {
						if(response.code == 1000) {
							obj.closest('tr').remove();
						}
					}, 'json');
				}
			}
		});
	});
</script>