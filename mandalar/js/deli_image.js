$(document).ready(function() {
    // When the icon is clicked
    $('.deli-profile-img').on('click', function() {
      // Trigger click event on the hidden file input
      $('#deli_profile_img_input').trigger('click');
    });
  
    // When an image is selected
    $('#deli_profile_img_input').attr('accept', 'image/*').on('change', function(e) {
      var file = e.target.files[0];
    
      if (!file) {
        return;
      }
    
      var reader = new FileReader();
    
      reader.onload = function(e) {
        var img = $('<img>').attr('src', e.target.result).attr('name', 'deli_profile_img');
        $('.deli-profile-img').empty().append(img).show();
      };
    
      reader.readAsDataURL(file);
    });
    

      // When the icon is clicked
      $('.nrc_front_img_but').on('click', function() {
        // Trigger click event on the hidden file input
        $('#deli_front_nrc_img_input').trigger('click');
      });
    
      // When an image is selected
      $('#deli_front_nrc_img_input').attr('accept', 'image/*').on('change', function(e) {
        var file = e.target.files[0];

        if (!file) {
          return;
        }
        var reader = new FileReader();
    
        reader.onload = function(e) {
          // Create an image element
          var img = $('<img>').attr('src', e.target.result).attr('name','front_nrc_image');
    
          // Create a text element
          
    
          // Empty the image container and append the image and text
          $('#nrc_front_img').empty().append(img).show();
        };
    
        reader.readAsDataURL(file);
      });

        // When the icon is clicked
    $('.nrc_back_img_but').on('click', function() {
      // Trigger click event on the hidden file input
      $('#deli_back_nrc_img_input').trigger('click');
    });
  
    // When an image is selected
    $('#deli_back_nrc_img_input').attr('accept', 'image/*').on('change', function(e) {
      var file = e.target.files[0];
      
      if (!file) {
        return;
      }
      var reader = new FileReader();
  
      reader.onload = function(e) {
        // Create an image element
        var img = $('<img>').attr('src', e.target.result).attr('name','back_nrc_image');
  
        // Create a text element
        
  
        // Empty the image container and append the image and text
        $('#nrc_back_img').empty().append(img).show();
      };
  
      reader.readAsDataURL(file);
    });
  });