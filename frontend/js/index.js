window.onload = () => {
  const main_container = document.getElementById("main_container");

  let data = "";
  axios.get("http://127.0.0.1:8000/api/dating/getMales").then((result) => {
    console.log(result.data);
    result.data.data.forEach((element) => {
      console.log(element);
      data += `<div class="card">
              <img src="../backend/storage/app/public/images/${element.profile_img}"  style="width:100%">
              <div class="container">
                  <h4><b>${element.name}</b></h4>
                  <p>${element.birth_date}</p>
              </div>
          </div>`;
    });
    main_container.innerHTML = data;
  });
};
