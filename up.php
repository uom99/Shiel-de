<html>

<body>

<meta http-equiv="Content-Type" content="text/html;charset=utf-8;" />

<form action="upload_file.php" method="post"

enctype="multipart/form-data">

<label for="file">Filename:</label>

<input type="file" name="file[]"/> 

<br />

<input type="file" name="file[]"/> 

<br />

<input type="text" name="te" />

<p>이름 : <input type="text" name="name" /></p>

<p>연령 : <input type="text" name="age" /></p>

<input type="submit" name="submit" value="Submit" />

</form>





</body>

</html>