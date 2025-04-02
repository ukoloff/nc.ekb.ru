function confirmAction(texte, url) {
	if (confirm ("Are you sur you want to to :\n\n" + texte)) {
		document.location = url;
	}
}