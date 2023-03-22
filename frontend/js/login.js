window.onload = () => {
  let login_btn = document.getElementById("login-button");
  login_btn.addEventListener("click", login);

  function login() {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    let data = new FormData();
    data.append("email", email);
    data.append("password", password);

    axios
      .post("http://127.0.0.1:8000/api/dating/login", data)
      .then((result) => {
        console.log(result.data.authorisation.token);
        if (result.data.authorisation.token) {
          console.log(result.data.authorisation.token);
          localStorage.setItem("token", result.data.authorisation.token);
          alert("logedin");
        }
      })
      .catch((err) => {
        console.error(err);
      });
  }
};
