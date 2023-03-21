window.onload = () => {
  let register_btn = document.getElementById("register-button");
  register_btn.addEventListener("click", (e) => {
    register(e);
  });
  $base_url = "http:/127.0.0.1:8000/api/dating/";

  function register(e) {
    e.preventDefault();
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let first_name = document.getElementById("name").value;
    let birth_date = document.getElementById("birth_date").value;
    let bio = document.getElementById("bio").value;
    let gender = null;

    const maleRadio = document.getElementById("male");
    const femaleRadio = document.getElementById("female");

    if (maleRadio.checked) {
      gender = maleRadio.value;
    } else if (femaleRadio.checked) {
      gender = femaleRadio.value;
    }

    let data = new FormData();
    data.append("email", email);
    data.append("password", password);
    data.append("name", first_name);
    data.append("birth_date", birth_date);
    data.append("gender", gender);
    data.append("bio", bio);

    axios
      .post("http://127.0.0.1:8000/api/dating/signup", data)
      .then((result) => {
        if (result.data.status == "success") {
          alert("registered succesfully");
        }
      })
      .catch((err) => {
        console.error(err);
      });
  }
};
