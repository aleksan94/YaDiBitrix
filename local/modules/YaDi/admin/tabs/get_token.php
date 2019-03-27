<tr>
	<td colspan="2">
		<div>Для получения токена, нужна авторизация сервиса <b>Yandex oAuth</b>, который будет обеспечивать доступ к <b>API Яндекс.Диска</b></div>
		<div>Для добавления доступов к Яндекс.Диску:</div>
		<div>
			<ol>
				<li>перейдите по <a href="https://oauth.yandex.ru/" target="_blank" title="Яндекс.oAuth">ссылке</a></li>
				<li>нажмите кнопку <b>Зарегистрировать новое приложение</b></li>
				<li>в <b>Название приложения</b> пишем произвольное именование</li>
				<li>в графе <b>Платформы</b> отмечаем <b>Веб-сервисы</b></li>
				<li>в появившемся поле <b>Callback URI</b> вставляем этот адрес <i><?="http://".$_SERVER['SERVER_NAME']."/bitrix/admin/yadi_get_token.php"?></i></li>
				<li>в графе <b>Доступы</b> ищем <b>Яндекс.Диск REST API</b> и в выпадающем списке отмечаем все галочки</li>
				<li>нажимаем кнопку <b>Создать приложение</b> внизу страницы</li>
			</ol>
		</div>
		<div>Теперь мы имеем <b>ID</b> и <b>Пароль</b> нашего приложения, которые нужно вставить в соответствующие поля для получения токена</div>
	</td>
</tr>
<tr>
	<td colspan="2">
		<center><h3>Параметры Yandex oAuth</h3></center>	
	</td>
</tr>
<tr class="adm-detail-required-field">
	<td width="40%">Client ID</td>
	<td width="60%"><input type="text" name="CLIENT_ID" style="width: 50%;"></td>
</tr>
<tr class="adm-detail-required-field">
	<td width="40%">Client Secret</td>
	<td width="60%"><input type="text" name="CLIENT_SECRET" style="width: 50%;"></td>
</tr>
<tr>
	<td width="40%">Имя токена (опционально)</td>
	<td width="60%"><input type="text" name="TOKEN_NAME" style="width: 50%;"></td>
</tr>
<tr>
	<td>
		<input type="submit" value="Получить токен" name="get_token_btn" onclick="" class="adm-btn-green">
	</td>
</tr>