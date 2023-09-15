$(document).ready(function(){
    $('#withdraw_btn').on('click', function () {
        let error = true;
        if ($('#withdraw_kpay_name').val() !== "") {
            error = true;
            $("#with_kpay_name_error").addClass('d-none');
        } else {
            error = false;
            $("#with_kpay_name_error").removeClass('d-none');
        }

        if ($('#withdraw_kpay_ph').val() !== "") {
            error = true;
            $("#with_kpay_phone_error").addClass('d-none');
        } else {
            error = false;
            $("#with_kpay_phone_error").removeClass('d-none');
        }

        if ($('#withdraw_amount').val() !== "") {
            error = true;
            $("#with_kpay_amount_error").addClass('d-none');
        } else {
            error = false;
            $("#with_kpay_amount_error").removeClass('d-none');
        }
        if(error==true){
            $.ajax({
                url: 'php/withdraw.php', // Replace with the actual path to your PHP script
                method: 'POST', // You can use 'GET' or 'POST' depending on your needs
                data: $('#withdraw_form').serialize(), // Serialize the form data
                success: function(response) {
                    console.log (response);
                    if(response=='success'){
                        $('#with_kpay_not_enough_error').addClass('d-none')
                        alert('successfully')
                        location.reload();
                    }else if(response == "not enough"){
                        $('#with_kpay_not_enough_error').removeClass('d-none');
                    }
                    // You can perform additional actions here if needed
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occur during the AJAX request
                    console.error(xhr.responseText);
                }
            });
        }

    });
    
})