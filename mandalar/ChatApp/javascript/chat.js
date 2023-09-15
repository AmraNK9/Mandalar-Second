const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("#send"),
chatBox = document.querySelector(".chat-box");
icon = document.getElementById('myIcon');

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
        icon.style.display = 'none';
        inputField.style.width='calc(100% - 60px)';
    }else{
        sendBtn.classList.remove("active");
        icon.style.display = 'block';
        inputField.style.width='calc(100% - 120px)';
    }
}
icon.onclick = ()=>{
    console.log('icon clicked')
    document.getElementById('image-input').click();
}

  document.getElementById('image-input').addEventListener('change', function() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-img.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
  });
sendBtn.onclick = ()=>{
    // inputField.value = "";

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
        inputField.value = "";

          if(xhr.status === 200){
            //   inputField.value = " ";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 50);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  