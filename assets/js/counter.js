function count_char(val) {
	var len = val.value.length;

	if (len >= 500) {
		val.value = val.value.substring(0, 500);
		$('#remains').text(0);
	}
	else {
		$('#remains').text(500 - len);
	}
}