<form name="upload" action="upload.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
  <h2>First File</h2>
  <input type="file" name="firstFile" id="firstFile"><br>
  <h2>Second File</h2>
  <input type="file" name="secondFile" id="secondFile"><br>
  <h2>Delimeter</h2>
  <input type="text" name="delimeter" id="delimeter"><br><br>
  <input type="submit" value="Upload Files" name="submit">
</form>

<script>
  function validateForm() {

  if (document.forms["upload"]["firstFile"].files.length === 0 ||
      document.forms["upload"]["secondFile"].files.length === 0) {
    alert("Some files are missing");
    return false;
  }

  if (document.forms["upload"]["delimeter"].value == "") {
    alert("Delimeter must be filled out");
    return false;
  }
  
  var firstFile = document.getElementById('firstFile');
  var secondFile = document.getElementById('secondFile');
  fname1 = firstFile.files[0].name;
  fname2 = secondFile.files[0].name;
    var re = /(\.txt)$/i;
    if (!re.exec(fname1) || !re.exec(fname2)) {
      alert("Files should be txt only!");
      return false;
    }
}
</script>
