<?php
require('../db_conn.php');

/*if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:../Home-Pagee.php');
    exit();
}*/
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="edit_users.css">

    </head>

    <body>
        
        <div id="upper-side">

                    <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

                    <p>
                        <img src="./images/horizintal.png" id="Hline">
                    </p>

                </div>
                <!-- div of id="upper-side" ends here -->
                <div class="container mt-5">
                <div id="userr">
                  
        
        <div>
                <table class="table table-bordered table-dark" style="width:600px; margin-left:310px;" >
                  
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">User Name</th>
      <th scope="col">Admin Flag</th>
      <th scope="col">Delete</th>
      <th scope="col">Change Admin</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="usr, index in users">
      <th scope="row">{{usr.id}}</th>
      <td>{{usr.name}}</td>
      <td>{{usr.Ad_flag}}</td>
      <td><button type="button" class="btn btn-danger" @click="removeUser(index)">Delete</button></td>
      <td><button type="button" class="btn btn-warning" @click="changeAdmin(index)">Change</button></td>
    </tr>
  </tbody>
</table><!-- table of users ends here -->
        
        </div>
        </div>
        </div>
        <script src="js/vue.min.js"></script>


        <script>
            var usr = new Vue({
                el: '#userr',
                data: {
                  
                  users: [],
                  
                  edit_index: -1
                  
                },
                
                computed: {
                  edit_user: function() {
                        if (this.edit_index < 0) {
                            return false;
                        }

                        return this.users[this.edit_index];;

                    }//edit_user function ends here
                },
                 mounted: function() {
                    var self = this;
                    this.$nextTick(function() {
                        // Code that will run only after the
                        // entire view has been rendered
                        $.post("users.php", {},
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    self.users.splice(0, self.users.length, ...result.users);
                                }
                                console.dir(result);


                            }, "json");
                    })

                }, //mounted ends here
                
                methods: {
                  
                  removeUser: function (index) {
                        var self=this;
                       // console.log(self.$refs.edit_removeUsr.value);
                        
                        
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          if(this.responseText == "1"){
                        self.users.splice(index,1);
                          }else{
                            alert("Cannot delete user!!");
                          }
                        
                        }
                      };
                      
                      xhttp.open("POST", "Remove-User.php", true);
                      xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                      xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                      xhttp.send("ID=" + encodeURIComponent(this.users[index].id));
                    
                        // When the request success do following:
                       
                    },//removeUser function ends here
                    
                
                changeAdmin: function (index) {
                        var self=this;
                       // console.log(self.$refs.edit_removeUsr.value);
                        
                        
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          if(this.responseText == "1"){
                        alert("Admin Changed !!");
                          }else{
                            alert("Cannot change admin!!");
                          }
                        
                        }
                      };
                      
                      xhttp.open("POST", "Change-Admin.php", true);
                      xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                      xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                      xhttp.send("ID=" + encodeURIComponent(this.users[index].id));
                    
                        
                       
                    }
              }
                
                
            })
                </script>
</body>
</html>