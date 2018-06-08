//TODO posts are json
let xhttp;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {

    }
};
xhttp.open("GET", "getLatestPosts.php", true);
xhttp.send();
