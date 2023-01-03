// Script coded by Anupam Mondal 

function fburlYes() {
    var x = document.getElementById("fbYes").checked;
    if (x == 'true') {
        document.getElementById("fb_url").disabled = true;
    } else {
        document.getElementById("fb_url").disabled = false;
    }
} 
function fburlNo() {
    var x = document.getElementById("fbNo").checked;
    if (x == 'true') {
        document.getElementById("fb_url").disabled = false;
    } else {
        document.getElementById("fb_url").disabled = true;
    }
}

function liurlYes() {
    var x = document.getElementById("liYes").checked;
    if (x == 'true') {
        document.getElementById("li_url").disabled = true;
    } else {
        document.getElementById("li_url").disabled = false;
    }
} 
function liurlNo() {
    var x = document.getElementById("liNo").checked;
    if (x == 'true') {
        document.getElementById("li_url").disabled = false;
    } else {
        document.getElementById("li_url").disabled = true;
    }
}

// function instaurlYes() {
//     var x = document.getElementById("instaYes").checked;
//     if (x == 'true') {
//         document.getElementById("insta_url").disabled = true;
//     } else {
//         document.getElementById("insta_url").disabled = false;
//     }
// } 
// function instaurlNo() {
//     var x = document.getElementById("instaNo").checked;
//     if (x == 'true') {
//         document.getElementById("insta_url").disabled = false;
//     } else {
//         document.getElementById("insta_url").disabled = true;
//     }
// }

function tweeturlYes() {
    var x = document.getElementById("tweetYes").checked;
    if (x == 'true') {
        document.getElementById("tweet_url").disabled = true;
    } else {
        document.getElementById("tweet_url").disabled = false;
    }
} 
function tweeturlNo() {
    var x = document.getElementById("tweetNo").checked;
    if (x == 'true') {
        document.getElementById("tweet_url").disabled = false;
    } else {
        document.getElementById("tweet_url").disabled = true;
    }
}

function linkedinurlYes() {
    var x = document.getElementById("linkedinYes").checked;
    if (x == 'true') {
        document.getElementById("linkedin_url").disabled = true;
    } else {
        document.getElementById("linkedin_url").disabled = false;
    }
} 
function linkedinurlNo() {
    var x = document.getElementById("linkedinNo").checked;
    if (x == 'true') {
        document.getElementById("linkedin_url").disabled = false;
    } else {
        document.getElementById("linkedin_url").disabled = true;
    }
}