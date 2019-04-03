function GetToken(arParams) {
	this.arParams = arParams;
	let a = document.createElement('a');
	a.text = "Получить токен";
	a.href = "/bitrix/admin/yadi_get_token.php";
	this.arParams.oCont.appendChild(a);
}