<script>
         if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
         }
</script>
<!-- 
   "StAuth10065: I James Gelfand, 000275852 certify that this material is my original work. 
   No other person's work has been used without due acknowledgement. I have not made my work available to anyone else."
      -->

<div class="container">
   <h2>Admin</h2>

   <p>This page is only accessible by admins - no general public, members or editors!</p>
</div>

<?php if ($success) { ?>
         <div class="container" id="successBlock"> 
            <h5>User added successfully</h5>
         </div>
      <?php }
            if ($error) { ?>
               <div class="container" id="errorBlock"> 
                     <?php 
                        echo validation_errors('<p class="errors">','</p>'); 
                     ?>
               </div>
      <?php } ?>

<div class="container" id="userBlock">    
        <table class="table table-hover">
           <thead>
               <tr>
                  <th>Delete</th>
                  <th>Freeze</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Access Level</th>
                  <th>Frozen</th>
               </tr>
            </thead>
         <?php foreach ($listing as $row) { ?>
            <tbody>
               <tr>
                  <td><a href="<?= base_url() ?>index.php?/Admin/delete/<?= $row['compid']?>">D</a></td>
                  <td><a href="<?= base_url() ?>index.php?/Admin/freeze/<?= $row['compid']?>">F</a></td>
                  <td><?= $row['username']?></td>
                  <td><?= $row['password']?></td>
                  <td><?= $row['accesslevel']?></td>
                  <td><?= $row['frozen']?></td>
               </tr>
            </tbody>
         <?php } ?>
         </table>
</div>

<div class="container" id="formBlock">
   <?= form_open('Admin/newUser') ?>
               <?= form_fieldset("New Entry"); ?>
                  <h5>Username: </h5>
                  <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" size="50" />

                  <h5>Password: </h5>
                  <input type="text" name="password" id="password" value="<?php echo set_value('password'); ?>" size="50" />

                  <h5>Access Level: </h5>
                  <input type="text" name="accesslevel" id="accesslevel" value="<?php echo set_value('accesslevel'); ?>" size="50" />

                  <div><input type="submit" name="quizsubmit" id="quizsubmit" value="Submit" /></div>

               </form>
</div>