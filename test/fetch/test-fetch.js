var data = new FormData();
data.append("name", "Pierre");

fetch("test-fetch.php" , {
    method: "POST",
    body: data
})