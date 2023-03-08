<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>คำนวณตัวเลข</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5"> <br> <br>
                <h1>คำนวณ</h1>
                <p>กรุณาใส่จำนวนที่ต้องการ</p>
 
          <form method="post">
          <?php 
                if(isset($_POST['number1'])){
                  $number1 = $_POST['number1'];
                }
            ?>
            <div class="form-group">
            <div class="inputs">
                    <label>ใส่ตัวเลขแรก :</label>
                    <input type="number" min="0" name="number1" placeholder="ตัวเลขแรก" value="<?php echo $number1;?>" required>
                </div>
            </div>
 
            <div class="form-group">
              <?php 
                if(isset($_POST['operator'])){
                      $operator = $_POST['operator'];
                      if($operator == 1){
                        $ovalue = 1;
                        $olebel = 'บวก';
                      }else if ($operator == 2) {
                        $ovalue = 2;
                        $olebel = 'ลบ';
                      }else if ($operator == 3) {
                        $ovalue = 3;
                        $olebel = 'คูณ';
                      }else if ($operator == 4) {
                        $ovalue = 4;
                        $olebel = 'หาร';
                      }
                }
            ?>
              <select name="operator" required >
                  <?php  if(isset($_POST['operator'])){ ?>
                    <option value="<?php echo $ovalue;?>"><?php echo $olebel;?></option>
                <?php } ?>
                  <option value="">-เครื่องหมาย-</option>
                  <option value="1">บวก</option>
                  <option value="2">ลบ</option>
                  <option value="3">คูณ</option>
                  <option value="4">หาร</option>
                </select>  
            </div>
 
            <div class="form-group">
              <?php 
                if(isset($_POST['number2'])){
                  $number2 = $_POST['number2'];
                }
              ?>
                <div class="inputs">
                    <label>ใส่ตัวเลขสอง :</label>
                    <input type="number" min="0" name="number2" placeholder="ตัวเลขสอง" value="<?php echo $number2;?>" required>
                </div>
            </div>
 
             <div class="form-group">

             <p>test git </p>
 
              <?php
              $tresule = '0';
                if(isset($_POST['number1']) && isset($_POST['number2'])){
 
                   $operator = $_POST['operator'];
                      if($operator == 1){
                        $total = ($_POST['number1'] + $_POST['number2']);
                        $tresule = ($number1.'+'.$number2.'='.$total);
                      }else if ($operator == 2) {
                         $total = ($_POST['number1'] - $_POST['number2']);
                         $tresule = ($number1.'-'.$number2.'='.$total);
                      }else if ($operator == 3) {
                         $total = ($_POST['number1'] * $_POST['number2']);
                         $tresule = ($number1.'*'.$number2.'='.$total);
                      }else if ($operator == 4) {
                         $total = ($_POST['number1'] / $_POST['number2']);
                         $tresule = ($number1.'/'.$number2.'='.$total);
                      }
 
                }else{
                  $total = 0;
                }
                if($tresule != '0'){
                include "dbcon.php";
                $sql = "INSERT INTO result (c_result_F) 
                VALUES ('$tresule')";
                $conn->query($sql);
                $conn->close();
              }
            ?>
            <br>
            

            <div class="inputs">
                    <label>ผลลัพธ์ :</label>
                    <input type="number" name="output" placeholder="ผลลัพธ์" value="<?php echo $total ;?>" readonly>
                </div>
            </div>
              <button type="submit" class="btn btn-primary">Calculate</button>
              <a href="index.php" class="btn btn-danger"> Reset </a>
             
            </div>
 
          </form>

        </div>

      </div>

      <div class="container">

  <table class="card" style="width: 18rem; margin: 20px;">
    <thead>
      <tr>
        <th>ประวัติคำนวณ</th>
      </tr>
    </thead>
    <tbody>

    <?php
    include "dbcon.php";
    $sql = "SELECT * FROM result ORDER BY c_id desc" ;
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
      ?>
      <tr>
      <td><?=$row["c_result_F"]?></td>
      </tr>
      <?php
  
    }
    $conn->close();
     ?>

     
 
    </tbody>
  </table>
  </body>
</html>