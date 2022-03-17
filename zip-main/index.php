<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> zip </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">

    <style>
        body {
            text-align: center;
        }
        form {
            text-align: center;
            font-size: 30px;
            color: green;
        }

        form div {
            margin-top: 80px;
        }

        input {
            box-shadow: 0px 0px 2px #333;
            color: #333;
            font-size: 24px;
        }
        img {
            max-width: 100vh;
            max-height: 200px;
            margin: 20px;
        }

        video, audio {
            margin: 0 auto;
            box-shadow: 0px 0px 10px blue;
            display: block;
            width: 80%;
        }

        .file {
            display: inline-block;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
        Upload Your Zip File To Extract:
        <div>
            <input type="file" name="zip" id="zip">
            <input type="submit" value="Upload zip" name="submit">
        </div>
    </form>
    <?php
    require 'extract.php';
    if (isset($_POST["submit"])) {
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
        $fileName = $_FILES['zip']['name'];
        $file_arr = explode(".", $fileName);
        if ($file_arr[count($file_arr) - 1] == 'zip') {
            $finName = $file_arr[0];
            $zip = new zipArchive();
            if ($zip->open($_FILES['zip']["tmp_name"])) {
                $r = time();
                $zip->extractTo("./upload/$r");
                $zip->close();
                $files = opendir("./upload/$r/");
                $pathScan = "./upload/$r/";
                getDirectory($pathScan);
            }
        }
    }
    ?>
</body>

</html>