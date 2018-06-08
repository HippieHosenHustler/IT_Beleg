let xmlhttp;
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
        let responseTextJson = JSON.parse(this.responseText);
        for (let i = 0; i < 10; i++) {

            let fileName = responseTextJson.post[i].fileName;
            document.getElementById("recent-post-link-" + i).innerHTML = responseTextJson.post[i].title;
            document.getElementById("recent-post-link-" + i).onclick = function () {
                localStorage.setItem("fileName", fileName);
            };
            document.getElementById("recent-post-link-" + i).href = "readPost.php"
        }
    }
};
xmlhttp.open("GET", "getRecentPosts.php", true);
xmlhttp.send();
