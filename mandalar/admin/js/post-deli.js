$(document).ready(function() {
    var selectedStatus = $('input[name="status"]:checked').val();
    let seller_city= $('#seller-city').val();
    let buyer_city= $('#buyer-city').val();
    $.ajax({
        url:'php/get_post.php',
        type:'GET',
        data:{seller_city:seller_city,buyer_city:buyer_city,selectedStatus:selectedStatus},
        success: function(data){
            for (let i = 0; i < data.length; i++) {
                var folderPath = '../image/post_img/'+data[i]['photo_folder']+'/'; 
                $.ajax({
                    url: folderPath,
                    success: function(data1) {
                    var files = $(data1).find('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]');
                    var firstImage = files.first().attr('href');
                    
                    let tr=`<tr>
                        <td>`+(i+1)+`</td>
                        <td><input type="checkbox" name="check_post[]" class="post-check" id="" value="`+data[i]['id']+`" data-post-id="`+data[i]['id']+`"></td>
                        <td><img src="`+folderPath+firstImage+`" alt="" height="50px"></td>
                        <td>`+data[i]['item']+`</td>
                        <td>`+data[i]['price']+`</td>
                        <td>`+data[i]['seller_city']+`</td>
                        <td>`+data[i]['buyer_city']+`</td>
                        <td><a href="post_detail.php?id=`+data[i]['id']+`" class="btn btn-warning">view</a></td>
                        </tr>`
                        $('#post_body').append(tr);
                    }
                    
                });
                
            }
            
        }
    })
    $('#buyer-city, #seller-city, input[name="status"]').on('change', function() {
        $('#post_body').empty();
        var selectedStatus = $('input[name="status"]:checked').val();
    let seller_city= $('#seller-city').val();
    let buyer_city= $('#buyer-city').val();
        $.ajax({
            url: 'php/get_post.php',
            type: 'GET',
            data: {seller_city:seller_city,buyer_city:buyer_city,selectedStatus:selectedStatus},
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    var folderPath = '../image/post_img/'+data[i]['photo_folder']+'/'; 
                    $.ajax({
                        url: folderPath,
                        success: function(data1) {
                        var files = $(data1).find('a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]');
                        var firstImage = files.first().attr('href');
                        
                        let tr=`<tr>
                            <td>`+(i+1)+`</td>
                            <td><input type="checkbox" name="check_post[]" id="" class="post-check" value="`+data[i]['id']+`" data-post-id="`+data[i]['id']+`"></td>
                            <td><img src="`+folderPath+firstImage+`" alt="" height="50px"></td>
                            <td>`+data[i]['item']+`</td>
                            <td>`+data[i]['price']+`</td>
                            <td>`+data[i]['seller_city']+`</td>
                            <td>`+data[i]['buyer_city']+`</td>
                            <td><a href="view_post.php?id=`+data[i]['id']+`" class="btn btn-warning">view</a></td>
                            </tr>`
                            
                            $('#post_body').append(tr);
                        }
                        
                    });
                    
                }
            }
        });
    });
    function updateCount() {
        const checkedCount = $('.post-check:checked').length;
        $('#check-count').text(`${checkedCount}`);
      }
  
      // Event delegation for the dynamically added checkboxes
      $(document).on('click', '.post-check', updateCount);
    

    // deli
    let deli_city= $('#deli-city').val();
        $.ajax({
            url: 'php/get_deli.php',
            type: 'GET',
            data: { deli_city: deli_city },
            success: function(data) {
                data.forEach(deli_man => {
                    let deli=`<div class="form-check fs-4 mt-3">
                    <input class="form-check-input" type="radio" name="delivery" id="`+deli_man['id']+`" value="`+deli_man['id']+`">
                    <label class="form-check-label" for="`+deli_man['id']+`" >
                        `+deli_man['name']+`
                    </label>
                </div>`
                $('.deli-container').append(deli);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    
    $('#save').on('click',function(){
        var postChecked = $("input[name='check_post[]']:checked").length > 0;
        var errorMsg = $("#post-check-error");
        let post_error=false;
        if (!postChecked ) {
          errorMsg.css('display', 'block');
          post_error = true;
        } else {
            errorMsg.css('display', 'none');
          // Perform further actions here if needed
        }
        if(post_error==false){
            $('#send-post').click();
        }
    })
    $('#send-deli').on('click',function(e){
        e.preventDefault();
        let deli_error = false;
        var deliChecked = $("input[name='delivery']:checked").length > 0;
        if(!deliChecked){
            $('#deli-error').css('display', 'block');
            deli_error = true;
        }else{
            $('#deli-error').css('display', 'none');
        }
        if(deli_error==false){
            let form = document.getElementById('deli-post-form');
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/deli_post_form.php", true);
            xhr.onload = () => {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        let data = xhr.response;
                        if(data=='success'){
                            alert("Success");
                            location.reload();
                        }
                    }
                }
            };
            let formData = new FormData(form);// Add userId to formData
            xhr.send(formData);
        }
    })
    $('#deli-city').on('change',function(){
        let deli_city= $('#deli-city').val();
        $.ajax({
            url: 'php/get_deli.php',
            type: 'GET',
            data: { deli_city: deli_city },
            success: function(data) {
                $('.deli-container').empty();
                data.forEach(deli_man => {
                    let deli=`<div class="form-check fs-4 mt-3">
                    <input class="form-check-input" type="radio" name="delivery" id="`+deli_man['id']+`" value="`+deli_man['id']+`">
                    <label class="form-check-label" for="`+deli_man['id']+`" >
                        `+deli_man['name']+`
                    </label>
                </div>`
                $('.deli-container').append(deli);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX Error:", textStatus, errorThrown);
            }
        });
    })
    
    
});
