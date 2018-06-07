let xhttp;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
        let fileNameArray = JSON.parse(this.responseText);

        for (let i = 0; i < 10; i++) {
            if ("" + fileNameArray[i] !== "undefined") {
                let link = document.getElementById("recent-post-link-" + i);
                //TODO title
                link.innerHTML = fileNameArray[i];
                link.href="readPost.php";
                link.onclick = function () {
                    localStorage.setItem("fileName", fileNameArray[1]);
                };
            }
        }
    }
};
xhttp.open("GET", "getLatestPosts.php", true);
xhttp.send();
