<!DOCTYPE html>
<html>
  <head>
    <title>Fetch POST Data</title>
    <script>
    function sendData () {
      // (A) GET FORM DATA
      var data = new FormData();
      data.append("name", document.getElementById("name").value);
      data.append("email", document.getElementById("email").value);

      // (B) INIT FETCH POST
      fetch("2-dummy.php", {
        method: "POST",
        body: data
      })

      // (C) RETURN SERVER RESPONSE AS TEXT
      .then((result) => {
        if (result.status != 200) { throw new Error("Bad Server Response"); }
        return result.text();
      })

      // (D) SERVER RESPONSE
      .then((response) => {
        console.log(response);
      })

      // (E) HANDLE ERRORS - OPTIONS
      .catch((error) => { console.log(error); });

      // (F) PREVENT FORM SUBMIT
      return false;
    }
    </script>
  </head>
  <body>
    <form onsubmit="return sendData()">
      <input type="text" id="name" value="Jon Doe" required/>
      <input type="email" id="email" value="jon@doe.com" required/>
      <input type="submit" value="Go!"/>
    </form>
    <?php print_r($_POST);?>
  </body>
</html>
