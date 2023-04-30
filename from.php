<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Upload File Form</title>
  </head>
  <body>
    <h1>Upload File Form</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
      <label for="file">Select file to upload:</label>
      <input type="file" name="file" id="file"><br><br>
      <input type="submit" value="Upload">
    </form>
  </body>
</html>