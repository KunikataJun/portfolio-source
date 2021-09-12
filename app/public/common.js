function logout() {
	axios.post(AUTH_API, {
		action: 'logout'
	})
	.then(function (response) {
		if (response.data == 'success') {
			location.href = LOGIN_PAGE;
		}
	});
}