<!doctype html>
<html>
<head>
<title>AJAX-enabled File Uploader Demos</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- font-awesome -->
<link rel="stylesheet" href="./css/fontawesome.min.css">
<link rel="stylesheet" href="./css/solid.min.css">
<link rel="stylesheet" href="./css/v4-shims.min.css">
<!-- uploader -->
<link rel="stylesheet" href="./css/jquery.uploader.css">

<style rel="stylesheet">
html,* { 
    font-family: 'Inter'; box-sizing: border-box; 
}
body { 
    background-color: #fafafa; line-height:1.6;
}
.lead {
    font-size: 1.5rem; font-weight: 300; 
}
.container {
    max-width: 760px;
    margin: 100px auto;
}
</style>
</head>
<body>
<div class="container">
    <h1>AJAX-enabled File Uploader Demos</h1>
    <input type="text" id="demo3" value="">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="./dist/jquery.uploader.min.js"></script>
<script type="application/javascript">
  $("#demo3").uploader({
    multiple: true,
    ajaxConfig: {
      url: "upload.php",
      method: "post",
      paramsBuilder: function (uploaderFile) {
        let form = new FormData();
        form.append("file", uploaderFile.file)
        return form
      },
      ajaxRequester: function (config, uploaderFile, progressCallback, successCallback, errorCallback) {
        $.ajax({
            url: config.url,
            contentType: false,
            processData: false,
            method: config.method,
            data: config.paramsBuilder(uploaderFile),
            success: function (response) {
            successCallback(response)
            },
            error: function (response) {
            console.error("Error", response)
            errorCallback("Error")
            },
            xhr: function () {
            let xhr = new XMLHttpRequest();
            xhr.upload.addEventListener('progress', function (e) {
                let progressRate = (e.loaded / e.total) * 100;
                progressCallback(progressRate)
            })
            return xhr;
            }
        })
      },
      responseConverter: function (uploaderFile, response) {
        return response;
      },
    },
  })


  $("#demo3").on("file-remove", function(file, data) {
    console.log(file);
    console.log(data);
  })




</script>
</body>
</html>