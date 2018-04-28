<?php
require('../db_conn.php');

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
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="Cart.css">

    </head>

    <body>


    
                



    
    
        <div class="container mt-5">
            
            
            

            <div id="app">
                
                
                <button type="button" class="btn btn-info mycart-btn" data-toggle="modal" data-target="#cart_model"><i class="fas fa-shopping-cart"></i></button>
                
                <div><a href="./SignOut.php">
                <img src="images/pack02-05-512.png" alt="SignOut" id="SignOut" style="float:left;width:30px;height:30px;">
                </a></div>
                <div><a href="../Setting%20Page.php">
                <img src="images/settings.png" alt="Settings" id="settings.png" style="float:left;width:30px;height:30px;">
                </a></div>
                
                <?php
    if($_SESSION["isAdmin"]){
        
    
    ?>
                <div><button type="button" class="btn btn-warning" v-on:click="toEditUserPage()">
                <i class="fas fa-user-circle"></i>
                </button>
                
                 

<?php
    }//if of check session "isAdmin" ends here
    ?>
                <div id="upper-side">

                    <img src="./images/Logo.png" alt="Cookie & Coffee" id="logo">

                    <p>
                        <img src="./images/horizintal.png" id="Hline">
                    </p>

                </div>
                <!-- div of id="upper-side" ends here -->


                <div id="filterBtns" style="margin-bottom:20px;">
                    <button class="btn" v-bind:class="{ 'btn-info': filter==null,'btn-light':filter != null }" v-on:click="filtering()"> Show all</button>

                    <?php 
                $result=getCategories();
                foreach ($result as $row) {
                 ?>

                    <button class="btn" v-on:click="filtering(<?=$row['ID']?>)" v-bind:class="{ 'btn-info': filter==<?=$row['ID']?>, 'btn-light':filter != <?=$row['ID']?>}"> <?=$row['name']?></button>
                    <?php
                
                }//foreach loop ends here
                ?>


                </div>
                <!-- div of filterBtns ends here-->


                <div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3" v-for="item,index in products" v-if="filter==null || filter == item.catID">
                            <div class="card" ><!-- v-if="checkItem(true)" -->
                                <img class="card-img-top" v-bind:src="imgLoc(item)" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{item.name}}</h5>
                                    <p class="card-text"><strong>Price: </strong>{{item.price}} SAR</p>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">

                                            <button class="btn btn-outline-secondary" type="button" @click="dec(index)">
    <i class="fas fa-minus"></i>
    </button>
                                        </div>
                                        <!-- div of class="input-group-prepend" ends here -->
                                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" v-model="item.quantity">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" @click="inc(index)">
    <i class="fas fa-plus"></i>
    </button>
                                        </div>
                                        <!-- div of class="input-group-append" ends here -->
                                    </div>
                                    <button class="btn btn-info" v-on:click="addToCart(index,$event)">
    <i class="fas fa-check" v-if="is_clicked[index]"></i>
    Add To Cart
    </button>

                                    <?php
    if($_SESSION["isAdmin"]){
        
    
    ?>
                

                                        <div>
                                            <!-- v-bind:href="#edit_item_card" -->
                                            <a href="#" @click.prevent="openEditModal(index)" style="margin-bottom: 500px">edit Item</a>
                                            <div>


                                            </div>
                                        </div>



                                        <?php
    }//if of check session "isAdmin" ends here
    ?>
                                </div>
                                <!-- div of class="input-group mb-3" ends here -->
                            </div>
                            <!-- div of class ="card-body" ends here -->
                        </div>
                    </div>


                </div>




                <div class="modal fade" id="cart_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="width: 550px">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
                            </div>
                            <div class="modal-body">

                                <div class="card">
                                    <div class="card-header">
                                        Cart items
                                    </div>
                                    <div class="list-group list-group-flush">
                                        <div class="list-group-item" v-for="item,key in cart">
                                            <div class="row">
                                                <img class="col" v-bind:src="imgLoc(item)" style="height: 50px; width: 50px;" />
                                                <div class="col">{{item.name}}</div>
                                                <div class="col">{{item.price}} SAR</div>
                                                <div class="col">{{item.quantity}}</div>
                                                <button type="button" class="close" aria-label="Close" v-on:click="cancelItem(key,1)">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer text-muted">
                                        <strong>Total Price: </strong>{{total}} SAR
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" v-on:click="makeBill()" > Checkout!</button>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="modal fade" id="edit_item_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit item</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                            </div>
                            <div class="modal-body">

                                <form method="post" @submit.prevent="updateItem(1)"  v-if='edit_item'>
                                    <div class="form-group row">
                                        <label for="imgToEdit" style="margin-left:5px;">Edit Image:</label>
                                        <br>
                                    <input type="text" id="imgToEdit" class="form-control" ref="edit_img" name="img" v-bind:value="edit_item.img" style="width:300px; margin-left:10px;"/>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="nameToEdit" style="margin-left:5px;">Edit Name:</label>
                                    <input type="text" id="nameToEdit" class="form-control" ref="edit_name" name="name" v-bind:value="edit_item.name" style="width:300px; margin-left:10px;"/>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="priceToEdit" style="margin-left:5px;">Edit Price:</label>
                                    <input type="text" id="priceToEdit" class="form-control" ref="edit_price" name="price" v-bind:value="edit_item.price" style="width:300px; margin-left:17px;"/>
                                    </div>
                                    
                                    <input type="submit"  value="Submit" style="margin-bottom:10px;"/>
                                    
                                    
                                </form><!-- form for the update item button ends here -->


                                <form method="post" @submit.prevent="updateItem(2)" v-if='edit_item'>
                                    
                                    <div>
                                                                            <button type="submit" class="close" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                                                        </div>
                                </form><!-- form for the delete item button ends here -->


                                <div class="card" id="exampleModalLabel" v-if='edit_item'>
                                    <img class="card-img-top" v-bind:src="imgLoc(edit_item)" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{edit_item.name}}</h5>
                                        <p class="card-text"><strong>Price: </strong>{{edit_item.price}} SAR</p>
                                        
                                        
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="modal" id="newItem_modal"tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adding new item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form method="post" @submit.prevent="addItem">
          <div class="form-group row">
                                        <label for="ItemImg" style="margin-left:5px;">Item Image:</label>
                                    <input type="text" id="ItemImg" class="form-control" ref="add_image" name="img"  style="width:300px; margin-left:17px;"/>
                                    </div>
                                    
         <div class="form-group row">
                                        <label for="ItemName" style="margin-left:5px;">Item Name:</label>
                                    <input type="text" id="ItemName" class="form-control" ref="add_name" name="name"  style="width:300px; margin-left:17px;"/>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="ItemPrice" style="margin-left:5px;">Item Price:</label>
                                    <input type="text" id="ItemPrice" class="form-control" ref="add_price" name="price"  style="width:300px; margin-left:17px;"/>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="ItemCat" style="margin-left:5px;">Item Category:</label>
                                    <input type="text" id="ItemCat" class="form-control" ref="add_category" name="category"  style="width:300px; margin-left:17px;"/>
                                    <small>(1) for cookies (2) for Coffee (3) for Drinks (4) for Milkshakes</small>
                                    </div>
                                    
                                    
                                    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Item</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
                                    </form>
                                    
                                    
      
      </div>
      
    </div>
  </div>
</div>


            </div><!-- id= app ends here -->

        </div>

        <script src="js/vue.min.js"></script>


        <script>
            var app = new Vue({
                el: '#app',
                data: {
                    is_clicked: new Object(),


                    products: [],
                    cart: new Object(),

                    filter: null,

                    edit_index: -1

                },

                computed: {
                    edit_item: function() {
                        if (this.edit_index < 0) {
                            return false;
                        }

                        return this.products[this.edit_index];

                    },
                    total: function() {
                        var sum = 0;
                        for (var item in this.cart) {
                            sum += this.cart[item].price * this.cart[item].quantity;
                        }
                        return sum;
                    },
                    
                },

                methods: {
                    toEditUserPage: function(){
                        window.location.href="/cartDB/edit_users.php";
                    },
                    
                    checkItem: function(b){
                        if(b == false){
                            return false;
                        }
                        
                        return true;
                    },
                    
                    updateItem: function (f) {
                        var self=this;
                       // console.log(self.$refs.edit_img.value, self.$refs.edit_name.value, self.$refs.edit_price.value,f);
                       
                        
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          console.log("Ok");
                           
                           if(f == 1){
                        self.products[self.edit_index].name = self.$refs.edit_name.value;
                        self.products[self.edit_index].price = self.$refs.edit_price.value;
                        self.products[self.edit_index].img = self.$refs.edit_img.value;
                        $('#edit_item_card').modal('hide');
                           }//if of f == 1 ends here
                           
                           else if(f == 2){
                              
                               checkItem(false);
                               $('#edit_item_card').modal('hide');
                               
                           }
                        
                        }
                      };
                      
                      xhttp.open("POST", "edit_itemsphp.php", true);
                      xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                      xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                      xhttp.send("ID=" + encodeURIComponent(self.products[self.edit_index].id) + "&name=" + encodeURIComponent(self.$refs.edit_name.value) + "&price=" + encodeURIComponent(self.$refs.edit_price.value) + "&img=" + encodeURIComponent(self.$refs.edit_img.value) + "&flag=" + encodeURIComponent(f));
                    
                        // When the request success do following:
                       
                    },

                    openEditModal: function(index) {
                        this.edit_index = index;
                        $("#edit_item_card").modal('show');
                    },

                    addToCart: function(i, event) {
                        var self = this,
                            btn = event.target;
                        var q = this.products[i].quantity;


                        Vue.set(this.is_clicked, i, true)
                        btn.disabled = true
                        $.post("addToCart.php", {
                                id: self.products[i].id,
                                quantity: q
                            },
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    if (!self.cart.hasOwnProperty(self.products[i].id)) {
                                        Vue.set(self.cart, self.products[i].id, {
                                            name: self.products[i].name,
                                            quantity: self.products[i].quantity * 1,
                                            price: self.products[i].price,
                                            id: result.id,
                                            img: self.products[i].img
                                        });
                                    } else {
                                        self.cart[self.products[i].id].quantity = self.cart[self.products[i].id].quantity * 1 + self.products[i].quantity * 1;
                                    }
                                    self.products[i].quantity = 1;
                                    Vue.set(self.is_clicked, i, false);
                                    btn.disabled = false;
                                }
                                self.loadCart();

                            }, "json")
                            .fail(function() {
                                alert("ERROR!")
                            });

                


                    },
                    cancelItem: function(i, y) {
                        var self = this;
                        if (y == 1) {
                            $.post("delFromCart.php", {
                                    id: i //self.cart[i].id

                                },
                                function(result) {
                                    if (result.error) {
                                        alert(result.error);
                                    } else {
                                        Vue.delete(self.cart, i);
                                    }

                                }, "json");
                        } else if (y == 2) {
                            $.post("edit_item.php", {
                                    id: i
                                },
                                function(result) {
                                    if (result.error) {
                                        alert(result.error);
                                    } else {
                                        Vue.delete(self.item, i);
                                    }

                                }, "json");
                        } //else ends here

                    },
                    inc: function(i) {
                        this.products[i].quantity = this.products[i].quantity * 1 + 1;
                    },

                    dec: function(i) {
                        this.products[i].quantity--; //= this.products[i].quantity;
                        if (this.products[i].quantity < 1) {
                            this.products[i].quantity = 1;
                        }
                    },
                    loadCart: function() {
                        var self = this;
                        $.post("getCart.php", {},
                            function(result) {
                                if (result.error) {
                                    alert(result.error);
                                } else {
                                    Vue.set(self, 'cart', result.cart)

                                }

                            }, "json");
                    }, //loadCart method ends here

                    filtering: function(f) {



                        if (!f) { //if the user didn't choose a filter put it null, that means it will show all the items
                            this.filter = null;

                        } else { //else, if the user choose a filter make the filter equal to the choses category
                            this.filter = f;
                        }
                    }, //filtering method ends here
                    
                    imgLoc: function(item){
                        
                        return "./images/"+item.img;
                    },
                    
                    makeBill: function(){
                        
                        var tot = app.total;
                        var self=this;
                        $.post("making-Bill.php",{
                            total:tot
                        } ,
                        function(r){
                            if(r.success){
                                
                                window.location.href="/cartDB/method-Of-OrderPage.php";
                            }else{
                                alert(r.error);
                            }
                        }
                            , "json");
                            
                    },//makeBill function ends here
                    
                    
                    addItem: function () {
                        var self=this;
                        console.log(self.$refs.add_img.value, self.$refs.add_name.value, self.$refs.add_price.value, self.$refs.add_category.value);
                       
                        
                      var xhttp = new XMLHttpRequest();
                      xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                          console.log("Ok");
                           
                           
                        self.products[self.edit_index].name = self.$refs.edit_name.value;
                        self.products[self.edit_index].price = self.$refs.edit_price.value;
                        self.products[self.edit_index].img = self.$refs.edit_img.value;
                        $('#edit_item_card').modal('hide');
                           
                           
                           
                        
                        }
                      };
                      
                      xhttp.open("POST", "edit_itemsphp.php", true);
                      xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                      xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                      xhttp.send("ID=" + encodeURIComponent(self.products[self.edit_index].id) + "&name=" + encodeURIComponent(self.$refs.edit_name.value) + "&price=" + encodeURIComponent(self.$refs.edit_price.value) + "&img=" + encodeURIComponent(self.$refs.edit_img.value) + "&flag=" + encodeURIComponent(f));
                    
                        // When the request success do following:
                       
                    }
                     

                },
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
                        self.loadCart();
                    })

                }



            })
        </script>
    </body>

    </html>