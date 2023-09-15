$(document).ready(function(){
    $('#go_take').on('click',function(){
        let status="go_take";
        let post_id=$('#post_id').data('post-id');
        $.ajax({
            url:'php/deli_status_btn.php',
            type:'GET',
            data:{status:status,post_id:post_id},
            success: function(data){
                
                if(data=='success'){
                    let btn=`<button href="" class="btn btn-primary" id="taken">Taken</button>`
                    $('#btn-container').empty();
                    $('#btn-container').append(btn);
                }
            }
        })
    })
    $('#taken').on('click',function(){
        let status="take";
        let post_id=$('#post_id').data('post-id');
        $.ajax({
            url:'php/deli_status_btn.php',
            type:'GET',
            data:{status:status,post_id:post_id},
            success: function(data){
                console.log(data);
                if(data=='success'){
                    let btn=`<p style="width:80px; height:40px; border-radius:9px; display:flex; justify-content:center; align-items:center;" class="bg-success text-white">Done</p>`
                    $('#btn-container').empty();
                    $('#btn-container').append(btn);
                }
            }
        })
    })
    $('#go_send').on('click',function(){
        let status="go_send";
        let post_id=$('#post_id').data('post-id');
        $.ajax({
            url:'php/deli_status_btn.php',
            type:'GET',
            data:{status:status,post_id:post_id},
            success: function(data){
                console.log(data);
                if(data=='success'){
                    let btn=`<button href="" class="btn btn-primary" id="send">Send</button>`
                    $('#btn-container').empty();
                    $('#btn-container').append(btn);
                }
            }
        })
    })
    $('#send').on('click',function(){
        let status="sold_out";
        let post_id=$('#post_id').data('post-id');
        $.ajax({
            url:'php/deli_status_btn.php',
            type:'GET',
            data:{status:status,post_id:post_id},
            success: function(data){
                console.log(data);
                if(data=='success'){
                    let btn=`<p style="width:80px; height:40px; border-radius:9px; display:flex; justify-content:center; align-items:center;" class="bg-success text-white">Sold Out</p>`
                    $('#btn-container').empty();
                    $('#btn-container').append(btn);
                }
            }
        })
    })
})