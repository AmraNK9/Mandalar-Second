$(document).ready(function() {
  let form = $('#form');
  form.submit(function(e){
    e.preventDefault();
  });
    $('.submit').on('click', function(e){
        e.preventDefault();
        let error=false;

          // delivery profile image

          if ($('.deli-profile-img').find('img').length > 0) {
            // The <div> contains an <img> tag
            $('#deli_profile_img_error').css('display', 'none');
          } else {
            // The <div> does not contain an <img> tag
            $('#deli_profile_img_error').css('display', 'block');
            error=true;
          }

          // nrc front image

          if ($('#nrc_front_img').find('img').length > 0) {
            // The <div> contains an <img> tag
            $('#nrc_front_img_error').css('display', 'none');
          } else {
            // The <div> does not contain an <img> tag
            $('#nrc_front_img_error').css('display', 'block');
            error=true;
          }

          // nrc back image

          if ($('#nrc_back_img').find('img').length > 0) {
            // The <div> contains an <img> tag
            $('#nrc_back_img_error').css('display', 'none');
          } else {
            // The <div> does not contain an <img> tag
            $('#nrc_back_img_error').css('display', 'block');
            error=true;
          }

          // name error

        if($('#name').val()==='') {
          $('#name-error').css('display', 'block');
          error=true;
        }else{
          $('#name-error').css('display', 'none');
        }

        // phone error

        if($('#phone').val()==='') {
          $('#phone-error').css('display', 'block');
          error=true;
        }else{
          $('#phone-error').css('display', 'none');
        }

        // passwrod error

        // if($('#password').val()==='') {
        //   $('#password-error').css('display', 'block');
        //   error=true;
        // }else{
        //   $('#password-error').css('display', 'none');
        // }

        const password = $('#password').val();
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

if (password === '') {
  $('#password-error').text('Password is required').css('display', 'block');
  error = true;
} else if (!passwordRegex.test(password)) {
  $('#password-error').text('Password must contain at least one capital letter, one small letter, one number, and one special character').css('display', 'block');
  error = true;
} else {
  $('#password-error').css('display', 'none');
}


        

        // nrc error

        if($('#nrc').val()==='') {
          $('#nrc-error').css('display', 'block');
          error=true;
        }else{
          $('#nrc-error').css('display', 'none');
        }
        if (error == false) {
          // Get the form element by ID
          let form = document.getElementById('form');
          let xhr = new XMLHttpRequest();
          xhr.open("POST", "php/deli_signup.php", true);
          xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                let data = xhr.response;
                if(data === "success"){
                  alert('Delivery Account Created Successfully');
                 // Clear form inputs
                  $('#password').val("");
                  $('#nrc').val("");
                  $('#name').val("");
                  $('#phone').val("");
                  // Clear image sources
                  $('.deli-profile-img img').remove();
                  $('#nrc_front_img img').remove();
                  $('#nrc_back_img img').remove();

                  $('.deli-profile-img').append('<div class="pre_img">Profile</div>');
                  $('#nrc_front_img').append('<div class="pre_img">Back photo</div>');
                  $('#nrc_back_img').append('<div class="pre_img">Front photo</div>');

                }else{
                  alert(data);
                }
              }
            }
          };
          let formData = new FormData(form);
          xhr.send(formData);
        }
    })
    
})