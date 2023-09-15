$(document).ready(function(){
    $('.view_btn').on('click', function(event){
        event.preventDefault();
        let post_id=$(this).data('post-id')
        let user_id=$(this).data('user-id')
        $.ajax({
            url: 'php/view_count.php',
            type: 'GET',
            data: { post_id: post_id, user_id: user_id },
            success: function(data) {
                window.location.href = 'productDetail.php?id=' + post_id;
            },
        });
    })
})

 function addViewCount(userId,PostId){
    let post_id= PostId
    let user_id= userId
    $.ajax({
        url: 'php/view_count.php',
        type: 'GET',
        data: { post_id: post_id, user_id: user_id },
        success: function(data) {
            window.location.href = 'productDetail.php?id=' + post_id;
        },
    });

}


