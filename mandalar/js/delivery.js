$(document).ready(function() {
    console.log('hello');
    $('#take').on('click', function(){
        $('#take').removeClass('btn-secondary');
        $('#take').addClass('btn-success');
        $('#send').removeClass('btn-success');
        $('#send').addClass('btn-secondary');
        // Your JavaScript
        $.ajax({
            url: 'php/take_deli.php',
            type: 'GET',
            success: function(data) {
                // Assuming the 'data' is an array of objects, containing each post's information
                $('#wave-container').empty(); // Clear the container before appending new waves
                data.forEach(post => {
                    let wave = ''; // Initialize the 'wave' variable
        
                    // Check the 'status' field and create appropriate wave HTML
                    var folderPath = '../image/post_img/'+post['photo_folder']+'/'; 
                $.ajax({
                    url: folderPath,
                    success: function(data1) {
                    var files = $(data1).find('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]');
                    var firstImage = files.first().attr('href');
                    if (post['status'] === 'take_waiting') {
                        wave = `
                            <div class="content">
                                <div class="card mb-3" style="width: 500px; height:90px">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img src="`+folderPath+firstImage+`" class="img-fluid rounded-start mt-4 ms-2" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p class="card-text">item name: ${post['item']}</p>
                                                <p class="card-text">price: ${post['price']}mmk</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <a href="deli_detail.php?id=`+post['id']+`" class="btn btn-info">view</a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    } else if (post['status'] === 'go_take') {
                        wave = `
                            <div class="content">
                                <div class="card mb-3" style="width: 500px; height:90px">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img src="../image/user-profile/mylove.jpg" class="img-fluid rounded-start mt-4 ms-2" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p class="card-text">item name: ${post['item']}</p>
                                                <p class="card-text">price: ${post['price']}mmk</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <a href="deli_detail.php?id=`+post['id']+`" class="btn btn-warning">view</a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    }
        
                    $('#wave-container').append(wave); }
                })// Append the 'wave' HTML to the container
                });
            }
        });

    })
    $('#send').on('click', function(){
        $('#send').removeClass('btn-secondary');
        $('#send').addClass('btn-success');
        $('#take').removeClass('btn-success');
        $('#take').addClass('btn-secondary');
        $.ajax({
            url: 'php/send_deli.php',
            type: 'GET',
            success: function(data) {
                // Assuming the 'data' is an array of objects, containing each post's information
                $('#wave-container').empty(); // Clear the container before appending new waves
                data.forEach(post => {
                    let wave = ''; // Initialize the 'wave' variable
                    var folderPath = '../image/post_img/'+post['photo_folder']+'/'; 
                    $.ajax({
                    url: folderPath,
                    success: function(data1) {
                    var files = $(data1).find('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]');
                    var firstImage = files.first().attr('href');
                    // Check the 'status' field and create appropriate wave HTML
                    if (post['status'] === 'send_waiting') {
                        wave = `
                            <div class="content">
                                <div class="card mb-3" style="width: 500px; height:90px">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img src="`+folderPath+firstImage+`" class="img-fluid rounded-start mt-4 ms-2" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p class="card-text">item name: ${post['item']}</p>
                                                <p class="card-text">price: ${post['price']}mmk</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <a href="deli_detail.php?id=`+post['id']+`" class="btn btn-info">view</a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    } else if (post['status'] === 'go_send') {
                        wave = `
                            <div class="content">
                                <div class="card mb-3" style="width: 500px; height:90px">
                                    <div class="row g-0">
                                        <div class="col-md-2">
                                            <img src="`+folderPath+firstImage+`" class="img-fluid rounded-start mt-4 ms-2" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <p class="card-text">item name: ${post['item']}</p>
                                                <p class="card-text">price: ${post['price']}mmk</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4">
                                            <a href="deli_detail.php?id=`+post['id']+`" class="btn btn-warning">view</a>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    }$('#wave-container').append(wave); }
                })
                // Append the 'wave' HTML to the container
                });
            }
        });
    })
    
    
})