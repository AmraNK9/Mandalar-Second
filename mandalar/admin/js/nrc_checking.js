$(document).ready(function () {
  filtervalue = $("#filterNRC").val();
  $("#deletetd").empty()
  
  if (filtervalue == 0) {
    $.ajax({
      type: "GET",
      url: "getAllNRC.php",
      success: function (response) {
        getAllNRCusers = JSON.parse(response);
        console.log(getAllNRCusers);
        // index=0;
        getAllNRCusers.forEach((getAllNRCuser,index) => {
           console.log(getAllNRCuser)
          userid = getAllNRCuser.to_id;
          // console.log(userid);
          showAll = "";
          // index++;
          $.ajax({
            type: "POST",
            url: "getusername.php",
            data: { userid: userid },
            success: function (response) {
              // Use ternary operator to handle the condition
              const checkButton =
                getAllNRCuser.status == 0 ? `btn btn-warning` : "btn btn-info";
              showAll = `<tr><td>${index+1}</td>
                            <td>${response}</td>
                            <td>${getAllNRCuser.nrc}</td>
                            <td>${getAllNRCuser.date}</td>
                            <td><a href="view_NRCuser.php?userid=${
                              getAllNRCuser.to_id
                            }" class="${checkButton}">View</a></td></tr>`;

              $(".showNRCuser").append(showAll);
            },
          });
        });
      },
    });
  }


  $("#filterNRC").on("change", function () {
    filterValue = $(this).val(); // Get the selected value of the dropdown
    $("#deletetd").empty()
    $(".showNRCuser").empty()

    if ($("#filterNRC").val() == 0) {
      // index=0;
      $("#deletetd").empty()
      $(".showNRCuser").empty()
        $.ajax({
          type: "GET",
          url: "getAllNRC.php",
          success: function (response) {
            getAllNRCusers = JSON.parse(response);
            console.log(getAllNRCusers);
            getAllNRCusers.forEach((getAllNRCuser,index) => {
              // console.log(getAllNRCuser)
              userid = getAllNRCuser.to_id;
              // console.log(userid);
              showAll = "";
              $.ajax({
                type: "POST",
                url: "getusername.php",
                data: { userid: userid },
                success: function (response) {
                  // Use ternary operator to handle the condition
                  const checkButton =
                    getAllNRCuser.status == 0 ? `btn btn-warning` : "btn btn-info";
                  showAll = `<tr class="0"><td>${index+1}</td>
                                <td>${response}</td>
                                <td>${getAllNRCuser.nrc}</td>
                                <td>${getAllNRCuser.date}</td>
                                <td><a href="view_NRCuser.php?userid=${
                                  getAllNRCuser.to_id
                                }" class="${checkButton}">View</a></td></tr>`;
    
                  $(".showNRCuser").append(showAll);
                },
              });
            });
          },
        });
      }

    if (filterValue == 1) {
      $("#deletetd").empty()
    $(".showNRCuser").empty()
   
      $.ajax({
        type: "GET",
        url: "getAllNRC.php",
        success: function (response) {
          getAllNRCusers = JSON.parse(response);
          showAll = "";
          getAllNRCusers.forEach((getAllNRCuser,index) => {
            userid=getAllNRCuser.to_id;
            if (getAllNRCuser.status == 1) {
                console.log("this is state1")
            $.ajax({
              type: "POST",
              url: "getusername.php",
              data: { userid: userid },
              success: function (response) {
                  showAll = `<tr class="1"><td>${index+1}</td>
                            <td>${response}</td>
                            <td>${getAllNRCuser.nrc}</td>
                            <td>${getAllNRCuser.date}</td>
                            <td><a href="view_NRCuser.php?userid=${
                              getAllNRCuser.to_id
                            }" class="btn btn-info">View</a></td>`;

                  $(".showNRCuser").append(showAll);
                        
              },
            });
        }
          });
        },
      });
    }

    if (filterValue == 2) {
      $("#deletetd").empty()
    $(".showNRCuser").empty()
  
            $.ajax({
              type: "GET",
              url: "getAllNRC.php",
              success: function (response) {
                getAllNRCusers = JSON.parse(response);
                
                showAll = "";
                getAllNRCusers.forEach((getAllNRCuser,index) => {
                    console.log(getAllNRCuser);
                    userid=getAllNRCuser.to_id;
                    console.log(getAllNRCuser.status)
                    if (getAllNRCuser.status == 0) {
                  $.ajax({
                    type: "POST",
                    url: "getusername.php",
                    data: { userid: userid },
                    success: function (response) {
                        console.log(response)
                        showAll = `<tr class="2"><td>${index+1}</td>
                                  <td>${response}</td>
                                  <td>${getAllNRCuser.nrc}</td>
                                  <td>${getAllNRCuser.date}</td>
                                  <td><a href="view_NRCuser.php?userid=${
                                    getAllNRCuser.to_id
                                  }" class="btn btn-warning">View</a></td>`;
      
                        $(".showNRCuser").append(showAll);
                      
                    },
                  });
                }else{
                    console.log("2 is not equal")
                }
                });
              },
            });
        
    }
  });
});
