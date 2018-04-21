<?php
require('../db_conn.php');
//require('cart.php');

if(!check_customers($_SESSION['email'],$_SESSION['password'])){
   
    header('location:../Home-Pagee.php');
    exit();
}
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
        <link rel="stylesheet" href="bill.css">

    </head>

    <body>
        
        <div id="app">
        <div id="upper-side">

                    <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

                    <p>
                        <img src="./images/horizintal.png" id="Hline">
                    </p>

                </div>
        
        <div class="card" style="hieght: 600px; width: 600px; margin-left: auto; margin-right: auto; margin-bottom: 50px;">
                                    <div class="card-header">
                                       <strong>Bill</strong> 
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item" v-for="item,key in bill">
                                            <div class="row">
                                                <img class="col" v-bind:src="imgLoc(item)" style="height: 50px; width: 50px;" />
                                                <div class="col">{{item.name}}</div>
                                                <div class="col">{{item.price}} SAR</div>
                                                <div class="col">{{item.quantity}}</div>
                                                <div class="col">{{item.date}}</div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <strong>Total Price: </strong>{{total}} SAR
                                    </div>
                                </div>
                                
                                 
                             
                             </div><!-- id= app ends here -->  
                             
                             <button style="margin-left:1000px; background-color:cadetblue;"><a href="https://ecc-test-aseelmfili.c9users.io/cartDB/cart.php" style="text-decoration:none;color:white;">Done!</a></button>
                             <script src="js/vue.min.js"></script>
             <script>
                 
               var app = new Vue({
                   
                  el: '#app',
                data: {

                    products: [],
                    cart: new Object(),
                    bill: new Object()

                },//data ends here 
                
                computed: {
                   
                    total: function() {
                        var sum = 0;
                        for (var item in this.bill) {
                            sum += this.bill[item].price * this.bill[item].quantity;
                        }
                        return sum;
                    }//total function ends here
                    
                    
                },//computed ends here
                
                methods: {
                    
                    loadBill: function() {
                        var self = this;
                        $.post("getBill.php", {},
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    Vue.set(self, 'bill', result.bill)

                                }

                            }, "json");
                    },//loadCart function ends here
                    
                    imgLoc: function(item){
                        
                        return "./images/"+item.img;
                    }// imgLoc function ends here
                    
                },//methods ends here
                
                mounted: function() {
                    var self = this;
                    this.$nextTick(function() {
                        // Code that will run only after the
                        // entire view has been rendered
                        $.post("items.php", {},
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