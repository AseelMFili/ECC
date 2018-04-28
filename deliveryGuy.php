<?php
require('db_conn.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:../Home-Pagee.php');
    exit();
}
?>




<html>
<head>
        <meta charset="utf-8">
        <title>Cookie & Coffee </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/fontawesome-all.min.css">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="deliveryGuy.css">
</head>

<body>
    
    <div id="app">
   <form action="DeliveryGuyPhp.php" method="GET">
    <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

    
        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        
       <h1>Delivery Guy Page</h1>
  
   
                                
                                
                                <table class="table table-bordered table-dark" style="width:600px; margin-left:auto; margin-right:auto;  margin-bottom:100px; text-align:center;" v-for="usr,key in bill">
        <thead>
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">Phone No.</th>
      <th scope="col">Bill ID</th>
      <th scope="col">Total</th>
      <th scope="col">Location</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <tr >
      <th scope="row">{{usr.name}}</th>
      <td>{{usr.phoneNo}}</td>
      <td>{{usr.bill_ID}}</td>
      <td>{{usr.total}}</td>
      <td><div class="col"><button type="GET">Get Location</button></div></td>
      <td>
          <div class="col"><select id="status" name="status" size="1">
            <option value="" style="display:none">Status</option>
            <option value="pending">Pending</option>
            <option value="delivered">Delivered</option>
            </select></div></td>
    </tr>
  </tbody>
</table><!-- table of users ends here -->
   </form>
   </div>
   
   <script src="js/vue.min.js"></script>
             <script>
                 
               var app = new Vue({
                   
                  el: '#app',
                data: {

                    products: [],
                    bill: new Object()

                },//data ends here 
                
                computed: {
                   
                    total: function() {
                        var sum = 0;
                        for (var usr in this.bill) {
                            sum += this.bill[usr].price * this.bill[usr].quantity;
                        }
                        return sum;
                    }//total function ends here
                    
                    
                },//computed ends here
                
                methods: {
                    
                    loadBill: function() {
                        var self = this;
                        $.post("/getBillForDelivery.php", {},
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    Vue.set(self, 'bill', result.bill)

                                }

                            }, "json");
                    },//loadCart function ends here
                    
                    imgLoc: function(usr){
                        
                        return "./images/"+usr.img;
                    }// imgLoc function ends here
                    
                },//methods ends here
                
                mounted: function() {
                    var self = this;
                    this.$nextTick(function() {
                        // Code that will run only after the
                        // entire view has been rendered
                        $.post("./cartDB/items.php", {},
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    self.products.splice(0, self.products.length, ...result.products);
                                }
                                console.dir(result);


                            }, "json");
                        self.loadBill();
                    })

                }
                   
                   
                   
                   
                   
                   
                   
               })//var app ends here 
                 
                 
                 
                 
                 
                 
                 
             </script>
</body>

</html>