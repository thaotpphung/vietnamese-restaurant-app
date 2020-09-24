// display message to user
function processMessage() {
    var block = document.getElementById("share");
    firstMessage = document.getElementById("firstMessage");
    firstMessage.innerHTML = "Thank you for your feedback!";
    secondMessage = document.getElementById("secondMessage");
    if (currRating < 2 || currRating == null) {
        secondMessage.innerHTML = "We're sorry for your experience. We will work on the issues and hope to offer better service.";
        block.classList.add('notShare');
        block.classList.remove('share');
    } else if (currRating == 2) {
        secondMessage.innerHTML = "Thanks for giving us a try. We hope to provide better service next time.";
        block.classList.add('notShare');
        block.classList.remove('share');
    } else {
        secondMessage.innerHTML = "We hope to see you again.";
        block.classList.remove('notShare');
        block.classList.add('share');
    }
}

var currRating;
// set the current rating
function setCurrRating(rating) {
    currRating = rating;
    var starnum = document.getElementById("starnum");
    starnum.innerHTML = rating;
}

// set the rating according to click event
function setRating(event) {
    // get the list of all .star spans
    var stars = document.querySelectorAll('.star');
    // get the current span whose event listener triggered the event
    var currSpan = event.currentTarget;
    var match = false;  // we haven't found the match 
    var index = 0;
    var foundIndex;
    var isSet = false;
    // iterate through the star spans
    stars.forEach(function (star) {
        // if we have found the match (which is the span we just click), remove the rated css class
        if (match) {
            star.classList.remove('rated'); // remove .rated css class
        } else {
            // if we haven't found the match (which is the span we just click), add the rated css class
            star.classList.add('rated');  // add .rated css class
        }
        // if the span is the current span, set the match to be true
        if (star === currSpan) {
            match = true;
            if (!isSet) {
                foundIndex = index;
                isSet = true;
            }
        }
        index++;
    });
    return foundIndex;
}

// listen for user click event, set the rating accordingly
function listenForClick(star) {
    star.addEventListener('click', function (event) {
        var rating = setRating(event);
        setCurrRating(rating);
    }, false);
}

function processInit() {
    // process the rating system
    // first, select all elements matched by .star class
    var stars = document.querySelectorAll('.star');
    stars.forEach(listenForClick);

    // listen for review's submit button click event
    var reviewButton = document.getElementById("reviewButton");
    reviewButton.onclick = processMessage;
}

window.onload = processInit;