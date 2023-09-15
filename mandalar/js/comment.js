//Assign html Dom
const commenterStoreBox = document.querySelector("#commenter_id");
const postIdStoreBox = document.querySelector("#post_id");
const commentInput = document.querySelector("#comment-input");
const commentBtn = document.querySelector("#comment-btn");
const alertPlaceholder = document.getElementById("liveAlertPlaceholder");

//Assign Value
let CommenterId = commenterStoreBox.dataset.userId;
let PostId = postIdStoreBox.dataset.postId;
let ParentCommentId = null;
let Content = "";
let isEdit = false;
let com_id = null;
let previousResponse = "";

//Assign Content Value From Input
commentInput.addEventListener("keyup", (e) => {
	Content = e.target.value;
});

let link = window.location.href
console.log(link);
//Tranfer to Comment Controller Php When Comment Btn Click;
commentBtn.addEventListener("click", (e) => {
	$.ajax({
		url: "php/createComment.php",
		type: "POST",
		data: {
			post_id: PostId,
			user_id: CommenterId,
			content: Content,
			parent_comment_id: ParentCommentId,
			isEdit: isEdit,
			com_id: com_id,
			link: link
		},
		success: function (data) {
			console.log(data);
			Content = "";
			commentInput.value = "";
			ParentCommentId = 0;
			isEdit = false;
			com_id = null;
	
			previousResponse = '';
			alertPlaceholder.innerHTML = '';
		},
	});
});
// date function
function timeAgo(timestamp) {
	const currentDate = new Date();
	const commentDate = new Date(timestamp);
	const timeDifferenceInSeconds = Math.floor((currentDate - commentDate) / 1000);

	if (timeDifferenceInSeconds < 60) {
		return "Just now";
	} else if (timeDifferenceInSeconds < 3600) {
		const minutesAgo = Math.floor(timeDifferenceInSeconds / 60);
		return minutesAgo + " min ago";
	} else if (timeDifferenceInSeconds < 86400) {
		const hoursAgo = Math.floor(timeDifferenceInSeconds / 3600);
		return hoursAgo + " hours ago";
	} else if (timeDifferenceInSeconds < 604800) {
		const daysAgo = Math.floor(timeDifferenceInSeconds / 86400);
		return daysAgo + " days ago";
	} else if (timeDifferenceInSeconds < 2419200) {
		const weeksAgo = Math.floor(timeDifferenceInSeconds / 604800);
		return weeksAgo + " weeks ago";
	} else {
		const monthsAgo = Math.floor(timeDifferenceInSeconds / 2419200);
		return monthsAgo + " months ago";
	}
}





let commentContainer = document.querySelector(".comments");
function loadComments() {
	$.ajax({
		url: "php/load_comment.php",
		type: "POST",
		data: { post_id: PostId },
		success: function (data) {
			let CommentList = "";
			let response = JSON.parse(data);
			if (response.length !== previousResponse.length) {

				response.forEach((element) => {
					console.log(element);

					let date = timeAgo(element.date);
					CommentList += `
							 <div class ="comment" >
									<div class="d-flex">
										<img src="image/user-profile/${element.img}"  class="profile-picture-comment" alt="${element.img}" style="width: 40px;height:40px;object-fit:cover" />
										<div class="comment-container">
											<div class="comment-content">
												<div class="comment-details">
													<span class="comment-author">${element.name} <span class="comment-date"> - ${date}</span></span>
													
												</div>
												${element.content}
											</div>
											<div class="comment-actions">
												<button class="btn btn-link btn-sm" onclick="assignParentId(event)" data-cm-id = ${element.id}>Reply</button>
												<button class="btn btn-link btn-sm see-reply" onclick="seeReplies(event,${element.id})">see replies</button>
	
								
								`;
					if (CommenterId == element.user_id) {
						CommentList += `<div class="btn-group shadow-0 mb-2 dropend">
						<button
						  type="button"
						  class="btn btn-secondary dropdown-toggle"
						  data-mdb-toggle="dropdown"
						  aria-expanded="false"
						>
						  Action
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item" onclick = "edit('${element.content}',${element.id})" >Edit</a></li>
						  <!-- Button trigger modal -->
					
						  <li><a class="dropdown-item" onclick = "deleteComment(${element.id})" >Delete</a></li>
	
						  
						
						</ul>
					  </div>
									`;
					}

					CommentList += `
								</div>
									
								</div>
							</div>
	
							<div class="replies d-none">
							</div>
					</div>
								`;
				});
				commentContainer.innerHTML = CommentList;
			
				const seeRepliesBtns = document.querySelectorAll(".see-reply");
				console.log(seeRepliesBtns);
				seeRepliesBtns.forEach((btn) => {
					btn.click();
				});
			}
			previousResponse = response;
		},
	});
}

setInterval(() => {
	loadComments();
}, 500);
// loadComments();

//Assign Parent Id Value
function assignParentId(e) {
	commentInput.value = "";
	ParentCommentId = e.target.dataset.cmId;
	let CommentUser = e.target.parentElement.previousElementSibling.children[0].children[0].innerText;
	console.log(CommentUser);
	console.log("ParentCommentId : ", ParentCommentId);
	var parts = CommentUser.split(' - ');

if (parts.length > 0) {
  var extractedText = parts[0];
  console.log(extractedText); // This will print "kaungkhant"
}

	// commentInput.value = extractedText;
	commentInput.focus()
	appendAlert("Repling to " + extractedText, "light");
}

function normalizeWhitespace(str) {
	return str.replace(/\s+/g, " ").trim();
}

//see Replys
function seeReplies(e, parent_comment_id) {
	console.log();
	$.ajax({
		url: "php/load_replies.php",
		type: "POST",
		data: { parent_comment_id: parent_comment_id },
		success: function (data) {
			let response = JSON.parse(data);
			let repliesContainer =e.target.parentElement.parentElement.parentElement.nextElementSibling;
			let replyComments = "";
			response.forEach((element) => {
				let date = timeAgo(element.date);
				console.log(date);
				replyComments += `
			<div class ="comment" >
					<div class="">
						<img src="image/user-profile/${element.img}"  class="profile-picture-comment" alt="${element.img}" style="width: 40px;height:40px;object-fit:cover" />
						<div class="comment-container">
							<div class="comment-content">
							<div class="comment-details">
							<span class="comment-author">${element.name} <span class="comment-date"> - ${date}</span></span>
							
						</div>
								${element.content}
							</div>
							<div class="comment-actions">
								<button class="btn btn-link btn-sm"  onclick="assignParentId(event)" data-cm-id = ${element.id}>Reply</button>
								<button class="btn btn-link btn-sm see-reply"  onclick="seeReplies(event,${element.id})">see replies

			
					`;
				if (CommenterId == element.user_id) {
					replyComments += `<div class="btn-group shadow-0 mb-2 dropend">
						<button
						  type="button"
						  class="btn btn-secondary dropdown-toggle"
						  data-mdb-toggle="dropdown"
						  aria-expanded="false"
						>
						  Action
						</button>
						<ul class="dropdown-menu">
						  <li><a class="dropdown-item"  onclick = "edit('${element.content}',${element.id})" >Edit</a></li>
						  <!-- Button trigger modal -->
					
						  <li><a class="dropdown-item" onclick = "deleteComment(${element.id})" >Delete</a></li>
	
						  
						
						</ul>
					  </div>
									`;
				}

				replyComments += `
					</div>
				</div>

				<div class="replies">
				</div>
		</div>`;
			});
			repliesContainer.innerHTML = replyComments;
		},
	});
	e.target.parentElement.parentElement.parentElement.nextElementSibling.classList.toggle(
		"d-none"
	);
}

// let isDelete = false;
// let isModalOpen = false;
function deleteComment($id) {
	let isItSure = confirm("are you sure To delete");
	if (isItSure) {
		$.ajax({
			url: "php/deleteComment.php",
			type: "POST",
			data: { id: $id },
			success: function (data) {
				console.log("delete Success");
				loadComments();
			},
		});
	}
}

function edit(value, id) {
	isEdit = true;
	commentInput.value = value;

	com_id = id;
	console.log(com_id);
}
// function asseptDelete() {
// 	isDelete = true;
// 	setTimeout(() => {
// 		isModalOpen = false;
// 	}, 1000);
// }
function appendAlert(message, type) {
	alertPlaceholder.innerHTML = "";
	const wrapper = document.createElement("div");
	wrapper.innerHTML = [
		`<div class="alert light alert-${type} alert-dismissible" role="alert">`,
		`   <div>${message}</div>`,
		'   <button type="button" onclick = "reassignReplyId()" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
		"</div>",
	].join("");

	alertPlaceholder.append(wrapper);
}

function reassignReplyId() {
	ParentCommentId = 0;
	commentInput.value = "";
}
