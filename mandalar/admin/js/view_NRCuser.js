

$(document).ready(function() {
    $("#acceptNRC").on("click", function(event) { // Pass the event as an argument
         // Prevent the default behavior of the button click
        nrcnumber = $("#nrcnumber").val();
        userid = $("#userid").val();
        $.ajax({
            type: "POST",
            url: "updatestatus.php",
            data: { userid: userid },
            success: function(response) {
                console.log(response);
                $.ajax({
                    type: "POST",
                    url: "updateuser.php",
                    data: { nrcnumber: nrcnumber, userid: userid },
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
        $("#acceptNRC").addClass("d-none");
        console.log("Click");
        $("#deleteNRC").addClass("d-none");
        let message="Successfully Accept !"
        $("#successtext").text(message)
        event.preventDefault();
    });

    $("#deleteNRC").on("click", function() {
        userid = $("#userid").val();
        console.log(userid)
       
        $.ajax({
            type:"POST",
            url:"deletenrc.php",
            data:{userid:userid},
            success:function(response){
                console.log(response)

            }
        })


    })
});
