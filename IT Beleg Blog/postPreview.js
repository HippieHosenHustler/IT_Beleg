let xhttp;
xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
        let responseTextJson = JSON.parse(this.responseText);
        for (let i = 0; i < 3; i++) {

            document.getElementById("preview-title-" + i).innerHTML = responseTextJson.post[i].title;

            let postPreview = responseTextJson.post[i].Content.slice(0,500);
            postPreview += "...";
            document.getElementById("preview-text-" + i).innerHTML = postPreview;

            let fileName = responseTextJson.post[i].fileName;
            document.getElementById("preview-link-" + i).onclick = function () {
                localStorage.setItem("fileName", fileName);
            };
            document.getElementById("preview-link-" + i).href = "readPost.php"
        }
    }
};
xhttp.open("GET", "getRecentPosts.php", true);
xhttp.send();
