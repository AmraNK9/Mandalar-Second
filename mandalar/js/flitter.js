const fliteringData = {
	category: null,
	subCategory: null,
	"min-price": null,
	"max-price": null,
	"new-used": null,
};
const productContainer = document.querySelector("#products .row");
let loadCount = 0;

function ViewProduct(dataList) {
	console.log("flittering Data: ",fliteringData)
	productContainer.innerHTML = "";
	dataList.forEach((val, index) => {
		productContainer.innerHTML += `
                    <a href="productDetail.php?id=${
											val.id
										}" onclick="addViewCount(${val.buyer_id},${
			val.id
		})" class="view_btn col-md-4 col-sm-6  col-lg-3 mb-4 "> 
                    <div >
                    <div class="card product-card-by-nay">
                        <img src="image/${
													val.product_image
												}" class="card-img-top product-image" alt="${
			val.product_image
		}" />
                        <div class="card-body">
                            <div class = "product-card-title">
                            <h5 class="card-title">${val.item}</h5>
                            <h5>
                                ${val.price} Ks
                            </h5>
                             </div>
                           
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="image/user-profile/${
																			val.img
																		}" class="rounded-circle profile-on-card"
                                        alt="${val.img}" />
                                    <span class="ml-2 card-text">${
																			val.fname + val.lname
																		}</span>
                                </div>
                            </div>
                            <div class="product-info-box">
                                <div>
                                    <i class="fa-solid fa-thumbs-up"></i>
                                    <span class="reaction-count">${
																			val.Post_Reaction
																		}</span>
                                </div>
                                <div>
                                <i class="far fa-heart mr-2"></i>
                                    <span class="save-count">${
																			val.product_fav
																		}</span>
                                </div>
    
                                <div>
                                    <i class="far fa-eye ml-3"></i>
                                    <span class="view-count">${
																			val.view_count
																		}</span>
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                    </a>
                     
                        `;
	});
}

//Post Flittering Data
function PostFliteringData(obj) {
	let FlitteringReq = new XMLHttpRequest();

	FlitteringReq.open("POST", "php/flitter.php", true);
	FlitteringReq.setRequestHeader(
		"Content-Type",
		"application/x-www-form-urlencoded"
	);

	FlitteringReq.onload = () => {
		if (FlitteringReq.status === 200) {
			try {
				console.log(FlitteringReq.response)
				let dataList = JSON.parse(FlitteringReq.response);
				ViewProduct(dataList);

				dataList.forEach((data) => {});
			} catch (error) {
				console.error("Error parsing response as JSON:", error);
				// Handle the JSON parsing error here, e.g., show an error message to the user
			}
		} else {
			console.error("Request failed. Status:", FlitteringReq.status);
			// Handle other error scenarios here, e.g., show an error message to the user
		}
	};

	// Send the XMLHttpRequest
	FlitteringReq.send(
		"flitteringData=" + encodeURIComponent(JSON.stringify(obj))
	);
}

//Category radio flitter
const radioButtons = document.querySelectorAll(".category");
radioButtons.forEach(function (radio) {
	radio.addEventListener("change", function () {
		const selectedValue = this.value;
		if (selectedValue == "All") {
			// location.reload(true);
			$.ajax({
				url: "php/getAllPost.php",
				type: "post",
				data: { All: "All" },
				success: function (data) {
					fliteringData.category = null;
					loadPrice(0,'all')
					let datalist = JSON.parse(data);
					ViewProduct(datalist);
				},
			});
			disableSubCategory();
		} else {
			enableSubCategory();
			fliteringData.category = selectedValue;
			let xhr1 = new XMLHttpRequest();
			xhr1.open("POST", "php/sub_category.php", true);
			xhr1.setRequestHeader(
				"Content-Type",
				"application/x-www-form-urlencoded"
			);

			xhr1.onload = () => {
				if (xhr1.status === 200) {
					try {
						let data1 = JSON.parse(xhr1.response);
						const subCategoryOption = document.querySelector(
							"#sub-catgory-fliter"
						);

						subCategoryOption.innerHTML = "";
						fliteringData.subCategory = "All";
						loadCount = 10;
						PostFliteringData(fliteringData);

						loadPrice(fliteringData.category,"cat");
						subCategoryOption.innerHTML += `<option value="null">All</option>`;

						data1.forEach((cate) => {
							subCategoryOption.innerHTML += `
                      <option value= ${cate["id"]}>${cate["name"]}</option>
                      `;

						
						});
					} catch (error) {
						console.error("Error parsing response as JSON:", error);
						// Handle the JSON parsing error here, e.g., show an error message to the user
					}
				} else {
					console.error("Request failed. Status:", xhr1.status);
					// Handle other error scenarios here, e.g., show an error message to the user
				}
				// Send the XMLHttpRequest
			};
			xhr1.send("cate_val=" + encodeURIComponent(selectedValue));
		}
	});
});

//Sub category flitter
function postSubCategoryValue() {
	const selectElement = document.querySelector("#sub-catgory-fliter");
	let selectedValue = selectElement.value;
    if(selectedValue == "null"){
		fliteringData.subCategory = "All";

        loadPrice(fliteringData.category,"cat")
    }else{
        fliteringData.subCategory = selectedValue;
        loadPrice(selectedValue);

    }
	PostFliteringData(fliteringData);
}

document
	.querySelector("#sub-catgory-fliter")
	.addEventListener("change", postSubCategoryValue);

//Price range flitter
document.addEventListener("DOMContentLoaded", () => {
	registerSlide(0, 10000);
});

function registerSlide(minPrice, maxPrice) {
	var priceSlider = document.getElementById("priceSlider");
	var priceValue = document.getElementById("priceValue");

	slider = noUiSlider.create(priceSlider, {
		start: [0, 999999999999999],
		connect: true,
		range: {
			min: minPrice,
			max: maxPrice,
		},
	});
	slider2 = priceSlider.noUiSlider.on("update", function (values, handle) {
		var min = values[0];
		var max = values[1];
		priceValue.innerHTML = min + " - " + max;
		fliteringData["min-price"] = min;
		fliteringData["max-price"] = max;
		loadCount += 2;
		if (loadCount > 5) {
			PostFliteringData(fliteringData);
		}
	});

	var priceSlider2 = document.getElementById("priceSlider2");
	var priceValue2 = document.getElementById("priceValue2");

	noUiSlider.create(priceSlider2, {
		start: [0, 100000],
		connect: true,
		range: {
			min: minPrice,
			max: maxPrice,
		},
	});
	priceSlider2.noUiSlider.on("update", function (values, handle) {
		var min = values[0];
		var max = values[1];
		priceValue2.innerHTML = min + " - " + max;
		fliteringData["min-price"] = min;
		fliteringData["max-price"] = max;
		loadCount += 1;
		if (loadCount > 6) {
			PostFliteringData(fliteringData);
		}
	});
}

const NewUserradioButtons = document.querySelectorAll(".status-radio");
NewUserradioButtons.forEach(function (radio) {
	radio.addEventListener("change", function () {
		const selectedValue = this.value;
		fliteringData["new-used"] = selectedValue;
		loadCount += 10;
		PostFliteringData(fliteringData);
	});
});

function loadPrice($id,type = "sub") {
	$.ajax({
		url: "php/loadPrice.php",
		type: "POST",
		data: { id: $id ,type: type},
		success: function (data) {
			slider.destroy();
			slider.destroy();
			let result = JSON.parse(data);
			let maxPrice = 10000;
			let minPrice = 0;
			if (result["maxPrice"] !== null) {
				maxPrice = parseInt(result["maxPrice"]);
			}

			registerSlide(minPrice, maxPrice);
		},
	});
}

function disableSubCategory() {
	document
		.querySelector("#sub-catgory-fliter")
		.classList.add("custom-disabled-select");
}

function enableSubCategory() {
	if (
		document
			.querySelector("#sub-catgory-fliter")
			.classList.contains("custom-disabled-select")
	) {
		document
			.querySelector("#sub-catgory-fliter")
			.classList.remove("custom-disabled-select");
	}
}
