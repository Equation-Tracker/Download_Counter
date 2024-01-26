<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Counter</title>
</head>
<body>
    <?php
        //Connect db and get data
        $connection = mysqli_connect('localhost','root','','somantoral');
        if(!$connection){
            die("Failed to connect. Error: ".mysqli_connect_error());
        } else {
            $data = mysqli_query($connection,"SELECT * FROM dlrecords");
            $GLOBALS['result'] = mysqli_fetch_all($data); //Store into global result
        }
    ?>
    <button onclick="updateDB(1)">Download</button>
    <!--Access the result var-->
    <small id="output1"><?php echo $GLOBALS['result'][0][1]." Downloads";?></small><br>
    <button onclick="updateDB(2)">Download</button>
    <small id="output2"><?php echo $GLOBALS['result'][1][1]." Downloads";?></small><br>
    <button onclick="updateDB(3)">Download</button>
    <small id="output3"><?php echo $GLOBALS['result'][2][1]." Downloads";?></small><br>
    <button onclick="updateDB(4)">Download</button>
    <small id="output4"><?php echo $GLOBALS['result'][3][1]." Downloads";?></small><br>
    <button onclick="updateDB(5)">Download</button>
    <small id="output5"><?php echo $GLOBALS['result'][4][1]." Downloads";?></small><br>
    <script>
        function updateDB(id){
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function(){
                document.getElementById("output"+id).innerHTML = this.responseText;//Output the resulting data in #output
            }
            xhttp.open("GET","server.php?id="+id); //send request
            xhttp.send();
        }
    </script>
</body>
</html>