// Function to delete the image preview
function deleteImagePreview(imageElement) {
    const imagePreviewsContainer = document.getElementById("imagePreviews");
    imagePreviewsContainer.removeChild(imageElement);
}
// JavaScript to handle multiple image selection and preview
document.getElementById("imageUpload").addEventListener("change", function(event) {
    const imagePreviewsContainer = document.getElementById("imagePreviews");
    // imagePreviewsContainer.innerHTML = '';

    const files = event.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = function() {
            const imagePreview = document.createElement("img");
            // const imageLabel = document.createElement("h1")
            // let content = "image " + i;
            // imageLabel.append(content)
            imagePreview.src = reader.result;
            imagePreview.className = "preview-image";
            
            imagePreviewsContainer.prepend(imagePreview);
            
            // Bind the deleteImagePreview function to the click event of the image
            imagePreview.addEventListener("click", function() {
                deleteImagePreview(imagePreview);
            });

        };

        reader.readAsDataURL(file);
    }

    // if (files.length === 0) {
    //     const imageLabel = document.getElementById("imageLabel");
    //     imageLabel.style.display = "block";
    // } else {
    //     const imageLabel = document.getElementById("imageLabel");
    //     imageLabel.style.display = "none";
    // }

    
    
});
// $('#post_save').on('click',function(){
//     console.log('clicked');
//     if($('#item-name').val()==='') {
//         $('#name-error').css('display', 'block');
//         error=true;
//       }else{
//         $('#name-error').css('display', 'none');
//       }
// })

// add Category

let xhr = new XMLHttpRequest();
const categorySelect = document.getElementById('post-category');
xhr.open("POST", "php/category.php", true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

xhr.onload = () => {
  if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status === 200) {
      let data = JSON.parse(xhr.response);
      
      data.forEach(cate => {
        const option = document.createElement('option');
        option.value = cate.id;
        option.textContent = cate.name;
        categorySelect.appendChild(option);
      });
    }
  }
};
xhr.send(); 
let xhr1 = new XMLHttpRequest();
let postsubcategory = document.getElementById('post_subcategory');

// Clear existing options in the select element
while (postsubcategory.firstChild) {
    postsubcategory.removeChild(postsubcategory.firstChild);
}

xhr1.open("POST", "php/sub_category.php", true);
xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

xhr1.onload = () => {
    if (xhr1.status === 200) {
        try {
            let data1 = JSON.parse(xhr1.response);
            console.log(data1);

            data1.forEach(cate => {
                const option = document.createElement('option');
                option.value = cate.id;
                option.textContent = cate.name;
                postsubcategory.appendChild(option);
            });
        } catch (error) {
            console.error('Error parsing response as JSON:', error);
            // Handle the JSON parsing error here, e.g., show an error message to the user
        }
    } else {
        console.error('Request failed. Status:', xhr1.status);
        // Handle other error scenarios here, e.g., show an error message to the user
    }
};


// Send the XMLHttpRequest
xhr1.send("cate_val=" + encodeURIComponent(1));


    let xhr2 = new XMLHttpRequest();
    categorySelect.addEventListener('change', () => {
        let cate_val=categorySelect.value;
        let post_subcategory=document.getElementById('post_subcategory');
        while (post_subcategory.firstChild) {
            post_subcategory.removeChild(post_subcategory.firstChild);
          }
        console.log(cate_val);
        let xhr2 = new XMLHttpRequest();
        xhr2.open("POST", "php/sub_category.php", true);
        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
        xhr2.onload = () => {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
            let data = JSON.parse(xhr2.response);
            console.log(data);
            
            data.forEach(cate => {
                const option = document.createElement('option');
                option.value = cate.id;
                option.textContent = cate.name;
                post_subcategory.appendChild(option);
            });
            }
        }
        };
        xhr2.send("cate_val=" + encodeURIComponent(cate_val));
      });

// add category end



document.getElementById('post_save').addEventListener('click', function() {
    console.log('clicked');
    error=false;
    var nameInput = document.getElementById('item-name');
    var nameError = document.getElementById('name-error');
    
    if (nameInput.value === '') {
        nameError.style.display = 'block';
        error = true; // Assuming you have defined `error` somewhere.
    } else {
        nameError.style.display = 'none';
    }

    var brandInput = document.getElementById('brand');
    var brandError = document.getElementById('brand-error');

    if (brandInput.value === '') {
        brandError.style.display = 'block';
        error = true; // Assuming you have defined `error` somewhere.
        
    } else {
        brandError.style.display = 'none';
    }

    var priceInput = document.getElementById('price');
    var priceError = document.getElementById('price-error');

    if (priceInput.value === '') {
        priceError.style.display = 'block';
        error = true; // Assuming you have defined `error` somewhere.
        
    } else {
        priceError.style.display = 'none';
    }
    var imagePreviews = document.getElementById('imagePreviews');
  var imagePreviewsError = document.getElementById('imagePreviews_error');

  if (imagePreviews.querySelectorAll('img').length > 0) {
    // The <div> contains an <img> tag
    imagePreviewsError.style.display = 'none';
  } else {
    // The <div> does not contain an <img> tag
    imagePreviewsError.style.display = 'block';
    error = true; // Assuming you have defined `error` somewhere.
  }

  if (error == false) {
    // Get the form element by ID
    
    let form = document.getElementById('form');
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/post_form.php", true);
    xhr.onload = () => {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          let data = xhr.response;
          console.log(data)
          if(data === "success"){
            alert("Posted Successfully");
            location.reload();

          }else{
            alert(data);
          }
        }
      }
    };
    let formData = new FormData(form);
    xhr.send(formData);
  }
});