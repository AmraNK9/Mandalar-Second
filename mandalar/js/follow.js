let Link = window.location.href;
console.log(Link);
$(document).ready(function () {
  from_id = $("#from_id").val();
  to_id = $("#to_id").val();
  followcon = $("#followcon").val();
  console.log(followcon);
  if (followcon == "true") {
    $("#unfollow").removeClass("d-none");
  } else {
    $("#follow").removeClass("d-none");
  }

  $("#followfake").on("click",function(e){
    e.preventDefault();
  })
  
  $("#messagefake").on("click",function(e){
    e.preventDefault();
  })

  $("#follow").on("click", function (e) {
    console.log("follow");
    $(this).addClass("d-none");
    state = 1;
    $.ajax({
      type: "POST",
      url: "checkfollow.php",
      data: { from_id: from_id, to_id: to_id, state: state,link:Link },
      success: function (response) {
        console.log(response);
      },
    });

  //   function fetchNotifications(to_id) {
  //     // Make an AJAX request to fetch new notifications

  //     $.ajax({
  //         url: 'get_notifications.php', // Replace with the URL of your PHP script that fetches notifications
  //         type: 'POST',
  //         data:{to_id:to_id},
  //         success: function (response) {
  //           let textuser=JSON.parse(response);
  //           console.log(textuser)
  //           $.ajax({
  //             url:"getAllUser.php",
  //             type:"POST",
  //             data:{from_id:from_id},

  //             success:function(response)
  //             {
  //               username=JSON.parse(response)
  //               //console.log(username.fname)
  //               for (let index = 0; index < username.length; index++) {
  //                 const element = username[index];
                  
  //                   $('.dropdown-menu').append('<li class="dropdown-item">' + element.fname+" "+element.lname +"is Following You"+ '</li>');
                  
  //               }
                
  //             }
  //           })
  //         },
  //         error: function (error) {
  //             console.error('Error fetching notifications:', error);
  //         }
  //     });
  // }
  
  // fetchNotifications(to_id);

    // Use setInterval correctly by passing the to_id value to the fetchNotifications function
    // setInterval(function () {
    //   fetchNotifications(to_id);
    // }, 500000); // 5 seconds interval (adjust as needed)
  
    $("#unfollow").removeClass("d-none");
    e.preventDefault();
    
  });

  
  $("#unfollow").on("click", function (e) {
    $(this).addClass("d-none");
    $("#follow").removeClass("d-none");
    state = 0;
    $.ajax({
      type: "GET",
      url: "getAllFollow.php",
      dataType: "json",
      success: function (response) {
        for (let i = 0; i < response.length; i++) {
          const obj = response[i];
          if (from_id == obj.from_id && to_id == obj.to_id) {
            console.log("It Equal")
          id = obj.id;
          console.log(id);
          $.ajax({
            type: "POST",
            url: "checkfollow.php",
            data: { id: id, state: state ,link: Link },
            success: function (response) {
              console.log(response)
            },
          });
        }
        }
        
      },
    });
    e.preventDefault();
  });

  
});
