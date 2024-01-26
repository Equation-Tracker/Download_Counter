<?php
    //Edition number. We will make this dynamic
    $id = $_GET['id']; //Get the data sent by JS XMLHttpRequest()

    //Create a connection with db
    //My database {
        //host:'localhost', user:'root', password:'',database:'somantoral'
    // }
    $connection = mysqli_connect('localhost','root','','somantoral');

    //Check if connected or not
    if(!$connection){
        die("Failed to connect. Error: ".mysqli_connect_error());//Throw error
    } else {
        //Get all table data if connected
        $data = mysqli_query($connection,"SELECT * FROM dlrecords");
        $GLOBALS['result'] = mysqli_fetch_all($data); //Store data in global var result
    }

    //Update the data onclick
    $oldVal = (int) $result[$id-1][1];//Old value
    $newVal = $oldVal + 1;//New value
    $stmt = mysqli_prepare($connection,"UPDATE dlrecords SET Downloads = ? WHERE Edition = ?");//Query
    mysqli_stmt_bind_param($stmt,'ii',$newVal,$id);//set new value
    mysqli_stmt_execute($stmt);//execute command
    mysqli_stmt_close($stmt);//close statement

    //Again get updated data from table
    $data = mysqli_query($connection,"SELECT * FROM dlrecords");
    $result = mysqli_fetch_all($data); //Update result var

    //Output
    echo $result[$id-1][1]." Downloads";
    mysqli_close($connection); //Close the connection
?>