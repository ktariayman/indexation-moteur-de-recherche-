<?php 
    define ("SITE_ADDRESSE","http://localhost/indexation");
    $site_title ='moteur de recherche || ktari ayman';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>moteur de recherche || ktari ayman</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container">
        <div class="wrapper">
            <div id="top_header">
            <div id="logo">
                    <h1><a href="<?php echo SITE_ADDRESSE;?>">Moteur de recherche</a></h1>
                </div>    
            <div id="nav">
            <h1><a href="<?php echo SITE_ADDRESSE;?>" target="_blank">Insert Here</a></h1>
                </div>
     
            </div>
            <div class="shadow-box" id="main">
                <?php
                    
                    
                    // if the form - button is submitted
                    if(isset($_POST['add'])){
                        // getData
                        $title =$_POST['title']? htmlspecialchars($_POST['title']) :'';
                        $url = $_POST['url'] ? htmlspecialchars($_POST['url']) :'';
                        $keywords = $_POST['keywords'] ? htmlspecialchars($_POST['keywords']) :'';
                        $descr = $_POST['descr'] ? htmlspecialchars($_POST['descr']) :'';
                        if($title && $url && $descr && $keywords){
                            $query_stringTwo = "INSERT INTO  moteur_de_recherche (title,url,descr,keywords) 
                                                VALUES ('$title','$url','$descr','$keywords')";
                            $conn = mysqli_connect("localhost","root","","index");
                            mysqli_query($conn,$query_stringTwo);
                            if(isset($_POST['add']) && $title && $url && $descr && $keywords ){
                                    echo '<center><div style="color:#21831f"><h2>new data added</h2></div></center>';
                                    $title = '';
                                    $url ='';
                                    $keywords ='';
                                    $descr = '';
                            }
                        }else{
                            echo '<center><div style="color:#ff0000";font-size:25px;> <h2>Heey !! all input form are required</h2></div></center>';
                        }
                    }
                    
                ?>
                <div id="content">
                    <br>
                    <br>
                    <br>
                    <center>
                    <form action="" name="" method="POST" style="color:#999;font-size:25px;" autocomplete="off">
                        <table>
                            <tr>
                                <td>TITLE : </td>
                                <td><input autofocus type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>"/></td>
                            </tr>
                            <tr>
                                <td>URL :</td>
                                <td><input type="text" name="url" value="<?php echo isset($url) ? $url : ''; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><input type="text" name="descr" value="<?php echo isset($descr) ? $descr : ''; ?>"/></td>
                            </tr>
                            <tr>
                                <td>Keywords</td>
                                <td><input type="text" name="keywords" value="<?php echo isset($keywords) ? $keywords : ''; ?>"/></td>
                            </tr>
                            
                            <tr>
                                <td>Add</td>
                                <td><input type="submit" name="add" value="add"/></td>
                            </tr>
                            
                        </table>
                    </form>
                    </center>       
                  
                </div>
            </div>
            <div id="footer">

            </div>
        </div>
    </div>
    </body>
