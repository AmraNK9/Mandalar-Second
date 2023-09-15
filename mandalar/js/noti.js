const notiContainer = document.querySelector(".aa-cart-notify");
const NOti_container = document.querySelector("#notiContainer");

const user_id = notiContainer.dataset.userId;

let previousNotiCount = 0;
function loadNotiCount() {
  $.ajax({
    url: "php/loadnoticount.php",
    type: "GET",
    data: { user_id: user_id },
    success: function (data) {
      let notiCount = data;
      notiContainer.innerHTML = data;

      if (notiCount !== previousNotiCount) {
        // notiContainer.innerHTML = data;
        loadNoti();
      } 
      previousNotiCount = data;
      console.log("is reach");
      console.log(data);
      notiContainer.innerHTML = data;
    },
  });
}

function loadNoti() {
  $.ajax({
    url: "php/loadnoti.php",
    type: "GET",
    data: { user_id: user_id },
    success: function (data) {
      let noti = JSON.parse(data);
      console.log("load notification success");
      console.log("log from load-noti",noti);
      if(noti.length == 0){
        NOti_container.innerHTML = `    
        <div class="no-noti ">
            NO Notification
        </div>
 `;
    }else{
        NOti_container.innerHTML = "";
        noti.forEach((element) => {
          console.log(element);
          if (element.is_read == 0) {
            NOti_container.innerHTML += `<li><a onclick="linkto('${element.link}')" id=${element.id} class="dropdown-item noti_id " style="background-color:#b6c6cd" href="${element.link}">${element.content}</a></li>`;
          } else {
            NOti_container.innerHTML += `<li><a onclick="linkto('${element.link}')" id=${element.id} class="dropdown-item noti_id " href="${element.link}">${element.content}</a></li>`;
          }
          // NOti_container.innerHTML += `<li> <a onclick="linkto(${element.link})" class="dropdown-item" href = "${element.link}" >${element.content}</a></li>`
        });
    }

    
    //   console.log(NOti_container.innerHTML);
    },
  });
}

$(document).on("click", ".noti_id", function (event) {
  console.log(event.target.id);
  loadNoti();
  loadNoti();
  let id = event.target.id;
  $.ajax({
    url: "php/read_noti.php",
    type: "GET",
    data: { id: id },
    success: function (response) {
      console.log(response);
    },
  });
});

setInterval(
  ()=>{
    loadNotiCount()
  }
 ,500
)
;

function linkto(link) {
  // $(this).removeClass('')

  window.location.href = link;
}
