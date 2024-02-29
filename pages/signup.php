<?php 

require "../controllers/controller.signup.php";
require "../common/database.php";
?>
    <style>
      .error {
        color: red;
      }
.important{
  color: red;
}
    </style>
  <!--header-->
  <?php include "../common/header.php" ?>
  <!--main section-->
    <div class="section d-flex">
      <div class="section-image">
        <img class="section-image-2" src="../photos/Illustration.png"/>
      </div>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-container">
          <div class="form heading">
            <div class="form-heading">
              <span class="text-success"><?php echo  $successmessage ? " <p>$successmessage</p>" : "" ?></span>
              <h3>Signup to your Account</h3>
            </div>
          </div>
          <br/>
          <div class="form">
            <div class="form-group">
              <label for="fullName">Full Name<span class="important">*</span></label>
              <input
                type="text"
                class="form-control"
                id="fullName"
                placeholder="Your full name"
                name="name"
                value="<?php echo htmlspecialchars($fullName); ?>"
              />
              <span class="error"><?php echo $fullNameErr; ?></span>
            </div>
            <br/>
            <div class="form-group">
              <label for="dob">Date of Birth<span class="important">*</span></label>
              <input type="date" class="form-control" id="dob" name="dob"  value="<?php echo htmlspecialchars($dob); ?>"/>
              <span class="error"><?php echo $dobErr;?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="gender">Gender<span class="important">*</span></label>
              <select class="form-select" id="gender" name="gender">
              <option>Choose...</option>
                <option class="gender">Male</option>
                <option class="gender" >Female</option>
                <option class="gender">Other</option>
              </select>
            </div>
            <span class="error"><?php echo $genderError;?></span>
            <br />
            <div class="form-group">
              <label for="country">Country<span class="important">*</span></label>
              <select class="form-select" id="country" name="country"> 
              <option>choose..</option>
                <?php
                
                 $sql = "SELECT * FROM country";
                 $result = mysqli_query($conn,$sql);
                if($result->num_rows >  0){
                  while($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['cid'] . '">' . $row['cname'] . '</option>';
                }
                }
                ?>
              </select>
            </div>
            <span class="error"><?php echo $countryErr;?></span>
            <br/>
            <div class="form-group">
              <label for="gender">State<span class="important">*</span></label>
              <select class="form-select" id="state" name="state"> 
              
              </select>
            </div>
            <br />



            <div class="form-group">
              <label for="country"> Phone number<span class="important">*</span></label>
              <input
                name="number"
                type="text"
                class="form-control"
                id="country"
                placeholder="Your number"
                value="<?php echo htmlspecialchars($number); ?>"
              />
              <span class="error"><?php echo $numberErr;?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="email">E-mail<span class="important">*</span></label>
              <input
                type="text"
                class="form-control"
                id="email"
                placeholder="Your e-mail"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
              />
              <span class="error"><?php echo $emailErr;?></span>
              <span class="text-danger"><?php echo $errormessage  ?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="password">Password<span class="important">*</span></label>
              <input
                type="password"
                class="form-control"
                id="password"
                placeholder="Your password"
                name="password"
                value="<?php echo htmlspecialchars($password); ?>"
              />
              <span class="error"><?php echo $passwordErr; ?></span>
            </div>
            <br />
            <div class="form-group">
              <label for="password">Confirm Password<span class="important">*</span></label>
              <input type="password"
                class="form-control"
                id="password"
                placeholder="confirm password"
                name="confirmPassword"
                value="<?php echo htmlspecialchars($confirmPassword); ?>"
                />
              <span class="error"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <br />
            <label>Hobbies</label>
            <hr style="width:70px">    
          <div class="form-group d-flex flex-wrap">
           <div class="form-check ">
             <input class="form-check-input" type="checkbox" name="hobbies[]" value="reading">
             <label class="form-check-label">Reading</label>
           </div>&nbsp;&nbsp;
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="hobbies[]" value="traveling">
             <label class="form-check-label">Traveling</label>
           </div>&nbsp;&nbsp;
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="hobbies[]" value="gaming">
             <label class="form-check-label">Gaming</label>
           </div>&nbsp;&nbsp;
           
           <div class="form-check">
             <input class="form-check-input" type="checkbox" name="hobbies[]" value="gaming">
             <label class="form-check-label">Eating</label>
           </div> 
        </div>
       
        <br />
            <div class="form-group">
              <input class="button-1 btn-primary" type="submit" name="submit"/>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- footer -->
    <?php include "../common/footer.php"?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function(){
        function loaddata(type,category_id){
          $.ajax({
            url:"load-cs.php",
            type:"POST",
            data:{type:type, id: category_id},
            success:function(data){
             if(type=="statedata"){
              $( "#state" ).html(data);
             }else{
              $("#country").append(data);
             }
            }
          })
        }
        loaddata();
        $("#country").on("change",function(){
          var country = $("#country").val();
          loaddata("statedata",country);
        })
      })
      </script>

  

        