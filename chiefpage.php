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
        <link rel="stylesheet" href="chiefpage.css">

    </head>
<body>
    <div id="app"> 
   <form action="chiefpagePhp.php" method="POST">
    <div id="MainDiv">
        <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

    
        <p>
            <img src="./images/horizintal.png" id="Hline">
        </p>
        
       <h1>HELLO CHIEF</h1>
       
       
       <div v-for="c,key in bill">
                                
    <table class="table table-bordered table-dark" style="width:600px; margin-left:auto; margin-right:auto;  margin-bottom:100px;">
        <thead>
    <tr>
      <th scope="col">User Name</th>
      <th scope="col">Bill ID</th>
      <th scope="col">Paid Flag</th>
      <th scope="col">Quantity</th>
      <th scope="col">Item Name</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="item,index in c.items">
      <th scope="row" v-bind:rowspan="c.items.length" v-if="index==0">{{c.name}}</th>
      <td v-bind:rowspan="c.items.length" v-if="index==0">{{c.bill_ID}}</td>
      <td v-bind:rowspan="c.items.length" v-if="index==0">{{c.paid_flag}}</td>
      <td>{{item.quantity}}</td>
      <td>{{item.item_name}}</td>
      <td v-bind:rowspan="c.items.length" v-if="index==0">
          <div class="col"><select name="status" size="1" @change="changeBillStatus($event,c.bill_ID)">
            <option value="">&nbsp;</option>
            <option value="Pending" v-bind:selected="c.status=='Pending'">Pending</option>
            <option value="Delivered" v-bind:selected="c.status=='Delivered'">Delivered</option>
            </select></div></td>
    </tr>
  </tbody>
</table><!-- table of users ends here -->
        </div>       
        
   </form>
   </div>
   </div><!-- div id="app" ends here -->
   
   <script src="js/vue.min.js"></script>
             <script>
                 
               var app = new Vue({
                   
                  el: '#app',
                data: {

                    products: [],
                    bill: new Object()

                },//data ends here 
                
                methods: {
                    
                 changeBillStatus: function(e,ID){
                     $.post("/setBillStatus.php", {
                         status: e.target.value,
                         ID: ID
                     },
                            function(result) {
                                //if(result.success)
                            }, "json");
                 },
                    loadBill: function() {
                        var self = this;
                        $.post("/getBillForChief.php", {},
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    Vue.set(self, 'bill', result.bill)

                                }

                            }, "json");
                    },//loadCart function ends here
                    
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