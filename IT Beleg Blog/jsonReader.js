function readJsonFile() {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let myObject = JSON.parse(this.responseText);
            document.getElementById("demo").innerHTML = myObject.name;
        }
    };
    xmlhttp.open("GET", "demofile.php", true);
    xmlhttp.send();
} 