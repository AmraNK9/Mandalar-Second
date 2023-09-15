$(document).ready(function(){
    let user_id=$("#user_id").data('user_id');
    intervalId = setInterval(getSellerForm(), 500);
    function getSellerForm() {
        $.ajax({
            url: "seller_post.php",
            type: "GET",
            data: { user_id: user_id },
            success: function(data) {
                if(data != "don't stop"){
                    $("#seller-info-btn").click();
                    console.log(data);
                $("#seller-item-name").text(data[0])
                $("#seller-price").text(data[1])
                $("#seller-post-img").attr("src", data[2]);
                clearInterval(intervalId);
                }
            }
        })
    }
    $("#sell-btn").click(function() {
        let user_id=$("#user_id").data('user_id');
        let error = false;
        if ($("#seller-phone").val() == "") {
            $("#phone-error").css("display", "block");
            error = true;
        } else {
            $("#phone-error").css("display", "none");
        }
        if ($("#seller-address").val() == "") {
            $("#address-error").css("display", "block");
            error = true;
        } else {
            $("#address-error").css("display", "none");
        }
        if (error == false) {
            let form = document.getElementById('sell-form');
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/sell_form.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        console.log(data);
                        if (data === "success") {
                            let sellInfoClose = document.getElementById('sell-info-close');
                            let overlaySuccess = document.querySelector(".success-overlay");
                            console.log("success", sellInfoClose);
                            sellInfoClose.click();
                            overlaySuccess.style.display = "flex"
                            setTimeout(() => {
                                overlaySuccess.style.display = "none"
                            }, 1500)
                            location.reload();

                        } else {}
                    }
                }
            };
            let formData = new FormData(form);
            formData.append("user_id", user_id); // Add userId to formData
            xhr.send(formData);
        }
    });
      
        
        
    
})