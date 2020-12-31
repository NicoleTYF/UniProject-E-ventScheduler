/**
 1. Open search bar screen when user clicks search button
	 type in word to search for the location of the contents
	(Dynamic navigation within a page or between pages in response to the user)
	References: w3school. (n.d.). JavaScript String search() Method. Retrived from 
				https://www.w3schools.com/jsref/jsref_search.asp
				w3school. (n.d.). How TO - Full screen Overlay Navigation. Retrived from
				https://www.w3schools.com/howto/howto_js_fullscreen_overlay.asp
*/
function openSearch() {
	// The divider of search window slides down 
	document.getElementById("searchWindow").style.height = "100%";
	document.getElementById("websearchField").classList.add("expand");
	docmuent.getElementById("websearchbtn").style.backgroundColor = "#f35e22";
}
function closeSearch() {
	// The divider of search window slides up
	document.getElementById("searchWindow").style.height = "0%";
	document.getElementById("websearchField").classList.remove("expand");
	docmuent.getElementById("websearchbtn").style.backgroundColor = "#e0220d";
}
function wordSearch(isWord) {
	// Declare variables
	var input, filter, searchList, output, i, list, 
		searchArea, items, contentTxt, noResult;
	input = document.getElementById('websearchField');
	filter = input.value.toUpperCase();
	searchList = document.getElementById("searchList");
	if(isWord == true) {
	  items = document.getElementsByTagName('article');  
	} else {
	  items = document.getElementsByClassName('popUpText');  
	}
	
	output = searchList.getElementsByTagName('li');		
	contentTxt = document.getElementsByClassName('searchListContent'); 
	noResult = document.getElementById('noResult')

	// Loop through all list items, and hide those who don't 
	// match the search query
	var hasResult = false;
	for (i = 0; i < items.length; i++) {
		var txtValue = "";
		if(isWord == true) {
			searchArea = items[i].getElementsByTagName("p")[0];
			txtValue = searchArea.innerText;	
		} else {
			for (list = 0; list < items[i].getElementsByTagName(
				"li", "p").length; list++) {
				searchArea = items[i].getElementsByTagName("li")[list]; 
				txtValue += searchArea.innerText;	
			}
		}
		
		var hr = document.getElementsByTagName('hr'); 
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
		  output[i].style.display = "";
		  hr[i].style.display = "";  
		  contentTxt[i].innerHTML = "... " + input.value + " ...";
		  hasResult = true;
		 
		} else {
		  output[i].style.display = "none";
		  hr[i].style.display = "none";
		  contentTxt[i].innerHTML = "... content ...";
		}
	}
	
	if (hasResult == false) {
		noResult.style.display = "block"; 
	} else {
		noResult.style.display = "none";
	}
}

/** 
2. Vote up and Down in the UI
 	(Manipulation of presentation in response to the user)
*/
$(document).ready(function(){
	$(".voteUpBtn").click(function(){
		// "VoteUp" button changes background color
		$(this).toggleClass("voted");
		var votes = parseInt($(this).parent().find(".voteNumber").html());
		if($(".voteUpBtn").hasClass("voted")) {
			$(this).parent().find(".voteNumber").html((votes+1).toString());
		} else {
			$(this).parent().find(".voteNumber").html((votes-1).toString());
		}
		if($(this).parent().find(".voteDownBtn").hasClass("voted")) {
			$(this).parent().find(".voteDownBtn").toggleClass("voted");
			$(this).parent().find(".voteNumber").html((votes+2).toString());
		}
	});
	$(".voteDownBtn").click(function(){
		// "VoteDown" button changes background color
		$(this).toggleClass("voted");
		var votes = parseInt($(this).parent().find(".voteNumber").html());
		if($(".voteDownBtn").hasClass("voted")) {
			$(this).parent().find(".voteNumber").html((votes-1).toString());
		} else {
			$(this).parent().find(".voteNumber").html((votes+1).toString());
		}
		
		if($(this).parent().find(".voteUpBtn").hasClass("voted")) {
			$(this).parent().find(".voteUpBtn").toggleClass("voted");
			$(this).parent().find(".voteNumber").html((votes-2).toString());
		}
	});
	
	$("#nextBtn").click(function(){
		updateMemoList(fromID, toID)
	});
	
	$("#previousBtn").click(function(){
		updateMemoList(fromID, toID)
	});	
});

/** 
3. Open popup box to show extra information of the 
	memo(Stylistic integration of simple jQuery plugins)
	Reference:	W3School. (n.d.). How To Create a Modal Box. Retrieved from
				https://www.w3schools.com/howto/howto_css_modals.asp
*/
function openBox(number, memoId) {
	// The divider of search window slides down 
	document.getElementById("popUp" + number).style.
	display = "block";
	document.getElementById("addMemo").style.display = "none";
}
function closeBox(number) {
	// The divider of search window slides down 
	document.getElementById("popUp" + number).style.
	display = "none";
	document.getElementById("addMemo").style.display = "block";
}

/**
4. Scroll to position of the respective tip when user 
	click on navigation button
*/
function scrollToTips(type, number, offset){
	window.scroll(0, document.querySelector("#tip"+ 
	number).offsetTop - offset);
}

/**
5. Spawn MemoObjects
*/
MemoObject = function(usage, memoUserType) {
	// CHANGE THIS TO THE ID OF THE NEW MEMO
	var i=3;
	i += 1;
	
	// DUMMY VALUES, REPLACE IT WITH JUST [] when database insertion is done.
	window.memoTitle = ["", "nmnnmn", "nmnmnmnm", "dragItem3"];
	window.memoResponse = [0, 2, 4 ,6];
	
	if(usage == 'addMemo') {
		// retrive values from add memo windows
		var title = document.getElementById("askInput").value;
		var topic = document.getElementById("select");
		var selectedTopic = topic.options[topic.selectedIndex].value;
		var desc = document.getElementById("desc").value;
		
		memoTitle.push(title);
		memoResponse.push(0);
		
	} else if(usage == 'update') {
		// TODO: retrieve data into database
		var m;
		window.memoTitle = ["", "nmnnmn", "nmnmnmnm", "dragItem3"];
		window.memoResponse = [0, 2, 4 ,6];
	}
	
	if(memoUserType == 'Student') {
		var popUpBoxNumber = 1;
	} else if(memoUserType == 'Elderly') {
		var popUpBoxNumber = 2;
	}
	
	var memoObject = document.createElement("div");
	memoObject.innerHTML = "<content><h3 class='dragItemTitle' id='dragItemTitle" + i +
				"'>" + memoTitle[i] + "</h3><p class='dragItemNoOfResponse'>" +
				"<span id='dragItemNoOfResponse" + i + "'>" + memoResponse[i] + 
				"</span>&nbsp; response(s)</p><button class='viewMemoBtn' id='viewMemoBtn" + 
				i + "' onclick='openBox(" + 5 + ")'>View</button></content>";
	memoObject.id = "dragItem";
	memoObject.className = "ui-widget-content MemoObject ElderlyMemo";
	
	document.getElementById("toolBox").appendChild(memoObject);
}

CommentObject = function(memoNo, userType) {
	// CHANGE THIS TO THE ID OF THE NEW MEMO
	var i=3;
	i += 1;

	// DUMMY VALUES, REPLACE IT WITH JUST [] when database insertion is done.
	window.comment = ["mnmn", "kljkk", "what a good day" ,"jknknn"];
	window.commentVote = [3, 4, 2, 15, 3];	
	
	// TODO: retrive values from add memo windows
	window.userName = "Nicole";
	window.thisUserType = "Student";
	
	var today = new Date();
	var date = today.getFullYear() + '-' + (today.getMonth()+1) + '-' + today.getDate();
	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	window.commentTime = date + " " + time;

	if(userType == 'Student') {
		var commentValue1 = CKEDITOR.instances.editorS1.getData();
		var commentValue3 = CKEDITOR.instances.editorS3.getData();
		var commentValue5 = CKEDITOR.instances.editorS5.getData();
		var commentBox = document.getElementById("commentBoxS" + memoNo);
	} else if(userType == 'Elderly') {
		var commentValue2 = CKEDITOR.instances.editorE2.getData();
		var commentValue4 = CKEDITOR.instances.editorE4.getData();
		var commentBox = document.getElementById("commentBoxE" + memoNo);
	}
	
	switch(memoNo){
		case 1:
			commentValue = commentValue1;
			break;
		case 2:
			commentValue = commentValue2;
			break;
		case 3:
			commentValue = commentValue3;
			break;
		case 4:
			commentValue = commentValue4;
			break;
		case 5:
			commentValue = commentValue5;
			break;
	}
	
	if(window.thisUserType == 'Student') {
		var img = "yellowDot.png";
	} else if(window.thisUserType == 'Elderly') {
		var img = "greenDot.png";
	}
	
	window.comment.push(commentValue);
	var commentObject = document.createElement("div");
	commentObject.innerHTML = 
				 "<div class='leftCommentBox'> <p/>" +
						  "<img width='10px' height='10px' src='images/memo/" + 
						 img + "'/>&nbsp;" + "<span id='commentUsername'><b>" + window.userName +
						 "</b></span>&nbsp;commented on&nbsp;" +
						  "<span id='commentTime'>" + commentTime + "</span>" +
						"<a class='reportUI' href='Advice.html'>Report abuse</a>" +
						"<article>" +
							commentValue +
						"</article></div>" +
				 "<aside class='rightCommentBox'>" +
					"<div class='votingUI'>"
						"<button class='voteUpBtn'><i class='fas fa-chevron-up'></i></button>" +
						"<span class='voteNumber'>" + 0 + "</span>"
						"<button class='voteDownBtn'><i class='fas fa-chevron-down'></i></button>" +
					"</div> </aside>";
					
	
	commentObject.id = "comment" + i;
	if(userType == 'Student') {
	  commentObject.className = "Student comments";
	} else if(userType == 'Elderly') {
	  commentObject.className = "Elderly comments";
	}
	commentBox.appendChild(commentObject);
}

function updateMemoList(fromID, toID) {
	
	if(fromID == 'null' || toID == 'null') {
		// TODO: Retrieve data from database according to the fromID to toID
		window.memoID = [];
	} else {
		// TODO: Retrieve data from database according to the fromID to toID
		window.memoID = [];
	}
	
	var i;
	// This line of code cleans up the MemoObjects in the window.
	document.getElementById("toolBox").innerHTML = "";
	for(i=0;i<=11;i++) {
		// TODO: Retrieve data from database according to the fromID to toID
		window.memoTitle[i] = "";
		new MemoObject('update');
	}
}

/**
6. Drag and drop items
*/
function allowDrop(ev) {
	ev.preventDefault();
}
function drag(ev) {
	ev.dataTransfer.setData("Text", ev.target.id);
}
function drop(ev) {
	var data = ev.dataTransfer.getData("Text");
	ev.target.appendChild(document.getElementById(data));
	ev.preventDefault();
}

/**
4. Scroll to top when user clicks on the bottom-right button
	References: w3school. (n.d.). How TO - Scroll Back To Top Button. Retrived from 
				https://www.w3schools.com/howto/howto_js_scroll_to_top.asp
*/
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    document.getElementById("BackToTopBtn").classList.add("scrolled");
  } else {
    document.getElementById("BackToTopBtn").classList.remove("scrolled");
  }
}
// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}


