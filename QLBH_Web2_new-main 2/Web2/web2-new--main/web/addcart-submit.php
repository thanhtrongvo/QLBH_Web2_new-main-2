
<?php       
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

                    require_once('connectDB.php');
                    session_start();
                    $ID=$_POST['id'];
                    $Quantity=$_POST['quantityValue'];
                    $Size=$_POST['size'];
                    
                    // echo $user_id;
                    
                    if(isset($_SESSION['id'])){
                    $user_id = $_SESSION['id'];
                    $checkExistQuery = "SELECT * FROM cart WHERE size=? AND Product_ID=? AND User_ID=?";
                    $result = mysqli_query($conn, $checkExis);
                    if(empty($row=mysqli_fetch_assoc($result))){
                             echo"1";
                            $query="INSERT INTO cart VALUES ($ID,$user_id,$Quantity,$Size)";
                            mysqli_query($conn,$query); 
                                
                    }
                    else{
                        $checkQuantity = "SELECT quantity FROM size_detail WHERE size=? AND product_id=?";
                        $result1 = mysqli_query( $conn,$checkQuantity);
                        $row1=mysqli_fetch_assoc($result1);

                        
                        $newQuantity=intval($row['Quantity'])+intval($Quantity);
                        //echo intval($row['Quantity'])+intval($Quantity);
                         
                        
                    
                        
                        if(($newQuantity<$row1['quantity'])){
                            $query="UPDATE cart SET Quantity = $newQuantity where size=$Size AND Product_ID=$ID AND User_ID=$user_id ";
                            mysqli_query($conn,$query);
                             echo "1";
                        }
                        else{
                         
                           echo "0";
                        }
                       
                    }}
                    else{
                        echo "2";
                    }
                    // header("Location:".$_SERVER["HTTP_REFERER"]);

?>
