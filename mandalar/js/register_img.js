$(document).ready(function () {
  $(document).on("click", ".camera_icon", function () {
    $("input[name='image']").click();
  });

  $("input[name='image']").change(function () {
    var file = this.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#show_photo").attr("src", e.target.result);
    };
    reader.readAsDataURL(file);
    $("#cross").removeClass("d-none");
  });

  let img = document.getElementById("show_photo");
  $("#inputphoto").on("change", function () {
    img.src = URL.createObjectURL(this.files[0]);
    console.log("change");
    $(".cancel-icon").removeClass("d-none");
  });

  $(".cancel-icon").on("click", function () {
    $("#show_photo").attr("src", "image/user-profile/mylove.jpg");
    $("#inputphoto").val("");
    $(".cancel-icon").addClass("d-none");
    console.log($("#inputphoto").val());
  });

  //check password space
  $("#passwordInput").on("input", function () {
    $(this).val(function (_, value) {
      return value.replace(/\s/g, ""); // Remove spaces
    });
  });
// Toggle password visibility
$("#togglePassword").on("click", function () {
  console.log("Click");
  var passwordInput = $("#passwordInput");
  var passwordFieldType = passwordInput.attr("type");

  // Toggle password field type between "password" and "text"
  if (passwordFieldType === "password") {
    passwordInput.attr("type", "text");
    $(this).removeClass("fa-eye").addClass("fa-eye-slash");
  } else {
    passwordInput.attr("type", "password");
    $(this).removeClass("fa-eye-slash").addClass("fa-eye");
  }
});


  $("#passwordInput").on("focus keyup", function () {
    var password = $("#passwordInput").val();
    var message =
      "The password must contain both an uppercase letter, lowercase letter, one number, and be 6 to 8 characters long.";
    // Check for uppercase letter and lowercase letter
    if (/(?=.*[A-Z])/.test(password) && /(?=.*[a-z])/.test(password)) {
      message =
        "The password must contain at least one number and be 6 to 8 characters long.";
      // Check for number
      if (/(?=.*\d)/.test(password)) {
        // Check password length
        if (password.length >= 6 ) {
          message = ""; // Empty message when the password length is between 6 and 8
        } else {
          message = "Password must be 6 to 8 characters long.";
        }
      } else {
        message =
          "The password must contain at least one number and be 6 to 8 characters long.";
      }
    }
    
    // Check if all fields are completed and hide the message
    if ($(".register-form input").filter(function () {
      return $(this).val() === "";
    }).length === 0) {
      message = ""; // Empty message when all fields are completed
    }
    
    $("#passwordRequirements").text(message);
  })
  //check password length
  // var password = $("#pass").val();
  // if (password.length >= 6) {
  //   console.log("It's over");
  //   $("#passwordRequirements").empty();
  // }
});
