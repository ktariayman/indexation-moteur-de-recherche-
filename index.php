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
            <h1><a href="<?php echo SITE_ADDRESSE;?>/insert.php" target="_blank">Insert Here</a></h1>
                </div>
     
            </div>
            <div class="shadow-box" id="main">
                <div id="content">
                    <center>
                    <form action="" method="GET" name="" autocomplete="off">
                        <table>
                            <tr>
                                <td><input  autofocus   type="text" name="k" 
                                value="<?php echo isset($_GET['k']) ? $_GET['k'] : ''; ?>" 
                                placeholder="Enter your search keywords" /></td>
                                <td><input  type="submit" name="button" value="Search" /></td>
                            </tr>
                            <br><br>
                        </table>
                    </form>
                    
                    </center>       
                    <?php  
                        // --------------------------isset function---------------------------------------
                        /*isset function : Check whether a variable is empty. Also check whether the variable is set/declared: return true/false
                        The isset() function checks whether a variable is set, 
                        which means that it has to be declared and is not NULL. 
                        This function returns true if the variable exists and is not NULL, 
                        otherwise it returns false.
                        */

                        if(isset($_GET['k']) && $_GET['k'] != ''){
                                // save the keywords from the url
                                $k = trim($_GET['k']) ;
                                // The TRIM function is used to “normalize” all spacing
                                /* 
                                    TRIM will remove extra spaces from text. Thus, 
                                    it will leave only single spaces between words 
                                    and no space characters at the start or end of the text.
                                */
                                $query_string ="SELECT * FROM  moteur_de_recherche WHERE ";
                                $display_words = "";

                                // The explode() function breaks a string into an array : separate each of the keyword 
                                $keywords = explode(' ',$k);
                                foreach($keywords as $word) {
                                    $query_string .= "keywords LIKE '%" .$word. "%' OR ";
                                    $display_words .= $word." ";
                                }
                                /* final exemple will be like this :
                                exemple : SELECT * FROM indexation WHERE keywords LIKE '%brbrb%' OR keywords LIKE '%zrgzrg%' OR
                                 lezem nfasskho ekher OR tji mel foreach */
                                $query_string = substr($query_string,0,strlen($query_string) -3);//-3 espace R & O ( edha mana3rfouch kelma 9adech koberha njmo naamlo recherche l ekher kelma w nekdho index mte3ha , naamlo index - length )
                                // echo $query_string;
                                // connect to the database 
                                $conn = mysqli_connect("localhost","root","","index");
                                $query = mysqli_query($conn,$query_string);
                                $result_count=mysqli_num_rows($query);
                                // see if any result exists 

                                if($result_count>0){
                                    echo '<br><div style="color:#f1f1f1;font-size: 35px;text-align:center">'.$result_count.' results found</div>';
                                    echo '<br><div style="color:#f1f1f1;font-size: 35px;text-align:center" >you search for <span style="color:#c98f8f;"><b>'.$display_words.'</b></span></div><hr/> <br/>'; 
                                    //display all the search results to the user
                                    echo '  <table class="table" border=2 
                                                style="color:#f1f1f1;width: 100%; font-size: 20px;height:100px;text-align:center"
                                            > 
                                                <th>title</th>
                                                <th>description</th>
                                                <th>url</th>
                                                <th>keywords</th>';
                                    while($row = mysqli_fetch_assoc($query)){
                                        $row['url'] = substr($row['url'],0,strlen($row['url']));
                                    echo 
                                                '<tr >
                                                    <td>'.$row['title'].'</td>    
                                                    <td>'.$row['descr'].'</td>    
                                                    <td><a href='.$row['url'].'>'.$row['url'].'</a></td> 
                                                    <td>'.$row['keywords'].'</td> 
                                                </tr>';
                                    }
                                    echo    '</table >';
                                }else{
                                    echo '<br><br><br><div
                                            style="color:#ff0000; font-size: 25px;height:100px;text-align:center">
                                    No result founded, search for something else</div>';
                                }
                        }else{
                            echo '';
                        }
                    ?>
                </div>
            </div>
            <div id="footer">

            </div>
        </div>
    </div>
</body>
</html>